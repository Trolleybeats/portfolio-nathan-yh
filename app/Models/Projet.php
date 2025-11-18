<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    /** @use HasFactory<\Database\Factories\ProjetFactory> */
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'description_courte',
        'description_longue',
        'type',
        'statut',
        'date',
        'client',
        'contexte',
        'duree',
        'role',
        'projet_url',
        'github_url',
        'ordre_affichage',
    ];

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
