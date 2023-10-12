<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'id_user',
    ];

    public function membres()
    {
        return $this->hasMany(Membre::class, 'id_post');
    }
}
