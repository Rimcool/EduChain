<?php
// app/Models/IssuedDegree.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuedDegree extends Model
{
    protected $fillable = [
        'student_name',
        'roll_number',
        'degree_title',
        'university_name',
        'graduation_year',
        'degree_hash',
        'tx_hash',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    // Find by hash — used in DegreeChecker blockchain layer
    public static function findByHash(string $hash): ?self
    {
        return self::where('degree_hash', $hash)->first();
    }
}