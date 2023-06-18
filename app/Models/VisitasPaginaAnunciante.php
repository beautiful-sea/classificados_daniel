<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitasPaginaAnunciante extends Model
{
    use HasFactory;

    protected $table = 'visitas_pagina_anunciantes';

    protected $fillable = [
        'anunciante_id',
        'ip',
    ];

    public function anunciante()
    {
        return $this->belongsTo(Anunciante::class);
    }
}
