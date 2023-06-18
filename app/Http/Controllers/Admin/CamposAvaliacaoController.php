<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CamposAvaliacaoController extends Controller
{
    public function index(){
        //Retorna os campos de avaliação
        $campos  = \App\Models\CampoAvaliacao::all();
        return response()->json($campos);
    }

    public function store(Request $request){
        //Validar para Não permitir nomes duplicados
        $request->validate([
            'nome' => 'required|unique:campo_avaliacoes',
        ]);
        //Cria um novo campo de avaliação
        $campo = \App\Models\CampoAvaliacao::create($request->all());
        return response()->json($campo);
    }

    public function update(Request $request, $id){
        //Validar para Não permitir nomes duplicados
        $request->validate([
            'nome' => 'required|unique:campo_avaliacoes,nome,'.$id,
        ]);
        //Atualiza um campo de avaliação
        $campo = \App\Models\CampoAvaliacao::findOrFail($id);
        $campo->update($request->all());
        return response()->json($campo);
    }

    public function destroy(Request $request, $id){
        //Deleta um campo de avaliação
        $campo = \App\Models\CampoAvaliacao::findOrFail($id);
        //Se o campo ja estiver sendo usado em alguma avaliação, não pode ser deletado
        if($campo->avaliacao_campos->count() > 0){
            return response()->json(['message' => 'Campo de avaliação não pode ser deletado pois já está sendo usado em alguma avaliação!'], 400);
        }
        $campo->delete();
        return response()->json(['message' => 'Campo de avaliação deletado com sucesso!']);
    }
}
