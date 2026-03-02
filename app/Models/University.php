<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'email',
        'category',
        'sector',
        'province',
        'city',
        'established_since',
        'is_hec_recognized',
        'is_blacklisted',
        'is_on_educhain',
        'registrar_email',
        'registrar_phone',
    ];

    // Fuzzy match — finds university even with partial name
    public static function findByName(string $name): ?self
    {
        $name = trim($name);

        // Exact match first
        $uni = self::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();
        if ($uni) return $uni;

        // Contains match
        $uni = self::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%'])->first();
        if ($uni) return $uni;

        // Check if query contains university name
        $uni = self::whereRaw('LOWER(?) LIKE CONCAT("%", LOWER(name), "%")', [$name])->first();
        if ($uni) return $uni;

        // Known acronyms
        $acronyms = [
            'COMSATS' => 'COMSATS University',
            'NUST'    => 'National University of Sciences',
            'LUMS'    => 'Lahore University of Management Sciences',
            'FAST'    => 'National University of Computer',
            'IBA'     => 'Institute of Business Administration',
            'QAU'     => 'Quaid-i-Azam University',
            'UET'     => 'University of Engineering & Technology',
            'AKU'     => 'Aga Khan University',
            'AIOU'    => 'Allama Iqbal Open University',
            'UoK'     => 'University of Karachi',
            'UoP'     => 'University of Punjab',
        ];

        foreach ($acronyms as $short => $full) {
            if (stripos($name, $short) !== false) {
                return self::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($full) . '%'])->first();
            }
        }

        return null;
    }
}