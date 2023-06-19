<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anunciante extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'subcategoria_id',
        'user_id',
        'foto_principal',
        'valor_hora',
    ];

    protected $appends = ['foto_perfil','valor_hora_real' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class,'subcategoria_id');
    }

    public function endereco(){
        //Retorna o endereço atraves do user
        return $this->hasOne(Endereco::class,'user_id','user_id');
    }

    //Cria um escopo para listar apenas os anunciantes que podem ser listados
    public function scopeListaveis($query){
        //O usuário é listavel se ele tem um endereço cadastrado e se o endereco tem uma cidade
        $query->whereHas('endereco', function($query){
            $query->whereHas('cidade');
        });
    }

    //Retorna a foto do perfil com caminho completo ou a foto padrao caso nao tenha foto
    public function getFotoPerfilAttribute(){
         return $this->user->photo_path;
    }

    //Retorna a foto principal com caminho completo ou a foto padrao caso nao tenha foto
    public function getFotoPrincipalPathAttribute(){
        if($this->foto_principal){
            return asset('storage/'.$this->foto_principal);
        }else{
            return asset('images/avatar.webp');
        }
    }

    //retorna o valor da hora formatado
    public function getValorHoraFormatAttribute($value){
        return number_format($value, 2, ',', '.');
    }

    //Retorna o valor hora em moeda brasileira
    public function getValorHoraRealAttribute(){
        return 'R$ '.number_format($this->valor_hora??0, 2, ',', '.');
    }

    //Avaliações
    public function avaliacoes(){
        return $this->hasMany(Avaliacao::class, 'anunciante_id');
    }
}
