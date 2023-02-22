<?php

use App\Http\Controllers\InstalacionController;
use App\Http\Controllers\MuelleController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\TransitoController;
use App\Http\Controllers\BasesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\TripulanteController;
use App\Http\Controllers\EmbarcacioneController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TelefonoController;
use App\Models\Usuario;

Route::view('/login', 'login')->name('login');
Route::post('/login-usuario', [AuthController::class, 'login'])->name('logear');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('instalaciones', InstalacionController::class);
Route::resource('muelles', MuelleController::class);
Route::resource('plazas', PlazaController::class);
Route::resource('transitos', TransitoController::class);
Route::resource('bases', BasesController::class);
Route::resource('mensajes', MensajeController::class);
Route::get("mensajes/{id}/responder", [MensajeController::class, 'responder'])->name('mensajes.responder');
Route::resource('tripulantes', TripulanteController::class);
Route::resource('embarcaciones', EmbarcacioneController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('telefonos', TelefonoController::class);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/user', [AuthController::class, 'infoUser'])->name('info');




// LOS PERMISOS DE ACCESO (MIDDLEWARE) ESTAN EN EL CONSTRUCTOR DEL CONTROLLER
Route::resource('usuarios', UsuarioController::class);
Route::get('/usuarios/{id}/confirm', [UsuarioController::class, 'confirm'])->name('usuarios.confirm');
