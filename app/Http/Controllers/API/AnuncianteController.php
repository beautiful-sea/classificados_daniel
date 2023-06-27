<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnunciantesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnuncianteController extends Controller
{
    public function index(Request $request)
    {
        $anunciantes = \App\Models\Anunciante::query();
        $anunciantes->with('user');
        $anunciantes->with('categoria');
        $anunciantes->with('endereco.cidade');
        $anunciantes->with('endereco.estado');

        if ($request->has('categoria_id')) {
            $anunciantes->where('subcategoria_id', $request->categoria_id);
            //Busca também as categorias filhas e subfilhas
            $anunciantes->orWhereHas('categoria', function ($query) use ($request) {
                $query->where('subcategoria_id', $request->categoria_id);
            });
        }
        if ($request->has('estado_id')) {
            $anunciantes->whereHas('endereco', function ($query) use ($request) {
                $query->where('estado_id', $request->estado_id);
            });
        }
        if($request->has('q') && $request->q != ''){
            $search = $request->get('q');
            $search = strtolower($search);
            $anunciantes->where(function($anunciantes) use ($search ){
                //Busca pelo titulo do anunciante
                $anunciantes->whereRaw('lower(titulo) like (?)', "%{$search}%");
                //Busca pela descricao do anunciante
                $anunciantes->orWhereRaw('lower(descricao) like (?)', "%{$search}%");
                //Busca pelo nome do usuario do anunciante
                $anunciantes->orWhereHas('user', function ($query) use ($search) {
                    $query->whereRaw('lower(name) like (?)', "%{$search}%");
                });
            });
        }
        if($request->has('filter')){
            $filter = $request->get('filter');

            if($filter === 'recentes'){
                $anunciantes->orderBy('created_at', 'desc');
            }
            //Se for populares, faz um join com a tabela de visitas_pagina_anunciantes e ordena pelo total de visitas
            if($filter === 'populares'){
                $anunciantes->join('visitas_pagina_anunciantes', 'visitas_pagina_anunciantes.anunciante_id', '=', 'anunciantes.id')
                    ->select('anunciantes.*', DB::raw('count(visitas_pagina_anunciantes.id) as total_visitas'))
                    ->groupBy('anunciantes.id')
                    ->orderBy('total_visitas', 'desc');
            }
        }
        //Somente anunciantes com escopo 'scopeListaveis'
        $anunciantes->listaveis();


        $anunciantes = new AnunciantesResource($anunciantes->paginate($request->perPage ?? 10));
        return response()->json($anunciantes, 200);
    }

    //REtorna o usuario com o anunciante, categoria, cidade e estado
    public function anuncianteByUser(Request $request, $user_id)
    {
        $user = \App\Models\User::where('id', $user_id)
            ->with('anunciante')
            ->with('anunciante.categoria')
            ->with('endereco.cidade')
            ->with('endereco.estado')
            ->first();

        return response()->json($user, 200);
    }

    public function anuncianteBySlug(Request $request, $slug)
    {
        $anunciante = \App\Models\Anunciante::where('slug', $slug)
            ->with('user')
            ->with('categoria')
            ->with('endereco.cidade')
            ->with('endereco.estado')
            ->first();

        return response()->json($anunciante, 200);
    }

    public function cliqueContato(Request $request, $id)
    {
       $clique = \App\Models\CliquesContatoAnunciante::create([
            'anunciante_id' => $id,
            'ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Clique contato registrado com sucesso!']);
    }

    public function visita(Request $request, $anunciante_id)
    {
       $visita = \App\Models\VisitasPaginaAnunciante::create([
            'anunciante_id' => $anunciante_id,
            'ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'Visita registrada com sucesso!']);
    }

    public function favoritos(Request $request){
        $ids = $request->ids;
        $ids = explode(',', $ids);
        $anunciantes = \App\Models\Anunciante::whereIn('id', $ids)
            ->with('user')
            ->with('categoria')
            ->with('endereco.cidade')
            ->with('endereco.estado') ;
        $anunciantes = new AnunciantesResource($anunciantes->paginate($request->perPage ?? 10));
        return response()->json($anunciantes, 200);
    }
}
