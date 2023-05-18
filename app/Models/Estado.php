<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'uf',
    ];

    protected $appends = ['count_anunciantes'];

    //Quantidade de anunciantes com escopo 'scopeListaveis'
    public function cidades()
    {
        return $this->hasMany(Cidade::class);
    }

    //Anunciantes desse estado
    public function anunciantes()
    {
        return $this->hasManyThrough(Anunciante::class, Endereco::class, 'estado_id', 'user_id', 'id', 'user_id');
    }

    public function getCountAnunciantesAttribute()
    {
        //Quantidade de anunciantes com escopo 'scopeListaveis'
        return $this->anunciantes()->listaveis()->count();
    }
}
