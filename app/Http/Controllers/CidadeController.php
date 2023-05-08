<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function getCidades($id)
    {
        $cidades = \App\Models\Cidade::where('estado_id', $id)
            //Busca usando parametro q
            ->when(request()->q, function ($query) {
                $query->where('nome', 'LIKE', '%' . request()->q . '%');
            })
            ->get();
        return response()->json($cidades);
    }
}
