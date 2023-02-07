<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transito;
use Illuminate\Http\Request;

class TransitoController extends Controller {
    

    public function index() {
        $transitos = Transito::all();

        return $transitos;
    }

    public function show($id) {
        $transitos = Transito::find($id);

        return $transitos;
    }

}
