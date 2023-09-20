<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnuncianteImagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'anunciante_id',
        'path',
    ];

    protected $appends = ['full_path'];

    protected $table = 'anunciante_imagens';

    public function anunciante(){
        return $this->belongsTo(Anunciante::class);
    }

    //Retorna a foto principal com caminho completo ou a foto padrao caso nao tenha foto
    public function getFullPathAttribute(){
        if($this->path){
            return asset('storage/'.$this->path);
        }else{
            return asset('images/avatar.webp');
        }
    }
}
