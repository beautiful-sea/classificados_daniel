<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categorias  = \App\Models\Categoria::with('categorias_filho')->get();
        //categorias pai
        $categoriasPai = $categorias->where('categoria_pai_id', null);
        $anunciantes = \App\Models\Anunciante::query()
            ->with('user')
            ->with('categoria')
            ->with('endereco.cidade')
            ->with('endereco.estado') ->listaveis()
            ->limit(6)->get();
        return view('index')-> with('categorias', $categorias )->with('categoriasPai', $categoriasPai)-> with('anunciantes', $anunciantes);
    }
}
