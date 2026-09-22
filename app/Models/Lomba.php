<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    protected $fillable = ['nama_lomba', 'deskripsi', 'url'];

    public function asesmen()
    {
        return $this->hasMany(AsesmenStatistik::class);
    }
}
