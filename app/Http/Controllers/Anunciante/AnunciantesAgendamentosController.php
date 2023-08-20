<?php

namespace App\Http\Controllers\Anunciante;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnunciantesAgendamentosController extends Controller
{
    public function index(Request $request)
    {
        $mes = $request->get('mes')?? date('m');
        $ano = $request->get('ano')?? date('Y');
        $agendamentos = auth()->user()->anunciante->agendamentos()->whereMonth('data', $mes)->whereYear('data', $ano)
            ->get();
        return response ()->json ( $agendamentos );
    }

    public function salvarDatas(Request $request){
        $datas = $request->get('datas');
        $horarios = $request->get('horarios');
        $anunciante = auth()->user()->anunciante;
        //Formata as datas em datetime para data
        foreach ($datas as $data){
            $data = date('Y-m-d', strtotime($data));
            //Para cada horario, cria uma vaga de agendamento
            foreach ($horarios as $horario){
                //Somente cria se não existir
                $anunciante->agendamentos()->firstOrCreate([
                    'data' => $data,
                    'horario' => $horario,
                ],[
                    'status' => 'disponivel'
                ]);
            }
        }
    }

    public function salvarHorarios(Request $request){
        $horarios = $request->get('horarios');
        $data = date('Y-m-d', strtotime($request->get('data')));
        $anunciante = auth()->user()->anunciante;
        //Remove os horarios ja existentes com status disponivel
        $anunciante->agendamentos()->whereDate ('data', $data)
            ->where('status','disponivel')
            ->delete();

        //Para cada horario, cria uma vaga de agendamento
        foreach ($horarios as $horario){
            //Somente cria se não existir
            $anunciante->agendamentos()->firstOrCreate([
                'data' => $data,
                'horario' => $horario,
            ],[
                'status' => 'disponivel'
            ]);
        }
        return response ()->json ( $anunciante->agendamentos()->where('data', $data)->get() );
    }

    public function show($agendamento_id)
    {
        $anunciante_agendamento = \App\Models\AnunciantesAgendamento::find($agendamento_id);
        $agendamento = \App\Models\Agendamento::where('anunciantes_agendamento_id',$anunciante_agendamento->id)->first();
        return response()->json($agendamento);
    }

    public function finalizar(Request $request, $agendamento_id){
        $agendamento = \App\Models\Agendamento::find($agendamento_id);
        $agendamento->update(['status'=>'realizado']);
        $agendamento->anunciante_agendamento->update(['status'=>'realizado']);
        return response()->json($agendamento);
    }

    public function cancelar(Request $request, $agendamento_id){
        $agendamento = \App\Models\Agendamento::find($agendamento_id);
        $agendamento->anunciante_agendamento->update(['status'=>'disponivel']);
        $agendamento->delete();

        return response()->json($agendamento);
    }
}
