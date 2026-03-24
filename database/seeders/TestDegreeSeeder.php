<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TestDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only run in non-production
        if (app()->environment('production')) {
            $this->command->error('Cannot seed test data in production!');
            return;
        }

        // Seed fake degrees directly into verifications
        // so you can test the result screen without uploading

        $scenarios = [
            [
                'label'           => '✅ Fully Verified Degree',
                'student_name'    => 'Ahmed Ali Khan',
                'degree_title'    => 'Bachelor of Science in Computer Science',
                'university_name' => 'COMSATS University, Islamabad',
                'roll_number'     => 'FA19-BCS-001',
                'graduation_year' => '2023',
                'result'          => 'real',
                'university_found'=> true,
                'blockchain_match'=> true,
                'confidence_score'=> 100,
            ],
            [
                'label'           => '⚠️ Partially Verified (University not on EduChain)',
                'student_name'    => 'Sara Noor',
                'degree_title'    => 'Bachelor of Business Administration',
                'university_name' => 'University of Karachi',
                'roll_number'     => '2019/BBA/045',
                'graduation_year' => '2022',
                'result'          => 'unconfirmed',
                'university_found'=> true,
                'blockchain_match'=> false,
                'confidence_score'=> 40,
            ],
            [
                'label'           => '❌ Fake University',
                'student_name'    => 'Bilal Ahmed',
                'degree_title'    => 'Master of Business Administration',
                'university_name' => 'Oxford International College Lahore', // fake
                'roll_number'     => 'OIC-2020-789',
                'graduation_year' => '2021',
                'result'          => 'fake',
                'university_found'=> false,
                'blockchain_match'=> false,
                'confidence_score'=> 0,
            ],
            [
                'label'           => '❌ Real University, Fake Degree',
                'student_name'    => 'Zara Malik',
                'degree_title'    => 'BS Software Engineering',
                'university_name' => 'NUST',
                'roll_number'     => 'NUST-2019-FAKE',
                'graduation_year' => '2023',
                'result'          => 'fake',
                'university_found'=> true,
                'blockchain_match'=> false,
                'confidence_score'=> 0,
            ],
        ];

        foreach ($scenarios as $scenario) {
            $hash = hash('sha256', strtolower(implode('|', [
                trim($scenario['student_name']),
                trim($scenario['roll_number']),
                trim($scenario['degree_title']),
                trim($scenario['university_name']),
                trim($scenario['graduation_year']),
            ])));

            DB::table('verifications')->insert([
                'user_id'          => 1, // test user
                'student_name'     => $scenario['student_name'],
                'degree_title'     => $scenario['degree_title'],
                'university_name'  => $scenario['university_name'],
                'roll_number'      => $scenario['roll_number'],
                'graduation_year'  => $scenario['graduation_year'],
                'degree_hash'      => $hash,
                'result'           => $scenario['result'],
                'score'            => $scenario['confidence_score'],
                'checks'           => json_encode([]),
                'reason'           => $scenario['label'],
                'code'             => 'TEST-' . strtoupper(substr(md5($scenario['label'] . microtime()), 0, 6)),
                'is_test'          => true,
                'test_scenario'    => $scenario['label'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}