<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'cep',
        'logradouro',
        'cidade_id',
        'user_id',
        'estado_id'
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
