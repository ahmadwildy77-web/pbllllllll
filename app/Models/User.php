<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'nim_nip', 'role', 'status_akun'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function asesmen()
    {
        return $this->hasMany(AsesmenStatistik::class);
    }
}
