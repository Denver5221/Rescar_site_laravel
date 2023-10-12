<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Expert extends Model
{
    use HasFactory;
    protected $filable = [
        'slug',
        'id_user',
        'nom',
        'prenom',
        'email',
        'telephone',
        'facebook',
        'linkedin',
        'photo',
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
