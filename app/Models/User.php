<?php

namespace App\Models;
use App\Models\Role;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'name',
        'email',
        'password',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles', 'id_user', 'id_role');
    }
        ///// relation one to one avec Information et user
    public function information()
    {
        return $this->hasOne(Information::class, 'id_user');
    }

    public function recrutementpartenaire()
    {
        return $this->hasMany(RecrutementPartenaire::class);
    }
    public function forums()
    {
        return $this->hasMany(Forum::class, 'id_user');
    }

    public function etude_publications()
    {
        return $this->hasMany(EtudePublication::class, 'id_user');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'id_user');
    }
    public function fiches()
    {
        return $this->hasMany(Fiche::class, 'id_user');
    }
    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'id_user');
    }
    public function supportformations()
    {
        return $this->hasMany(Supportformation::class, 'id_user');
    }
    public function grouptravail()
    {
        return $this->hasMany(GroupeTravail::class, 'id_user');
    }
    public function rescamails()
    {
        return $this->hasMany(Rescamail::class, 'id_user');
    }
    public function activities()
    {
        return $this->hasMany(Activity::class, 'id_user');
    }
    public function membres()
    {
        return $this->hasMany(Membre::class, 'id_user');
    }
    public function comment_etude()
    {
        return $this->hasMany(CommentEtude::class, 'id_user');
    }
    public function comment_fiche()
    {
        return $this->hasMany(CommentaireFiche::class, 'id_user');
    }
    public function comment_article()
    {
        return $this->hasMany(CommentaireArticle::class, 'id_user');
    }
    public function comment_rapport()
    {
        return $this->hasMany(CommentaireRapport::class, 'id_user');
    }
    public function comment_support()
    {
        return $this->hasMany(CommentaireSupport::class, 'id_user');
    }
    public function comment_actualies()
    {
        return $this->hasMany(CommentaireActualite::class, 'id_user');
    }

    public function comment_forums()
    {
        return $this->hasMany(CommentaireForum::class, 'id_user');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
