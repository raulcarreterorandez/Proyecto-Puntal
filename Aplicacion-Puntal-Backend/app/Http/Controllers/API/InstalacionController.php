<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Instalacion;
use App\Models\Usuario;

class InstalacionController extends Controller {
  
    public function index() {
          //Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario.

          $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get(); //Obtengo el usuario logeado.

          // Si el usuario tiene acceso a todos los puertos, le pasamos todos los puertos disponibles
          if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
             $instalaciones = Instalacion::all();
          }
          else{ //Si no mostramos unicamente los puertos relacionados con el usuario
              
              $instalaciones = Instalacion::where(function ($query){
                  
                  $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get(); //Obtengo el usuario logeado.
                  
                  $query ->where(function ($query) use ($usuarioLogeado){
                      foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                          // dd($instalacion->id);
                          $query->orWhere("id", $instalacion->id);
                      }
                  });
              })->get(); //Modificar para datables a un all(), no paginate();
          }          
          // dd($instalaciones);
           
        return $instalaciones;
    }

    public function show($id) {
        $instalacion = Instalacion::find($id);

        return $instalacion;
    }

}