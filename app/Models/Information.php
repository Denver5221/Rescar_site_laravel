<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Information extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'nom',
        'prenom',
        'phone',
        'status',
        'photo',
        'poste',
        'ville',
        'date_naissance',
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

            public function user()
            {
                return $this->belongsTo(User::class, 'id_user');
            }
}
