<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vue extends Model
{
    use HasFactory;
    protected $filable = [
        'compteur'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'id_forum');
    }
}
