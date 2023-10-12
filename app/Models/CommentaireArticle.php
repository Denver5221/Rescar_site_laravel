<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireArticle extends Model
{
    use HasFactory;


    protected $fillable = ['content', 'id_user', 'id_lier', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function relative()
    {
        return $this->belongsTo(EtudePublication::class, 'id_lier');
    }

    public function comments()
    {
        return $this->hasMany(CommentaireArticle::class, 'parent_id');
    }
}
