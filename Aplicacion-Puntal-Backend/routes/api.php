<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MensajeController;
use App\Http\Controllers\API\UsuarioController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// RUTAS API - LOGIN
Route::post('login', [AuthController::class,'login']);
Route::group(['middleware' => 'auth:api'], function () {

        // DETALLES DEL USUARIO LOGEADO
        Route::get('details', [AuthController::class,'details']);

        // RUTAS API - MENSAJES
        Route::get('/mensajes', [MensajeController::class, 'index']);
        Route::get('/mensaje/{id}', [MensajeController::class, 'show']);

        // RUTAS API - USUARIOS
        Route::get('/usuarios', [UsuarioController::class, 'index']);
        Route::get('/usuario/{id}', [UsuarioController::class, 'show']);

        // *** PONER LAS RRUTAS API ***

        // LOGOUT
        Route::get('logout', [AuthController::class,'logout']);
});
