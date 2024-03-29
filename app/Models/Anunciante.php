<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    protected $appends = ['foto_perfil','valor_hora_real','tag','foto_principal_path'];

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

    public function getMediaAvaliacoesAttribute(){
        return $this->avaliacoes()
            ->join('avaliacao_campo', 'avaliacao_campo.avaliacao_id', '=', 'avaliacoes.id')
            ->avg('avaliacao_campo.nota');
    }

    //Retorna o total de avaliações
    public function getTotalAvaliacoesAttribute(){
        return $this->avaliacoes()->count();
    }

    public function agendamentos(){
        return $this->hasMany(AnunciantesAgendamento::class, 'anunciante_id');
    }

    public function getTagAttribute(){
        $campos = [];
        foreach($this->avaliacoes as $avaliacao){
            $campos[] = $avaliacao->avaliacao_campos;
        }
        $campos = collect($campos)->collapse()->groupBy('campo_avaliacao_id')->values();

        $campo_mais_exibido = $campos->sortByDesc('count')->first();

        if($campo_mais_exibido){
         return $campo_mais_exibido[0]->campo_avaliacao->nome;

        }else{
            $campo_mais_exibido = null;
        }
    }

    public function imagens(){
        return $this->hasMany(AnuncianteImagem::class, 'anunciante_id');
    }
}
