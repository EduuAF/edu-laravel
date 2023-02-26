<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SalaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Front-end
Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('salas', [AppController::class, 'salas'])->name('salas');
Route::get('sala/{slug}', [AppController::class, 'sala'])->name('sala');
Route::get('acerca-de', [AppController::class, 'acercade'])->name('acerca-de');

//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/usuarios', [UsuarioController::class, 'index'])->middleware('role:usuarios');
Route::get('admin/usuarios/crear', [UsuarioController::class, 'crear'])->middleware('role:usuarios');
Route::post('admin/usuarios/guardar', [UsuarioController::class, 'guardar'])->middleware('role:usuarios');
Route::get('admin/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->middleware('role:usuarios');
Route::post('admin/usuarios/actualizar/{id}', [UsuarioController::class, 'actualizar'])->middleware('role:usuarios');
Route::get('admin/usuarios/activar/{id}', [UsuarioController::class, 'activar'])->middleware('role:usuarios');
Route::get('admin/usuarios/borrar/{id}', [UsuarioController::class, 'borrar'])->middleware('role:usuarios');

//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/salas', [SalaController::class, 'index'])->middleware('role:salas');
Route::get('admin/salas/crear', [SalaController::class, 'crear'])->middleware('role:salas');
Route::post('admin/salas/guardar', [SalaController::class, 'guardar'])->middleware('role:salas');
Route::get('admin/salas/editar/{id}', [SalaController::class, 'editar'])->middleware('role:salas');
Route::post('admin/salas/actualizar/{id}', [SalaController::class, 'actualizar'])->middleware('role:salas');
Route::get('admin/salas/activar/{id}', [SalaController::class, 'activar'])->middleware('role:salas');
Route::get('admin/salas/home/{id}', [SalaController::class, 'home'])->middleware('role:salas');
Route::get('admin/salas/borrar/{id}', [SalaController::class, 'borrar'])->middleware('role:salas');

//Auth
Route::get('acceder', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');
Route::get('email', [AuthController::class, 'email'])->name('email');

//API Salas
Route::get('mostrar', [AppController::class, 'mostrar'])->name('mostrar');
Route::get('leer', [AppController::class, 'leer'])->name('leer');

//Ruta por defecto (si no encuentra otra antes)
Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');
