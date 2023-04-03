<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [ ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function getIsAdminAttribute()
    {
        return $this->admin()->exists();
    }

    public function anunciante()
    {
        return $this->hasOne(Anunciante::class);
    }

    public function getIsAnuncianteAttribute()
    {
        return $this->anunciante()->exists();
    }

    public function visitante()
    {
        return $this->hasOne(Visitante::class);
    }

    public function getIsVisitanteAttribute()
    {
        return $this->visitante()->exists();
    }

    //Retorna o relacionamento do tipo de usuário de acordo com a coluna 'role' da tabela 'users'
    public function user_type()
    {
        if ($this->isAdmin) {
            return $this->admin();
        } elseif ($this->isAnunciante) {
            return $this->anunciante();
        } elseif ($this->isVisitante) {
            return $this->visitante();
        }
    }

    //Retorna um atributo com o badge do tipo de usuário
    public function getBadgeUserTypeAttribute()
    {
        if ($this->isAdmin) {
            return '<span class="badge bg-primary">Administrador</span>';
        } elseif ($this->isAnunciante) {
            return '<span class="badge bg-success">Anunciante</span>';
        } elseif ($this->isVisitante) {
            return '<span class="badge bg-secondary">Visitante</span>';
        }
    }

}
