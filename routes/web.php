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


//
//Route::get('/', [StaterkitController::class, 'home'])->name('home');
//Route::get('home', [StaterkitController::class, 'home'])->name('home');
//Route::get('/logout',AuthController::class,'logout')->name('logout');

// Route Components
//Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
//Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
//Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
//Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
//Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');
//

// locale Route
//Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/perfil', [App\Http\Controllers\Anunciante\UserController::class, 'index'])->name('perfil');
    Route::resource('anunciante', App\Http\Controllers\Admin\AnuncianteController::class)->middleware('auth');
});



