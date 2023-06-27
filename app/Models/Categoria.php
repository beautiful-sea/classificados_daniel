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

    protected $appends = ['count_anunciantes'];

    public function categoria_pai()
    {
        return $this->belongsTo(Categoria::class, 'categoria_pai_id');
    }
    public function categorias_filho()
    {
        return $this->hasMany(Categoria::class, 'categoria_pai_id');
    }

    public function anunciantes()
    {
        return $this->hasMany(Anunciante::class, 'subcategoria_id');
    }

    public function getCountAnunciantesAttribute()
    {
        //Quantidade de anunciantes com escopo 'scopeListaveis'
        return $this->anunciantes()->listaveis()->count();
    }

    public function scopeComMaisAnunciantes($query)
    {
        //Retorna as categorias com mais visitas na pagina do anunciante
        $query->withCount('anunciantes')->orderBy('anunciantes_count', 'desc');
    }
}
