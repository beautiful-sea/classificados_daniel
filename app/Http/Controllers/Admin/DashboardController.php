<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function usuarios()
    {
        return view('admin.usuarios');
    }
    public function categorias()
    {
        return view('admin.categorias');
    }
    public function admin_perfil()
    {
        return view('admin.admin_perfil');
    }
    public function admin_config()
    {
        return view('admin.admin_config');
    }


}
