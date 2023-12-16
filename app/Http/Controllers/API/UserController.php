<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = \App\Models\User::query();
        //Search:
        if ($request->has('search')) {
            $search = $request->get('search');
            //Nome:
            $users->where('name', 'like', "%{$search}%");
            //Email:
            $users->orWhere('email', 'like', "%{$search}%");
        }
        $users = $users->paginate($request->perPage??10);
        return response()->json($users, 200);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //Deleta o usuário junto com o relacionamento com o tipo de usuário dependendo do tipo de usuário
        $user = User::findOrFail($id);
        if ($user->role == 'administrador') {
            $user->administrador()->delete();
        } elseif ($user->role == 'visitante') {
            $user->visitante()->delete();
        } elseif ($user->role == 'anunciante') {
            $user->anunciante()->delete();
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
