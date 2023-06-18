<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Anunciante;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function me()
    {
        //Retorna user com relacionamentos
        $user = auth('api')->user()->load('anunciante', 'endereco.cidade', 'endereco.estado');
        $user = UserResource::make($user);
        return response()->json( $user);
    }

    public function updatePhoto(Request $request)
    {
        try{
            $user = auth('api')->user()->load('anunciante', 'endereco.cidade', 'endereco.estado');;
            $photo_file = $request->file('photo');
            $photo_path = $photo_file->store('users', 'public');
            //Se a foto anterior existir no diretorio, deleta do diretorio
            if($user->photo_path != null && file_exists(storage_path('app/public/'.$user->getAttributes()['photo_path']))){
                unlink(storage_path('app/public/'.$user->getAttributes()['photo_path']));
            }
            $user->photo_path = $photo_path;
            $user->save();
            return response()->json($user);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request){
        try{
            $data = $request->all();
            $user = auth('api')->user()->load('anunciante', 'endereco.cidade', 'endereco.estado');

            if($data['subcategoria_id']){
                //Verifica se categoria existe
                $categoria = \App\Models\Categoria::find($data['subcategoria_id']);
                if(!$categoria){
                    return response()->json(['error' => 'Categoria não encontrada'], 404);
                }
                $anunciante = Anunciante::find($user->anunciante->id);
                $anunciante->subcategoria_id = (int)$data['subcategoria_id'];
                $anunciante->save();
            }
            $user->save();
            $user = auth('api')->user()->load('anunciante', 'endereco.cidade', 'endereco.estado');
            $user = UserResource::make($user);
            return response()->json($user);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
