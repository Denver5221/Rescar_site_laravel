<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Like extends Model
{
    use HasFactory;
    protected $filable = [
        'id_user',
        'compteur'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class,'id_forum');
    }


}
