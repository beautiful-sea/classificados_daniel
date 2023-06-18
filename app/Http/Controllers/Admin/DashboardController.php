<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\CliquesContatoAnunciante;
use App\Models\User;
use App\Models\VisitasPaginaAnunciante;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::count();
        $categorias_count = Categoria::count();

        //Total de visitas nos ultimos 7 dias
        $total_visitas_7_dias = VisitasPaginaAnunciante:: where('created_at', '>=', \Carbon\Carbon::now()->subDays(7))->count();
        //Porcentagem de visita nos ultimos 7 dias em relação ao total de visitas
        $porcentagem_visitas_7_dias = 0;

        if ($total_visitas_7_dias > 0) {
            $porcentagem_visitas_7_dias = ($total_visitas_7_dias * 100) / VisitasPaginaAnunciante::count();
        }

        $total_cliques_contato_7_dias = CliquesContatoAnunciante:: where('created_at', '>=', \Carbon\Carbon::now()->subDays(7))->count();
        $porcentagem_cliques_contato_7_dias = 0;

        if ($total_cliques_contato_7_dias > 0) {
            $porcentagem_cliques_contato_7_dias = ($total_cliques_contato_7_dias * 100) / CliquesContatoAnunciante::count();
        }


        return view('admins.dashboard',[
            'users_count' => $users_count,
            'categorias_count' => $categorias_count,
            'total_visitas_7_dias' => $total_visitas_7_dias,
            'porcentagem_visitas_7_dias' => $porcentagem_visitas_7_dias,
            'total_cliques_contato_7_dias' => $total_cliques_contato_7_dias,
            'porcentagem_cliques_contato_7_dias' => $porcentagem_cliques_contato_7_dias,
        ]);
    }
}
