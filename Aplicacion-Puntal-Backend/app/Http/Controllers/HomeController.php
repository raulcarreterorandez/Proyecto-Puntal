<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    public function __construct() { // Copia Instalación.

        $this->middleware('guarda-muelle'); // Desde Guarda-muelles hacia arriba, pasando por Gerencia y Xunta acceden a todo.
    }

    public function index()
    {
        switch ( auth()->user()->perfil ) {
            case 'GUARDA-MUELLES':
                return redirect()->route('muelles.index');
            break;

            case 'XUNTA-GALICIA':
                return redirect()->route('instalaciones.index');
            break;

            case 'GERENCIA-PUERTO':
                return redirect()->route('usuarios.index');
            break;

        }

        return view('/home');
    }
}
