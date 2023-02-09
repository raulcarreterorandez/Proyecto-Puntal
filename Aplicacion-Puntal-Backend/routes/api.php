<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MensajeController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\InstalacionController;
use App\Http\Controllers\API\MuelleController;
use App\Http\Controllers\API\PlazaController;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\API\TransitoController;

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
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {

    // DETALLES DEL USUARIO LOGEADO
    Route::get('details', [AuthController::class, 'details']);

    // RUTAS API - MENSAJES
    Route::get('/mensajes', [MensajeController::class, 'index']);
    Route::get('/mensajes/{id}', [MensajeController::class, 'show']);

    // RUTAS API - USUARIOS
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::get('/usuario/{id}', [UsuarioController::class, 'show']);

    // RUTAS API - INSTALACIONES
    Route::get('/instalaciones', [InstalacionController::class, 'index']);
    Route::get('/instalaciones/{id}', [InstalacionController::class, 'show']);

    // RUTAS API - MUELLES
    Route::get('/muelles', [MuelleController::class, 'index']);
    Route::get('/muelles/{id}', [MuelleController::class, 'show']);

    // RUTAS API - PLAZAS
    Route::get('/plazas', [PlazaController::class, 'index']);
    Route::get('/plazas/{id}', [PlazaController::class, 'show']);
    Route::get('/historial', [PlazaController::class, 'historialPlazas']);
    Route::get('/historial/{id}', [PlazaController::class, 'historialPlaza']);

    // RUTAS API - BASES
    Route::get('/bases', [BaseController::class, 'index']);
    Route::get('/bases/{id}', [BaseController::class, 'show']);

    // RUTAS API - TRÁNSITOS
    Route::get('/transitos', [TransitoController::class, 'index']);
    Route::get('/transitos/{id}', [TransitoController::class, 'show']);

    // RUTAS API - CLIENTES
    Route::get('/clientes', [ClienteController::class, 'index']);
    Route::get('/clientes/{id}', [ClienteController::class, 'show']);

    // RUTAS API - EMBARCACIONES
    Route::get('/embarcaciones', [EmbarcacioneController::class, 'index']);
    Route::get('/embarcaciones/{id}', [EmbarcacioneController::class, 'show']);

    // RUTAS API - TRIPULANTES
    Route::get('/tripulantes', [TripulanteController::class, 'index']);
    Route::get('/tripulantes/{id}', [TripulanteController::class, 'show']);

    // *** PONER LAS RUTAS API ***

    // LOGOUT
    Route::get('logout', [AuthController::class, 'logout']);
});




