<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $fillable = [
        'user_id',
        'key',
        'name',
        'monthly_limit',
        'usage_this_month',
        'is_active',
        'last_used_at',
    ];

    protected $casts = [
        'monthly_limit'    => 'integer',
        'usage_this_month' => 'integer',
        'is_active'        => 'boolean',
        'last_used_at'     => 'datetime',
    ];
}