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
        'nim_nip',
        'role',
        'status_akun',
        'google_id',
        'angkatan',
        'semester_aktif',
        'gpa',
        'pbl_status',
        'linkedin',
        'github',
        'skills'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function asesmenResponses()
    {
        return $this->hasMany(AsesmenResponse::class, 'user_id');
    }

    public function rekomendasiLomba()
    {
        return $this->hasMany(Rekomendasi::class, 'mahasiswa_id');
    }
}
