<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'nom',
        'id_user',
    ];

    public function actualites()
    {
        return $this->belongsToMany(Actualite::class, 'actualites_categories');
    }
    public function forums()
    {
        return $this->belongsToMany(Forum::class, 'forums_categories');
    }
    public function etude_publications()
    {
        return $this->belongsToMany(EtudePublication::class, 'etude_publications_categories');
    }
    public function fiches()
    {
        return $this->belongsToMany(Fiche::class, 'fiches_categories');
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'articles_categories');
    }
    public function supportformations()
    {
        return $this->belongsToMany(Supportformation::class, 'supportformations_categories');
    }
    public function rapports()
    {
        return $this->belongsToMany(Supportformation::class, 'rapports_categories');
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
}
