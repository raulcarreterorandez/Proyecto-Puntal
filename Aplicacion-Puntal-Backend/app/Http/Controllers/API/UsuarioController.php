<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;


class UsuarioController extends Controller
{
    public function index(){
        // Todos los usuarios incluyendo usuario logeado
        // $usuarios = Usuario::with('instalacionesUsuario')->get();

        // Todos los usuarios sin el usuario logeado
        $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email)->get();

        return $usuarios;
    }

    public function show($id){

        $usuario = Usuario::find($id);
        $instalaciones = Usuario::find($id)->instalacionesUsuario() -> get();

        return [
            'nombreUsuario' => $usuario->nombreUsuario,
            "password" => $usuario->password,
            "nombreCompleto" => $usuario->nombreCompleto,
            "email" => $usuario->email,
            "habilitado" => $usuario->habilitado,
            "perfil" => $usuario->perfil,
            "idioma" => $usuario->idioma,
            "visto" => $usuario->visto,
            "instalaciones" => $instalaciones,
        ];
    }
}
