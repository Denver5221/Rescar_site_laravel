<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'id_user',
        'description',
        'numero',
        'titre',
        'meta_title',
        'meta_description',
        'status',
        'active_commentaire',
        'tags',
        'image',
        'file_fr',
        'file_an',
        'file_pf',
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


        public function categories()
        {
            return $this->belongsToMany(Categorie::class, 'rapports_categories', 'id_rapport', 'id_category');
        }
}
