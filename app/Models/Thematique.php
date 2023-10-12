<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematique extends Model
{
    use HasFactory;
    protected $filable = [
        'thematique',
        'description',
        'status',
        'active_commentaire',
        'tags',
    ];

    public function forums()
    {
        return $this->hasMany(Forum::class, 'id_thematique');
    }

}
