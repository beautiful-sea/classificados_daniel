<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (auth()->user()->role == 'administrador') {
            return '/admin';
        } elseif (auth()->user()->role == 'anunciante') {
            return '/home';
        } else {
            return '/home';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Pagina de login
    public function showLoginForm()
    {
        $categorias = \App\Models\Categoria::all();
        return view('auth.login',[
            'categorias'    => $categorias
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
            'string' => 'O campo :attribute deve ser uma string',
        ],
        [
            'email' => 'E-mail',
            'password' => 'Senha',
        ]);
    }
}
