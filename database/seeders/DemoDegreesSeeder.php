<?php
// database/seeders/DemoDegreesSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IssuedDegree;
use App\Models\University;
use App\Services\HashService;

class DemoDegreesSeeder extends Seeder
{
    public function run(): void
    {
        $hasher = new HashService();

        $degrees = [
            [
                'student_name'    => 'Ahmed Ali Khan',
                'roll_number'     => 'FA19-BCS-001',
                'degree_title'    => 'Bachelor of Science in Computer Science',
                'university_name' => 'COMSATS University, Islamabad',
                'graduation_year' => '2023',
            ],
            [
                'student_name'    => 'Sara Noor Ahmed',
                'roll_number'     => 'SP20-MBA-045',
                'degree_title'    => 'Master of Business Administration',
                'university_name' => 'COMSATS University, Islamabad',
                'graduation_year' => '2023',
            ],
            [
                'student_name'    => 'Bilal Hassan',
                'roll_number'     => 'NUST-2019-112',
                'degree_title'    => 'Bachelor of Engineering in Civil Engineering',
                'university_name' => 'National University of Sciences & Technology',
                'graduation_year' => '2023',
            ],
        ];

        foreach ($degrees as $d) {
            $hash = $hasher->generate($d);

            IssuedDegree::firstOrCreate(
                ['degree_hash' => $hash],
                [
                    ...$d,
                    'degree_hash' => $hash,
                    'tx_hash'     => '0xEDU' . strtoupper(substr($hash, 0, 16)),
                    'issued_at'   => now(),
                ]
            );

            // Mark the university as on EduChain
            University::where('name', 'like', "%{$d['university_name']}%")
                ->update(['is_on_educhain' => true]);
        }

        $this->command->info('✅ Demo degrees seeded successfully.');
    }
}