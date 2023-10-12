<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class MembreMorale extends Model
{
    use HasFactory;
    protected $filable = [
        'slug',
        'nom	',
        'domaine',
        'pays	',
        'légalisée',
        'nombre_personnel',
        'nom_contact',
        'prenom_contact',
        'fonction_contact',
        'phone_contact',
        'email',
        'Biographie',
        'logo',
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
