<?php

use App\Http\Controllers\InstalacioneController;
use App\Http\Controllers\MuelleController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\TransitoController;
use Illuminate\Support\Facades\Route;

Route::resource('instalaciones', InstalacioneController::class);

Route::resource('muelles', MuelleController::class);

Route::resource('plazas', PlazaController::class);

Route::resource('transitos', TransitoController::class);