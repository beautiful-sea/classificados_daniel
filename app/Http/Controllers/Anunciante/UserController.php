<?php

namespace App\Http\Controllers\Anunciante;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Se o usuario for administrador, redirecionar para o dashboard do admin
        if(auth()->user()->admin){
            return redirect()->route('admin.dashboard');
        }
        $categorias = \App\Models\Categoria::all();
        return view('anunciantes.perfil',[
            'categorias' => $categorias
        ]);
    }



}
