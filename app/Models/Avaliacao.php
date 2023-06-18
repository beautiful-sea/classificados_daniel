<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'whatsapp',
        'comentario',
        'anunciante_id',
    ];

    protected $appends = ['created_at_for_humans'];
    protected $table = 'avaliacoes';

    protected $with = ['avaliacao_campos'];

    //CreatedAtForHumans
    public function getCreatedAtForHumansAttribute()
    {
        return $this->created_at->locale('pt_BR')->diffForHumans();
    }

    public function avaliacao_campos()
    {
        return $this->hasMany(AvaliacaoCampo::class, 'avaliacao_id', 'id');
    }
}
