<?php

namespace App\Http\Controllers\Anunciante;

use App\Http\Controllers\Controller;
use App\Models\Anunciante;
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
        $anunciante->titulo = $request['anunciante']['titulo'];
        $anunciante->descricao = $request['anunciante']['descricao'];
        $anunciante->subcategoria_id = $request['anunciante']['subcategoria_id'];
        $anunciante->save();

        //Salvar endereco
        $endereco = $user->endereco;
        $endereco->cep = $request['endereco']['cep'];
        $endereco->logradouro = $request['endereco']['logradouro'];
        $endereco->cidade_id = $request['endereco']['cidade_id'];
        $endereco->estado_id = $request['endereco']['estado_id'];
        $endereco->lat = $request['endereco']['lat'];
        $endereco->lng = $request['endereco']['lng'];
        $endereco->save();


        //Retorna o usuario com anunciante e endereco com cidade e estado
        $user = User::with('anunciante.categoria')->with('endereco.cidade')->with('endereco.estado')->find($id);

        return response()->json($user, 200);
    }

    public function updateFotos(Request $request, $id)
    {
        $anunciante = Anunciante::find($id)->anunciante;

        //Salva no Storage public a foto principal na pasta do anunciante com o nome foto_principal_{$id}
        if ($request->hasFile('foto_principal')) {
            $foto_principal = $request->file('foto_principal');
            $extension = $foto_principal->extension();
            $foto_principal->storeAs('/anunciantes', 'foto_principal_' . $id.$extension , 'public');
            $anunciante->foto_principal = 'anunciantes/foto_principal_' . $id.$extension ;
            $anunciante->save();
        }

        return response()->json( 'Fotos atualizadas com sucesso!');

    }
}
