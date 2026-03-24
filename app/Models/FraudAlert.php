<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FraudAlert extends Model
{
    protected $fillable = [
        'university_name_searched',
        'search_count',
        'status',
    ];

    protected $casts = [
        'search_count' => 'integer',
    ];
}