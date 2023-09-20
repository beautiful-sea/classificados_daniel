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
    public function index(Request $request)
    {
        $termo = $request->q;
        if($termo){
            $ip = $request->ip();
            \App\Models\HistoricoPesquisa::create([
                'termo' => $termo,
                'ip' => $ip,
            ]);
        }


        return view('categorias');
    }
}
