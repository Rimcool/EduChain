<?php

namespace App\Console\Commands;

use App\Models\University;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportUniversities extends Command
{
    protected $signature = 'universities:import';

    protected $description = 'Import universities from CSV file';

    public function handle()
    {
        $filePath = storage_path('universities.csv');

if (!file_exists($filePath)) {
    $this->error('universities.csv file not found in storage/');
    return 1;
}

        $data = file_get_contents($filePath);
        $rows = array_map('str_getcsv', explode("\n", $data));

        if (empty($rows)) {
            $this->error('CSV file is empty');
            return 1;
        }

        $header = array_shift($rows);
        $expectedHeader = [
            'University Name', 'Category', 'Campuses', 'Contact Information',
            'Website', 'Google Map URL', 'Latitude', 'Longitude', 'Image URL',
            'Established Since', 'Sector', 'Chartered By', 'City', 'Province',
            'Recognized University', 'Distance Education'
        ];

        // Remove any BOM or hidden characters from header
        $header = array_map(function($col) {
            return trim($col, "\xEF\xBB\xBF \t\n\r\0\x0B");
        }, $header);

        if ($header !== $expectedHeader) {
            $this->error('CSV header does not match expected format');
            $this->line('Expected: ' . implode(', ', $expectedHeader));
            $this->line('Found: ' . implode(', ', $header));
            return 1;
        }

        University::truncate();

        $imported = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            if (empty($row[0]) || empty($row[0])) continue;

            try {
                University::create([
                    'name' => $row[0],
                    'category' => $row[1],
                    'location' => $row[2],
                    'email' => $this->extractEmail($row[3]),
                    'sector' => $row[10],
                    'province' => $row[13],
                    'city' => $row[12],
                    'established_since' => $this->parseYear($row[9]),
                    'is_hec_recognized' => $this->parseBoolean($row[14]),
                    'is_blacklisted' => false, // Default to false, can be updated manually
                    'is_on_educhain' => $this->parseBoolean($row[15]),
                    'registrar_email' => $this->extractEmail($row[3]),
                    'registrar_phone' => $this->extractPhone($row[3]),
                ]);

                $imported++;
            } catch (\Exception $e) {
                $this->error("Error importing row: " . implode(', ', $row));
                $this->error("Error: " . $e->getMessage());
                $skipped++;
            }
        }

        $this->info("Import complete!");
        $this->info("Universities imported: $imported");
        $this->info("Universities skipped: $skipped");

        return 0;
    }

    private function parseYear($year): ?int
    {
        if (empty($year)) return null;
        if (is_numeric($year)) return (int)$year;

        // Handle date formats like "1/12/2007"
        $parts = explode('/', $year);
        if (count($parts) === 3 && is_numeric($parts[2])) {
            return (int)$parts[2];
        }

        return null;
    }

    private function parseBoolean($value): bool
    {
        return strtolower(trim($value)) === 'yes';
    }

    private function extractEmail($text): ?string
    {
        if (empty($text)) return null;

        preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $text, $matches);
        return $matches[0] ?? null;
    }

    private function extractPhone($text): ?string
    {
        if (empty($text)) return null;

        preg_match('/\+?[\d\s\-\(\)]{7,}/', $text, $matches);
        return $matches[0] ?? null;
    }
}