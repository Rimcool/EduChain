<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalLicense extends Model
{
    protected $fillable = [
        'person_name',
        'license_type',
        'license_number',
        'issuing_body',
        'issued_date',
        'expiry_date',
        'is_active',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
        'is_active'   => 'boolean',
    ];
}