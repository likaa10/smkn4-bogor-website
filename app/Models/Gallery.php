<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['major_id', 'category', 'image', 'caption'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}