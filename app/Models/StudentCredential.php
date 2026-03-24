<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCredential extends Model
{
    protected $fillable = [
        'user_id',
        'student_name',
        'roll_number',
        'degree_title',
        'university_name',
        'graduation_year',
        'degree_hash',
        'status',
        'public_slug',
        'verification_code',
        'view_count',
    ];

    protected $casts = [
        'view_count' => 'integer',
    ];
}