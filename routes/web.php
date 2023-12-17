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

Route::post('/forgot-password', [\App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
Route::get('/recovery-password/{token}', [\App\Http\Controllers\Api\AuthController::class, 'showRecoveryPassword']);
Route::post('/recovery-password', [\App\Http\Controllers\Api\AuthController::class, 'recoveryPassword']);

Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('cidades/get/{id}', [App\Http\Controllers\CidadeController::class, 'getCidades'])->name('cidades.get');
Route::get('categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('categorias');
Route::get('avaliacao/{slug}', [App\Http\Controllers\AvaliacaoController::class, 'index'])->name('avaliacao');
Route::get('/anunciante/{slug}', [App\Http\Controllers\AnuncianteController::class, 'show'])->name('anunciante.show');


Route::get('/anunciantes/{anunciante_id}/agendamentos', [\App\Http\Controllers\AgendamentoController::class, 'index']);
Route::post('/anunciantes/{anunciante_id}/agendamentos', [\App\Http\Controllers\AgendamentoController::class, 'store']);
Route::post('/anunciantes/{anunciante_id}/agendamentos', [\App\Http\Controllers\AgendamentoController::class, 'store']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\Anunciante\UserController::class, 'index'])->name('perfil');
    Route::put('anunciante/{id}/fotos', [App\Http\Controllers\Anunciante\PerfilController::class,'updateFotos']) ;
    Route::put('anunciante/{id}', [App\Http\Controllers\Anunciante\PerfilController::class,'update']) ;

    Route::get('/anunciantes/avaliacoes', [\App\Http\Controllers\Api\AnuncianteController::class, 'avaliacoes']);
    Route::delete('/anunciantes/avaliacoes/{id}', [\App\Http\Controllers\Api\AnuncianteController::class, 'deletarAvaliacao']);

    //AGENDAMENTOS

    Route::get('/anunciantes/agendamentos/{agendamento_id}', [\App\Http\Controllers\Anunciante\AnunciantesAgendamentosController::class, 'show']);
    Route::post('/anunciantes/agendamentos/finalizar/{agendamento_id}', [\App\Http\Controllers\Anunciante\AnunciantesAgendamentosController::class, 'finalizar']);
    Route::post('/anunciantes/agendamentos/cancelar/{agendamento_id}', [\App\Http\Controllers\Anunciante\AnunciantesAgendamentosController::class, 'cancelar']);
    Route::get('/anunciantes/agendamentos', [\App\Http\Controllers\Anunciante\AnunciantesAgendamentosController::class, 'index']);
    Route::post('/anunciantes/agendamentos/salvarDatas', [\App\Http\Controllers\Anunciante\AnunciantesAgendamentosController::class, 'salvarDatas']);
    Route::post('/anunciantes/agendamentos/salvarHorarios', [\App\Http\Controllers\Anunciante\AnunciantesAgendamentosController::class, 'salvarHorarios']);

    //Grupo de rotas com prefixo admin, namespace admin e middleware admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('perfil', [App\Http\Controllers\Admin\UserController::class, 'perfil'])->name('perfil');
        Route::get('/config', [App\Http\Controllers\Admin\UserController::class, 'config'])->name('config');
        Route::put('/perfil/update', [App\Http\Controllers\Admin\UserController::class, 'perfilUpdate'])->name('update');
        Route::get('usuarios/{usuario}', [App\Http\Controllers\Admin\UserController::class, 'show']);
        Route::get('usuarios', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('usuarios');
        Route::get('categorias', [App\Http\Controllers\Admin\CategoriaController::class, 'index'])->name('categorias');
        Route::get('avaliacoes', [App\Http\Controllers\Admin\AvaliacaoController::class, 'index'])->name('avaliacoes');
        Route::get('historico_pesquisas', [App\Http\Controllers\Admin\HistoricoPesquisaController::class, 'index'])->name('historico_pesquisas');
    });
});

