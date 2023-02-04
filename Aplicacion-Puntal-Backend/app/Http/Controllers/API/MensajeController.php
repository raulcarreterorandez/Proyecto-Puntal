<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mensaje;
use Illuminate\Support\Facades\Auth;



class MensajeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mensajes = Mensaje::where('idUsuarioDestino',$user->email)->get();

        return $mensajes;
    }

    public function show($id)
    {
        $mensaje = Mensaje::find($id);

        // Dejamos el mensaje como visto y lo actualizamos en la base de datos
        $ensajeVisto = clone $mensaje;
        $ensajeVisto ->leido = 1;
        $mensaje -> update($ensajeVisto->toArray());

        return $mensaje;
    }
}
