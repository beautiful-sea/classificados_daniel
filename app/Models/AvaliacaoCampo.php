<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoCampo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota',
        'avaliacao_id',
        'campo_avaliacao_id',
    ];

    protected $table = 'avaliacao_campo';

    protected $with = ['campo_avaliacao'];

    public function campo_avaliacao()
    {
        return $this->belongsTo(CampoAvaliacao::class, 'campo_avaliacao_id', 'id');
    }


}
