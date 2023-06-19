<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Autenticacao
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function () {
    // /me
    Route::put('/me/update', [\App\Http\Controllers\Api\AuthController::class, 'update']);
    Route::post('/me/update-photo', [\App\Http\Controllers\Api\AuthController::class, 'updatePhoto']);
    Route::get('/me', [\App\Http\Controllers\Api\AuthController::class, 'me']);

    //Cidades
    Route::get('/cidades/estado/{estado_id}', [\App\Http\Controllers\Api\CidadeController::class, 'cidadePorEstado']);
    Route::get('/estados', [\App\Http\Controllers\Api\EstadoController::class, 'index']);
}) ;

Route::group([], function () {

    Route::get('/users', [\App\Http\Controllers\Api\UserController::class, 'index']);
    Route::get('/categorias', [\App\Http\Controllers\Api\CategoriaController::class, 'index']);
    Route::get('/categorias/{categoria_id}/anunciantes', [\App\Http\Controllers\Api\CategoriaController::class, 'anunciantes']);
    Route::get('/anunciantes', [\App\Http\Controllers\Api\AnuncianteController::class, 'index']);
    Route::post('/categorias', [\App\Http\Controllers\Api\CategoriaController::class, 'store']);
    Route::get('/estados', [\App\Http\Controllers\Api\EstadoController::class, 'index']);
    Route::get('/cidades/{estado_id}', [\App\Http\Controllers\Api\CidadeController::class, 'index']);
    Route::get('/anunciante/{slug}', [\App\Http\Controllers\Api\AnuncianteController::class, 'anuncianteBySlug']);
    Route::get('/anunciante/user/{user_id}', [\App\Http\Controllers\Api\AnuncianteController::class, 'anuncianteByUser']);


    //Cliques no botao de contato
    Route::post('/anunciante/{anunciante_id}/clique_contato', [\App\Http\Controllers\Api\AnuncianteController::class, 'cliqueContato']);

    //Visitas pagina do anunciante
    Route::post('/anunciante/{anunciante_id}/visita', [\App\Http\Controllers\Api\AnuncianteController::class, 'visita']);

    //Avaliacao
    Route::get('/campoAvaliacoes', [\App\Http\Controllers\CampoAvaliacaoController::class, 'index']);
    Route::post('/avaliacao', [\App\Http\Controllers\AvaliacaoController::class, 'store']);

    //Favoritos /anunciantes/favoritos
    Route::get('/anunciantes/favoritos', [\App\Http\Controllers\Api\AnuncianteController::class, 'favoritos']);

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
        Route::put('/categorias/{id}', [\App\Http\Controllers\Api\CategoriaController::class, 'update'])->name('categorias.update');
        Route::get('/anunciantes/{id}/avaliacoes', [\App\Http\Controllers\AnuncianteController::class, 'avaliacoes']);
        Route::delete('/anunciantes/{anunciante_id}/avaliacoes/{avaliacao_id}', [\App\Http\Controllers\AvaliacaoController::class, 'destroy']);
        Route::get('/avaliacoes', [\App\Http\Controllers\Admin\AvaliacaoController::class, 'index']);
        Route::delete('/avaliacoes/{avaliacao_id}', [\App\Http\Controllers\Admin\AvaliacaoController::class, 'destroy']);
        Route::get('/campos_avaliacoes', [\App\Http\Controllers\Admin\CamposAvaliacaoController::class, 'index']);
        Route::post('/campos_avaliacoes', [\App\Http\Controllers\Admin\CamposAvaliacaoController::class, 'store']);
        Route::delete('/campos_avaliacoes/{id}', [\App\Http\Controllers\Admin\CamposAvaliacaoController::class, 'destroy']);
        Route::put('/campos_avaliacoes/{id}', [\App\Http\Controllers\Admin\CamposAvaliacaoController::class, 'update']);

    });
});
