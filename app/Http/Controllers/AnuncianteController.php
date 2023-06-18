<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnuncianteController extends Controller
{
    public function show(Request $request, $slug){
        $categorias = \App\Models\Categoria::all();
        return view('anunciante',[
            'slug' => $slug,
            'categorias' => $categorias,
        ]);
    }

    public function avaliacoes(Request $request, $id){
        $avaliacoes = \App\Models\Avaliacao::where('anunciante_id', $id)->get();
        return response()->json($avaliacoes);
    }
}
