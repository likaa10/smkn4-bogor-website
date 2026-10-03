<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'name', 'slug', 'tagline', 'description', 'points', 'image',
    ];

    protected function casts(): array
    {
        return [
            'points' => 'array',
        ];
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class)->latest();
    }
}