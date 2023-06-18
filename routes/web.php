<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StaterkitController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('cidades/get/{id}', [App\Http\Controllers\CidadeController::class, 'getCidades'])->name('cidades.get');
Route::get('categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');
Route::get('avaliacao/{slug}', [App\Http\Controllers\AvaliacaoController::class, 'index'])->name('avaliacao');
Route::get('/anunciante/{slug}', [App\Http\Controllers\AnuncianteController::class, 'show'])->name('anunciante.show');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\Anunciante\UserController::class, 'index'])->name('perfil');
    Route::put('anunciante/{id}/fotos', [App\Http\Controllers\Anunciante\PerfilController::class,'updateFotos']) ;
    Route::put('anunciante/{id}', [App\Http\Controllers\Anunciante\PerfilController::class,'update']) ;

    //Grupo de rotas com prefixo admin, namespace admin e middleware admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('perfil', [App\Http\Controllers\Admin\UserController::class, 'perfil'])->name('perfil');
        Route::put('/perfil/update', [App\Http\Controllers\Admin\UserController::class, 'perfilUpdate'])->name('update');
        Route::get('usuarios/{usuario}', [App\Http\Controllers\Admin\UserController::class, 'show']);
        Route::get('usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('usuarios');
        Route::get('categorias', [App\Http\Controllers\Admin\CategoriaController::class, 'index'])->name('categorias');
        Route::get('avaliacoes', [App\Http\Controllers\Admin\AvaliacaoController::class, 'index'])->name('avaliacoes');
    });
});

