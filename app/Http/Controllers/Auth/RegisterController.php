<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    //Formulario de registro
    public function showRegistrationForm()
    {
        $categorias = \App\Models\Categoria::all();
        return view('auth.register', compact('categorias'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'categoria_id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8' ],
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'phone.required' => 'O campo telefone é obrigatório',
            'categoria_id.required' => 'O campo categoria é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está em uso',
            'password.required' => 'O campo senha é obrigatório',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres',
        ]) ;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        //Remove caracter especial do telefone
        $data['phone'] = str_replace(['(', ')', '-', ' '], '', $data['phone']);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'role'  =>  'anunciante'
        ]);

        //Cria o anunciante
        $anunciante = new \App\Models\Anunciante();
        $anunciante->user_id = $user->id;
        $anunciante->subcategoria_id = $data['categoria_id'];
        $anunciante->save();

        //Cria o endereco
        $endereco = new \App\Models\Endereco();
        $endereco->user_id = $user->id;
        $endereco->save();

        return $user;
    }

}
