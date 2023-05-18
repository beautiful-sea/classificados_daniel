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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group( [], function () {
    Route::get('/users', [\App\Http\Controllers\Api\UserController::class,'index']);
    Route::get('/categorias', [\App\Http\Controllers\Api\CategoriaController::class,'index']);
    Route::get('/categorias/{categoria_id}/anunciantes', [\App\Http\Controllers\Api\CategoriaController::class,'anunciantes']);
    Route::get('/anunciantes', [\App\Http\Controllers\Api\AnuncianteController::class,'index']);
    Route::post('/categorias', [\App\Http\Controllers\Api\CategoriaController::class,'store']);
    Route::get('/estados', [\App\Http\Controllers\Api\EstadoController::class,'index']);
    Route::get('/cidades/{estado_id}', [\App\Http\Controllers\Api\CidadeController::class,'index']);
    Route::get('/anunciante/user/{user_id}', [\App\Http\Controllers\Api\AnuncianteController::class,'anuncianteByUser']);
    Route::get('/anunciante/{slug}', [\App\Http\Controllers\Api\AnuncianteController::class,'anuncianteBySlug']);

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'],function(){
        Route::put('/categorias/{id}', [\App\Http\Controllers\Api\CategoriaController::class,'update'])->name('categorias.update');
    });
});
