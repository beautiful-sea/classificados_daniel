<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo_path',
        'phone'
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

    protected $with = ['anunciante','endereco' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['is_admin', 'is_anunciante', 'is_visitante', 'badge_user_type', 'first_name', 'created_at_for_humans', 'phone_formatted'];

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





    public function getFirstNameAttribute()
    {
        //Retorna o primeiro nome do usuário
        return explode(' ', $this->name)[0];
    }

    public function getCreatedAtForHumansAttribute()
    {
        //Retorna a data em diff for humans formatada para o padrão brasileiro
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

    public function endereco(){
        return $this->hasOne(Endereco::class);
    }

    //Foto de perfil
    public function getPhotoPathAttribute($value)
    {
        if ($value) {
            return 'storage/' . $value;
        } else {
            return asset('images/avatar.webp');
        }
    }


    //Telefone formato (00) 00000-0000
    public function getPhoneFormattedAttribute()
    {
        $value = $this->phone;
        if ($value) {
            return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . '-' . substr($value, 7, 4);
        } else {
            return null;
        }
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
