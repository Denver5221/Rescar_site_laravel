<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Forum extends Model
{
    use HasFactory;
    protected $filable = [
        'slug',
        'id_user',
        'id_theme',
    ];
    /////// fonction qui permet d'eregister le slug
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

        //////////////////////////////// relation one to many relationship with  premier

        public function categories()
        {
            return $this->belongsToMany(Categorie::class, 'forums_categories', 'id_forum', 'id_category');
        }

        public function thematique()
        {
            return $this->belongsTo(Thematique::class, 'id_thematique');
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'id_user');
        }

    //////////////////////////////// relation one to many relationship with deuxieme
    public function likes()
    {
        return $this->hasMany(Like::class, 'id_forum');
    }
    public function userLikes(): HasOne
    {
        return $this->likes()->where('id_user', auth()->id())->first();
    }
    public function partages()
    {
        return $this->hasMany(Partage::class,'id_forum');
    }
    public function vues()
    {
        return $this->hasMany(Vue::class,'id_forum');
    }
    public function comments()
    {
        return $this->hasMany(CommentaireForum::class, 'id_forum');
    }
}
