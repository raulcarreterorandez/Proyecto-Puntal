<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MensajeController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\InstalacionController;
use App\Http\Controllers\API\MuellesController;
use App\Http\Controllers\API\PlazasController;
use App\Http\Controllers\API\BasesController;
use App\Http\Controllers\API\TransitosController;

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
        Route::get('/mensaje/{id}', [MensajeController::class, 'show']);

        // RUTAS API - USUARIOS
        Route::get('/usuarios', [UsuarioController::class, 'index']);
        Route::get('/usuario/{id}', [UsuarioController::class, 'show']);

        // RUTAS API - INSTALACIONES
        Route::get('/instalaciones', [InstalacionController::class, 'index']);
        Route::get('/instalaciones/{id}', [InstalacionController::class, 'show']);

        // RUTAS API - MUELLES
        Route::get('/muelles', [MuellesController::class, 'index']);
        Route::get('/muelles/{id}', [MuellesController::class, 'show']);

        // RUTAS API - PLAZAS
        Route::get('/plazas', [PlazasController::class, 'index']);
        Route::get('/plazas/{id}', [PlazasController::class, 'show']);

        // RUTAS API - BASES
        Route::get('/bases', [BasesController::class, 'index']);
        Route::get('/bases/{id}', [BasesController::class, 'show']);

        // RUTAS API - TRÁNSITOS
        Route::get('/transitos', [TransitosController::class, 'index']);
        Route::get('/transitos/{id}', [TransitosController::class, 'show']);

        // *** PONER LAS RRUTAS API ***

        // LOGOUT
        Route::get('logout', [AuthController::class, 'logout']);
});

/*    // RUTAS API - INSTALACIONES
   Route::get('/instalaciones', [InstalacionController::class, 'index']);
   Route::get('/instalaciones/{id}', [InstalacionController::class, 'show']); */