<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorias = \App\Models\Categoria::query();
        $categorias->with('categoria_pai');
        //Search:
        if ($request->has('search')) {
            $search = $request->get('search');
            //Nome:
            $categorias->where('nome', 'like', "%{$search}%");
        }
        $categorias = $categorias->paginate($request->perPage ?? 10);
        return response()->json($categorias, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //Validação:
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_pai_id' => 'nullable|exists:categorias,id',
        ]);
        $categoria = new \App\Models\Categoria();
        $categoria->nome = $request->nome;
        $categoria->categoria_pai_id = $request->categoria_pai_id;
        $categoria->save();
        return response()->json($categoria, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
