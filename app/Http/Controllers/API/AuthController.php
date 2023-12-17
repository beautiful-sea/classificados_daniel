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
        $this->middleware('auth:api', ['except' => ['login', 'forgotPassword', 'showRecoveryPassword', 'recoveryPassword']]);
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

    public function register(Request $request)
    {
        try{
            $data = $request->all();
            //valida dados
            $validator = \Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'phone' => 'required|string|max:255',
                'subcategoria_id' => 'required|integer'
                    ]
            );
            if($validator->fails()){
                return response()->json(['error' => $validator->errors()], 400);
            }
            $data['role'] = 'anunciante';
            $data['password'] = bcrypt($data['password']);
            $user = \App\Models\User::create($data);
            $user->anunciante()->create();
            $user->endereco()->create();
            //Loga o usuario e retorna o token
            $token = auth('api')->login($user);
            return $this->respondWithToken($token);
        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function forgotPassword(Request $request){
        try{
            $data = $request->all();
            $validator = \Validator::make($data, [
                'email' => 'required|string|email|max:255',
            ]);
            if($validator->fails()){
                return redirect('/login')->with('error', 'Email inválido');
            }
            $user = \App\Models\User::where('email', $data['email'])->first();
            if(!$user){
                return redirect('/login')->with('error', 'Email não encontrado');
            }
            $token = \Str::random(60);
            $user->password_reset_token = $token;
            $user->save();
            //Envia email
            $user->notify(new \App\Notifications\ResetPasswordNotification($token));
            return redirect('/login')->with('success', 'Email enviado com sucesso');
        }catch(\Exception $e){
            return redirect('/login')->with('error', 'Erro ao enviar email');
        }
    }

    public function showRecoveryPassword($token){
        return view('auth.recovery', ['token' => $token]);
    }

    public function recoveryPassword(Request $request){
        try{
            $data = $request->all();
            $password_reset_token = $data['token'];
            $validator = \Validator::make($data, [
                'token' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);
            if($validator->fails()){
                return redirect('/login')->with('error', 'Token inválido');
            }
            $user = \App\Models\User::where('password_reset_token', $password_reset_token)->first();
            if(!$user){
                return redirect('/login')->with('error', 'Token inválido');
            }
            $user->password = bcrypt($data['password']);
            $user->password_reset_token = null;
            $user->save();
            return redirect('/login')->with('success', 'Senha alterada com sucesso');
        }catch(\Exception $e){
            return redirect('/login')->with('error', 'Erro ao alterar senha');
        }
    }
}
