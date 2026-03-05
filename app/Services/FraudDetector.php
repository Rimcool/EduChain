<?php

namespace App\Services;

use App\Models\FraudAlert;

class FraudDetector
{
    public static function log(string $universityName): void
    {
        $alert = FraudAlert::where('university_name_searched', $universityName)->first();

        if ($alert) {
            $alert->increment('search_count');
        } else {
            FraudAlert::create([
                'university_name_searched' => $universityName,
                'search_count'             => 1,
            ]);
        }
    }
}