<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesmenStatistik extends Model
{
    protected $fillable = ['user_id', 'lomba_id', 'nilai', 'status_keputusan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lomba()
    {
        return $this->belongsTo(Lomba::class);
    }
}
