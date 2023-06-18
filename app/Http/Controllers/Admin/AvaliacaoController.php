<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index(Request $request)
    {
        if($request->expectsJson()){
            $avaliacoes = \App\Models\Avaliacao::with('avaliacao_campos')->get();
            return response()->json($avaliacoes);
        }
        $avaliacoes = \App\Models\Avaliacao::with('avaliacao_campos')->get();
        return view('admins.avaliacoes.index')->with('avaliacoes', $avaliacoes);
    }

    public function destroy(Request $request, $id)
    {
        $avaliacao = \App\Models\Avaliacao::findOrFail($id);
        //deleta os campos da avaliação
        foreach ($avaliacao->avaliacao_campos as $campo) {
            $campo->delete();
        }
        $avaliacao->delete();
        return response()->json(['message' => 'Avaliação deletada com sucesso!']);
    }
}
