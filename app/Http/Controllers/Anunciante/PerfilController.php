<?php

namespace App\Http\Controllers\Anunciante;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class PerfilController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('perfil');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        //Salvar dados do anunciante
        $anunciante = $user->anunciante;
        $anunciante->subcategoria_id = $request['anunciante']['subcategoria_id'];
        $anunciante->save();

        //Salvar endereco
        $endereco = $user->endereco;
        $endereco->cep = $request['endereco']['cep'];
        $endereco->logradouro = $request['endereco']['logradouro'];
        $endereco->cidade_id = $request['endereco']['cidade_id'];
        $endereco->estado_id = $request['endereco']['estado_id'];
        $endereco->save();

        return response()->json( 'Perfil atualizado com sucesso!');
    }

}
