<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_name',
        'roll_number',
        'degree_title',
        'university_name',
        'graduation_year',
        'degree_hash',
        'result',
        'score',
        'checks',
        'reason',
        'code',
    ];

    protected $casts = [
        'checks' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}