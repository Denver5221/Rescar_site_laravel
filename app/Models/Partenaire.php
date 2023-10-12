<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
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


    public function recrutement_partenaires()
    {
        return $this->hasMany(RecrutementPartenaire::class, 'id_partenaire');
    }
}
