<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CliquesContatoAnunciante extends Model
{
    use HasFactory;

    protected $fillable = [
        'anunciante_id',
        'ip',
    ];

    protected $table = 'cliques_contato_anunciantes';

    public function anunciante(){
        return $this->belongsTo(Anunciante::class);
    }
}
