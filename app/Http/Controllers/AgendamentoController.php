<?php

namespace App\Http\Controllers;

use App\Models\AnunciantesAgendamento;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index(Request $request, $anunciante_id)
    {
        $anunciante = \App\Models\Anunciante::find($anunciante_id);
        $agendamentos = $anunciante->agendamentos()->where('status','disponivel')
            //Somente agendamentos futuros
            ->whereDate('data','>',date('Y-m-d'))
            ->get();
        return response()->json($agendamentos);
    }

    public function store(Request $request){
        try{
            $anunciante_id = $request->anunciante_id;
            $cliente = $request->cliente;
            $data = $request->data;
            $horario = $request->horario;
            $data = \Carbon\Carbon::parse($data)->format('Y-m-d');

            $anunciantes_agendamento = AnunciantesAgendamento::where('anunciante_id',$anunciante_id)
                ->where('data',$data)
                ->where('horario',$horario)
                ->where('status','disponivel')
                ->first();
            $datetime = $data.' '.$horario;
            if($anunciantes_agendamento){
                $request->merge([
                    'nome' =>  $cliente['nome'],
                    'telefone' => $cliente['telefone'],
                    'visitante_id' => $cliente->id??null,
                    'status' => 'agendado',
                    'anunciante_id' => $anunciante_id,
                    'data' =>  $datetime,
                    'anunciantes_agendamento_id' => $anunciantes_agendamento->id,
                ]);
                $agendamento = \App\Models\Agendamento::create($request->all());
                $anunciantes_agendamento->update(['status'=>'agendado']);
                return response()->json($anunciantes_agendamento);
            }
            return response()->json(['error'=>'Agendamento não disponível. '],400);
        } catch (\Exception $e){
            return response()->json(['error'=>$e->getMessage()],400);
        }


    }


}
