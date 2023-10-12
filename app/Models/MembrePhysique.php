<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class MembrePhysique extends Model
{
    use HasFactory;
    protected $filable = [
        'slug',
        'nom	',
        'prenom',
        'data_naissance	',
        'pays',
        'sexe',
        'profil_academique',
        'domaine_specialisation',
        'fonction_actuelle',
        'phone',
        'email',
        'Biographie',
        'status',
    ];

    /////// fonction qui permet d'eregister le slug
    public function setSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $uniqueSlug = $slug;
        $counter = 1;

        // Vérifier si le slug existe déjà dans la base de données
        while (static::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter;
            $counter++;
        }

        $this->attributes['slug'] = $uniqueSlug;
    }
}
