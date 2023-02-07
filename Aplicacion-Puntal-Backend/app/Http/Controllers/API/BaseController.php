<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bases;
use Illuminate\Http\Request;

class BaseController extends Controller {


    public function index() {
        $bases = Bases::all();

        return $bases;
    }

    public function show($id) {
        $bases = Bases::find($id);

        return $bases;
    }

}
