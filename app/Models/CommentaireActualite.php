<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireActualite extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'id_user', 'id_lier', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function relative()
    {
        return $this->belongsTo(Actualite::class, 'id_lier');
    }

    public function comments()
    {
        return $this->hasMany(CommentaireActualite::class, 'parent_id');
    }
}
