<?php

namespace App\Services;

class HashService
{
    public function generate(array $data): string
    {
        $normalized = strtolower(trim(implode('|', [
            trim($data['student_name']    ?? ''),
            trim($data['roll_number']     ?? ''),
            trim($data['degree_title']    ?? ''),
            trim($data['university_name'] ?? ''),
            trim($data['graduation_year'] ?? ''),
        ])));

        return hash('sha256', $normalized);
    }
}