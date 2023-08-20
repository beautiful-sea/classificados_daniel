<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnunciantesAgendamento extends Model
{
    use HasFactory;

    protected $table = 'anunciantes_agendamentos';


    protected $fillable = [
        'anunciante_id',
        'data',
        'horario',
        'status'
    ];

    public function anunciante()
    {
        return $this->belongsTo(Anunciante::class);
    }



}
