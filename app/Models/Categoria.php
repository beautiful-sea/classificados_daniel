<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'categoria_pai_id',
    ];

    public function categoria_pai()
    {
        return $this->belongsTo(Categoria::class, 'categoria_pai_id');
    }
    public function categorias_filho()
    {
        return $this->hasMany(Categoria::class, 'categoria_pai_id');
    }
}
