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
        // $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email)->get();

        // En caso de que no tenga acceso a todos los puertos, filtraremos la busqueda de usuarios
        $usuarioLogeado = Usuario::where("email",auth()->user()->email)->with('instalacionesUsuario')->get();

        if($usuarioLogeado[0]->instalacionesUsuario[0]->id != 0){
            // Traemos a todos los usuarios (con las relaciones a Instalaciones) menos el usuario logueado
            $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email);

            // dd("Filtramos usuarios por puerto");
            // Filtramos los usuarios, para traer los que tengan los mismos puertos relacionados que el usuario logeado
            $usuarios= $usuarios->whereHas('instalacionesUsuario',function ($query) {

                // Traemos todos los datos del usuario logueado y sus relaciones con los puertos
                $usuarioLogeado = Usuario::where("email",auth()->user()->email)->with('instalacionesUsuario')->get();

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga)
                $query->where(function($query) use ($usuarioLogeado){
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion',$instalacion->id);
                    }
                });

            })->get();
        }
        else{
        // Traemos a todos los usuarios (con las relaciones a Instalaciones) menos el usuario logueado
        $usuarios = Usuario::with('instalacionesUsuario')->where('email','!=',auth()->user()->email)->get();
    }



        return $usuarios;
    }

    public function show($id){

        $usuario = Usuario::with('instalacionesUsuario')->find($id);
        return $usuario;
    }
}
