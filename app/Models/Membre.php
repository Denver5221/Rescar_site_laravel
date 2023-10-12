<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    use HasFactory;
    protected $filable = [
        'slug',
        'id_user',
        'id_post',
        'nom',
        'prenom',
        'email',
        'telephone',
        'facebook',
        'linkedin',
        'photo',
        'cv',
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

    //////////////////////////////// relation one to many relationship with  premier

    public function poste()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
