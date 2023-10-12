<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Rescamail extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'id_user',
        'expediteur',
        'destinataire',
        'cc',
        'subject',
        'fichier',
        'contenu',
        'lu',
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
