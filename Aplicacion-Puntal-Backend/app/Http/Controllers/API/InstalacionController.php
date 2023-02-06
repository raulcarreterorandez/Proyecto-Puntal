<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instalacion;

class InstalacionController extends Controller {
  
    public function index() {
        $instalaciones = Instalacion::all();

        return $instalaciones;
    }

    public function show($id) {
        $instalacion = Instalacion::find($id);

        return $instalacion;
    }

}