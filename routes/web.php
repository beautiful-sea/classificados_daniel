<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;


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

// Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/categorias', [App\Http\Controllers\CategoriasController::class, 'index'])->name('categorias');
Route::get('/perfil', [App\Http\Controllers\PerfilController::class, 'index'])->name('perfil');
Route::get('/usuario', [App\Http\Controllers\UserController::class, 'perfil_usuario'])->name('perfil_usuario');
Route::get('/login', [App\Http\Controllers\GerenteController::class, 'login'])->name('login');
Route::get('/cadastro', [App\Http\Controllers\GerenteController::class, 'cadastro'])->name('cadastro');
Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
Route::get('/usuarios', [App\Http\Controllers\Admin\DashboardController::class, 'usuarios'])->name('usuarios');
Route::get('/admcategorias', [App\Http\Controllers\Admin\DashboardController::class, 'categorias'])->name('admin_categorias');
Route::get('/adminperfil', [App\Http\Controllers\Admin\DashboardController::class, 'admin_perfil'])->name('admin_perfil');
Route::get('/adminconfig', [App\Http\Controllers\Admin\DashboardController::class, 'admin_config'])->name('admin_config');

