<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $categorias_count = Categoria::count();
        return view('admins.dashboard',[
            'users_count' => $users_count,
            'categorias_count' => $categorias_count
        ]);
    }
}
