<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisme extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
        'description',
        'site',
        'id_user',
        'numero',
    ];
}
