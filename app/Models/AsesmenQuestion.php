<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'question_text',
        'question_type',
        'options',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function responses()
    {
        return $this->hasMany(AsesmenResponse::class, 'question_id');
    }
}
