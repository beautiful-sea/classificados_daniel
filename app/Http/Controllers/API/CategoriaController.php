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
        $categorias->with('categorias_filho');

        //Search:
        if ($request->has('search')) {
            $search = $request->get('search');
            //Nome:
            $categorias->where('nome', 'like', "%{$search}%");
        }
        if($request->only_pai){
            $categorias->whereNull('categoria_pai_id');
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
        //Não permitir criar categorias pai com categoria pai:
        if ($request->categoria_pai_id) {
            $categoriaPai = \App\Models\Categoria::find($request->categoria_pai_id);
            if ($categoriaPai->categoria_pai_id) {
                return response()->json(['message' => 'A categoria pai selecionada já é também uma categoria filha.'], 422);
            }
        }
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //Validação:
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria_pai_id' => 'nullable|exists:categorias,id',
        ]);
        $categoria = \App\Models\Categoria::find($id);

        //Não permitir criar categorias pai com categoria pai:
        if ($request->categoria_pai_id) {
            $categoriaPai = \App\Models\Categoria::find($request->categoria_pai_id);
            if ($categoriaPai->categoria_pai_id) {
                return response()->json(['message' => 'A categoria pai selecionada já é também uma categoria filha e por isso não pode ser selecionada.'], 422);
            }
        }
        //Se a categoria já for pai, não permitir alterar para filha:
        if($categoria->categorias_filho->count() > 0 && $request->categoria_pai_id){
            return response()->json(['message' => 'A categoria selecionada já possui categorias filhas e por isso não pode ser alterada para uma categoria filha.'], 422);
        }
        //Se a categoria já for filha, não permitir alterar para pai:
        if($categoria->categoria_pai_id && !$request->categoria_pai_id){
            return response()->json(['message' => 'A categoria selecionada já é uma categoria filha e por isso não pode ser alterada para uma categoria pai.'], 422);
        }

        $categoria->nome = $request->nome;
        $categoria->categoria_pai_id = $request->categoria_pai_id;
        $categoria->save();
        return response()->json($categoria, 200);
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

    public function anunciantes (Request $request, $categoria_id){
        $anunciantes = \App\Models\Anunciante::with(['categoria','endereco.cidade','endereco.estado']);
        $anunciantes->where('subcategoria_id', $categoria_id);
        $anunciantes = $anunciantes->paginate($request->perPage ?? 10);
        return response()->json($anunciantes, 200);
    }
}
