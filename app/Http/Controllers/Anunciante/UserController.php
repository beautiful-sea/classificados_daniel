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
        return view('anunciantes.perfil');
    }



}
