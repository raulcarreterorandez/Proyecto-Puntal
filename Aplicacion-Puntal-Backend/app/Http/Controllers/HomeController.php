<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    
    public function __construct() { // Copia Instalación.
            
        $this->middleware('guarda-muelle'); // Desde Guarda-muelles hacia arriba, pasando por Gerencia y Xunta acceden a todo. 
    }
    
    public function index() {
        
        return view('/home');
    }
}
