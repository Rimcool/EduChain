<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\University;


class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('universities')->insert([
    ['name' => 'Lahore Blockchain University', 'email' => 'lbu@example.com', 'location' => 'Lahore'],
    ['name' => 'Karachi Tech Institute', 'email' => 'kti@example.com', 'location' => 'Karachi'],
]);

    }
}
