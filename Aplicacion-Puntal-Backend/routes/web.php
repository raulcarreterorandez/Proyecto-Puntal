<?php

use App\Http\Controllers\InstalacionController;
use App\Http\Controllers\MuelleController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\TransitoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensajeController;

Route::view('/login', 'login')->name('login');
Route::post('/login-usuario', [AuthController::class, 'login'])->name('logear');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('instalaciones', InstalacionController::class);
    Route::resource('muelles', MuelleController::class);
    Route::resource('plazas', PlazaController::class);
    Route::resource('transitos', TransitoController::class);
    Route::resource('mensajes', MensajeController::class);
    Route::get("mensajes/{id}/responder",[MensajeController::class,'responder'])->name('mensajes.responder');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', [AuthController::class, 'infoUser'])->name('info');
});

// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::resource('instalaciones', InstalacionController::class);

// Route::resource('muelles', MuelleController::class);

// Route::resource('plazas', PlazaController::class);

// Route::resource('transitos', TransitoController::class);


Route::group(['middleware' => 'xunta'], function () {

    Route::resource('usuarios', UsuarioController::class);
    Route::get('/usuario/{id}/confirm',[UsuarioController::class, 'confirm'] )->name('usuarios.confirm');

});
