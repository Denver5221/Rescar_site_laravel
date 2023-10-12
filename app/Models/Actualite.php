<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Actualite extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'id_user',
        'titre',
        'contenu',
        'meta_title',
        'meta_description',
        'status',
        'active_commentaire',
        'tags',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'actualites_categories', 'id_actualite', 'id_category');
    }

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

     public function comments()
     {
         return $this->hasMany(CommentaireActualite::class, 'id_lier');
     }
}
