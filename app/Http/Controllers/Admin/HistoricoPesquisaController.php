<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoricoPesquisaController extends Controller
{
    public function index(){
        $historico_pesquisas = \App\Models\HistoricoPesquisa::all();
        return view( 'admins.historico_pesquisas.index', compact('historico_pesquisas'));
    }
}
