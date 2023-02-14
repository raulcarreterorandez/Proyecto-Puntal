<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Muelle;
use App\Models\Usuario;
use App\Models\Plaza;

use Illuminate\Http\Request;

class MuelleController extends Controller {


    public function index() {
        //Necesitamos mostrar únicamente los muelles de las instalaciones en las que esté habilitado el usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            $muelles = Muelle::all(); // Recogemos todos los muelles disponibles.

        } else { //Si no, mostramos unicamente los muelles pertenecientes a las instalaciones relacionadas con el usuario.
            // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            $muelles = Muelle::where(function ($query) use ($usuarioLogeado) {

                foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) { //Recorremos la coleccion de instalaciones del usuario.
                    // dd($instalacion->id);
                    $query->orWhere("idInstalacion", $instalacion->id); // Los muelles pertenecientes a las instalaciones relacionadas con el usuario a través de la tabla instalacionesUsuarios.
                }
            });
        }       

        return $muelles->with('instalacion')->get(); // Pasamos la relación con instalaciones para poder hacer uso de sus propiedades 
        // en el frontend de Angular. En este caso queremos visualizar datos de las instalaciones en las vistas de Muelles.
    }

    public function show($id) {

        $muelle = Muelle::with('instalacion')->find($id);
        // Recogemos las plazas que correspondan del muelle. Es decir, las que su campo idMuelle coincida con el Id del muelle que estamos visualizando.
        $plazas = Plaza::where('idMuelle', $id); 
        
        return [ //Especificamos la forma en la que recibimos los datos.
            "id"=>$muelle->id,
            "idInstalacion"=>$muelle->idInstalacion,
            "visto"=>$muelle->visto,
            "instalacion"=>$muelle->instalacion,
            "plazasTotales"=>count($plazas->get()), //Todas las plazas del muelle.
            "plazasDisponibles"=>count($plazas->where('disponible',1)->get()), //Solo las plazas disponibles.
        ];
    }

}
