<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public function user() {
    return $this->belongsTo(User::class);
}

public function university() {
    return $this->belongsTo(University::class);
}
    protected $fillable = [
        'user_id',
        'university_id',
        'title',
        'issued_on',
        'blockchain_hash',
        'status',
        'description',
        'certificate_file',
    ];
}
