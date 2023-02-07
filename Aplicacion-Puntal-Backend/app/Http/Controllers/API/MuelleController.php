<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Muelle;
use Illuminate\Http\Request;

class MuelleController extends Controller {
    
    
    public function index() {
        $muelles = Muelle::all();

        return $muelles;
    }

    public function show($id) {
        $muelles = Muelle::find($id);

        return $muelles;
    }
}
