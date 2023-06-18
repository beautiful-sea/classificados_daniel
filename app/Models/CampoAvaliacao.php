<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampoAvaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];
    protected $table = 'campo_avaliacoes';

    protected $appends = ['form_name'];

    //Retorna o name do formulario do campo usando o nome do campo. Exemplo: Preço = preco, Descrição = descricao
    public function getFormNameAttribute(){
        return strtolower(str_replace(' ', '_', $this->nome));
    }

    public function avaliacao_campos(){
        return $this->hasMany(AvaliacaoCampo::class);
    }
}
