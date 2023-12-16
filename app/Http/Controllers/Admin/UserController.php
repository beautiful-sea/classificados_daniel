<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                //Somente usuarios que sao anunciantes
                whereHas('anunciante')->
        paginate($request->perPage?? 10);

        return view('admins.usuarios.index',['users' => $users]);
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
    public function show(Request $request, User $usuario)
    {
        return view('admins.usuarios.show', ['user' => $usuario]);
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

    public function updateRole(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'role' => 'required'
            ],[
                'role.required' => 'O campo tipo de usuário é obrigatório'
            ]);

            $user = User::findOrFail($id);
            $user->role = $request->role;
            $user->save();

            DB::commit();
            return redirect()->route('admin.users.index')->with('success', 'Papel do usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.users.index')->with('error', 'Erro ao atualizar o papel do usuário!');
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

    public function perfil()
    {
        $estados = Estado::all();
        return view('admins.perfil', [
            'estados' => $estados
        ]);
    }


    public function perfilUpdate(Request $request){
        //Valida os dados do endereço e do usuário
        $request->validate([
            'cep' => 'required',
            'logradouro' => 'required',
            'cidade_id' => 'required',
            'estado_id' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
        ],[
            'cep.required' => 'O campo CEP é obrigatório',
            'logradouro.required' => 'O campo endereço é obrigatório',
            'cidade_id.required' => 'O campo cidade é obrigatório',
            'estado_id.required' => 'O campo estado é obrigatório',
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está cadastrado',
        ],[
            'cep' => 'CEP',
            'logradouro' => 'endereço',
            'cidade_id' => 'cidade',
            'estado_id' => 'estado',
            'name' => 'nome',
            'email' => 'email',
        ]);
        $data = $request->all();
        $user = auth()->user();

        //Se existir imagem, salva a imagem
        if($request->hasFile('image') && $request->file('image')->isValid()){
            //Deleta a imagem antiga
            if($user->photo_path){
                Storage::delete("users/{$user->photo_path}", 'public');
            }
            $name = Str::kebab($request->name);
            $user_id=  auth()->user()->id;
            $extension = $request->image->extension();
            $nameFile = "{$name}-{$user_id}.{$extension}";
            $upload = $request->image->storeAs('users', $nameFile,'public');
            $data['photo_path'] = $nameFile;

            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao fazer upload da imagem!');
            }
        }
        $user->update($data);
        //Atualiza ou cria endereco
        $endereco = Endereco::where('user_id', $user->id)->first();
        if(!$endereco){
            $endereco = new Endereco();
            $endereco->user_id = $user->id;
        }
        $endereco->cep = $data['cep'];
        $endereco->logradouro = $data['logradouro'];
        $endereco->cidade_id = $data['cidade_id'];
        $endereco->estado_id = $data['estado_id'];
        $endereco->save();

        return redirect()->route('admin.perfil')->with('success', 'Perfil atualizado com sucesso!');
    }

    public function config (Request $request) {
        return view('admins.config');
    }
}
