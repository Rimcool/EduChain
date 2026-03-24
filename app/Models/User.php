<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'university_name',
        'company_name',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin() {
        return $this->role === 'super_admin';
    }

    public function isStudent() {
        return $this->role === 'student';
    }

    public function isUniversity() {
        return $this->role === 'university';
    }

    public function isRecruiter() {
        return $this->role === 'recruiter';
    }

    public function isApproved() {
        return $this->status === 'active';
    }
}
