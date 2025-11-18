<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /** @use HasFactory<\Database\Factories\ProjetFactory> */
    use HasFactory;

    public function technologies()
    {
        return $this->belongsToMany(Technologie::class);
    }

    public function image_principale()
    {
        return $this->hasOne(Image::class)->where('est_principale', true);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
