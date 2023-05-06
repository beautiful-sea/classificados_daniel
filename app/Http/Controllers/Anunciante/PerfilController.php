<?php

namespace App\Http\Controllers\Anunciante;

use App\Http\Controllers\Controller;

class PerfilController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('perfil');
    }

    public function perfil_usuario()
    {
        return view('perfil_usuario');
    }
}
