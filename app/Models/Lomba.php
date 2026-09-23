<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    protected $fillable = ['nama_lomba', 'deskripsi', 'url', 'cover_image', 'kategori', 'tingkat', 'deadline', 'peserta_maks'];

    public function asesmen()
    {
        return $this->hasMany(AsesmenStatistik::class);
    }
}
