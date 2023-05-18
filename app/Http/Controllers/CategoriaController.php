<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categorias = \App\Models\Categoria::all();

        return view('categorias',[
            'categorias'    => $categorias
        ]);
    }
}
