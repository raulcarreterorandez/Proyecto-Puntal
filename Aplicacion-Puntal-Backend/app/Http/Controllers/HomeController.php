<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
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

            case 'CUERPO-SEGURIDAD':
                return redirect()->route('info');
            break;

            default:
                # code...
                break;
        }

        return view('/home');
    }
}
