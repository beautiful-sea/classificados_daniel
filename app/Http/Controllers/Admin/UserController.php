<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::
        when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        })
            ->when($request->role, function ($query) use ($request) {
                $query->where('role', $request->role);
            })
            ->
        paginate($request->perPage?? 10);

        return view('admin.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //Adiciona a funcao atual em um try catch
        try {
            //Valida e cadastra um novo usuário criando também sua tabela de relacionamento com o tipo de usuário
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
                'role' => 'required'
            ],[
                'name.required' => 'O campo nome é obrigatório',
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O campo email deve ser um email válido',
                'email.unique' => 'O email informado já está cadastrado',
                'password.required' => 'O campo senha é obrigatório',
                'password.min' => 'O campo senha deve ter no mínimo 6 caracteres',
                'password_confirmation.required' => 'O campo confirmação de senha é obrigatório',
                'password_confirmation.same' => 'O campo confirmação de senha deve ser igual ao campo senha',
                'role.required' => 'O campo tipo de usuário é obrigatório'
            ]);

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            if ($request->role == 'admin') {
                $user->admin()->create();
            } else if ($request->role == 'anunciante') {
                $user->anunciante()->create();
            } else if ($request->role == 'visitante') {
                $user->visitante()->create();
            }

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'Usuário cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao cadastrar usuário!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //Valida e atualiza o usuario
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'role' => 'required'
            ],[
                'name.required' => 'O campo nome é obrigatório',
                'email.required' => 'O campo email é obrigatório',
                'email.email' => 'O campo email deve ser um email válido',
                'email.unique' => 'O email informado já está cadastrado',
                'role.required' => 'O campo tipo de usuário é obrigatório'
            ],[
                'name' => 'nome',
                'email' => 'email',
                'role' => 'tipo de usuário'
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();

            //Cria o relacionamento de acordo com o tipo de usuario (administrador, visitante ou funcionario)
            if ($request->role == 'administrador') {
                $user->administrador()->create();
            } elseif ($request->role == 'visitante') {
                $user->visitante()->create();
            } elseif ($request->role == 'anunciante') {
                $user->anunciante()->create();
            }
            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.users.index')->with('error', 'Erro ao atualizar o usuário!');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
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
