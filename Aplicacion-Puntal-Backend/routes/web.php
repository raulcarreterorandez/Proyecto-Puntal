<?php

use App\Http\Controllers\InstalacionController;
use App\Http\Controllers\MuelleController;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\TransitoController;
use Illuminate\Support\Facades\Route;

Route::resource('instalaciones', InstalacionController::class);

Route::resource('muelles', MuelleController::class);

Route::resource('plazas', PlazaController::class);

Route::resource('transitos', TransitoController::class);
