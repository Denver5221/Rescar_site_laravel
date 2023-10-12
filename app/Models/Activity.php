<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'title',
        'type',
        'icon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
