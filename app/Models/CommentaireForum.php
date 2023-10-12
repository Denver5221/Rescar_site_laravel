<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireForum extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'id_user', 'id_forum', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'id_forum');
    }

    public function comments()
    {
        return $this->hasMany(CommentaireForum::class, 'parent_id');
    }
}
