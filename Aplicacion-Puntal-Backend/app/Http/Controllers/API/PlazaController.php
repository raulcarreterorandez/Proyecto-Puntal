<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Plaza;
use Illuminate\Http\Request;

class PlazaController extends Controller {
    

    public function index() {
        $plazas = Plaza::all();

        return $plazas;
    }

    public function show($id) {
        $plazas = Plaza::find($id);

        return $plazas;
    }
}
