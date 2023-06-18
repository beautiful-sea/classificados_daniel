<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampoAvaliacaoController extends Controller
{
    public function index(){
        //Retorna os campos de avaliação
        $campos  = \App\Models\CampoAvaliacao::all();
        return response()->json($campos);
    }
}
