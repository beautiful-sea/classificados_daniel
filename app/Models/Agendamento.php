<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'status',
        'nome',
        'telefone',
        'anunciante_id',
        'visitante_id',
        'anunciantes_agendamento_id'
    ];

    protected $appends = ['data_hora', 'status_label', 'status_label_bootstrap'];

    //'disponivel','agendado', 'cancelado', 'realizado'
    CONST STATUS = [
        'disponivel' => 'Disponível',
        'agendado' => 'Agendado',
        'cancelado' => 'Cancelado',
        'realizado' => 'Realizado',
    ];

    public function anunciante(){
        return $this->belongsTo(Anunciante::class);
    }

    public function anunciantes_agendamentos(){
        return $this->hasMany(AnunciantesAgendamento::class);
    }

    public function anunciante_agendamento(){
        return $this->belongsTo(AnunciantesAgendamento::class,'anunciantes_agendamento_id');
    }

    public function getDataHoraAttribute(){ //de Y-m-d H:i:s para d/m/Y H:i:s
        return \Carbon\Carbon::parse($this->data)->format('d/m/Y H:i:s');
    }

    public function getStatusLabelBootstrapAttribute(){
        switch ($this->status) {
            case 'disponivel':
                return 'badge bg-success';
                break;
            case 'agendado':
                return 'badge bg-warning';
                break;
            case 'cancelado':
                return 'badge bg-danger';
                break;
            case 'realizado':
                return 'badge bg-primary';
                break;
            default:
                return 'badge bg-secondary';
                break;
        }
    }

    public function getStatusLabelAttribute(){
        return self::STATUS[$this->status];
    }
}
