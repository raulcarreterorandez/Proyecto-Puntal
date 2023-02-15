<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Embarcacione;
use App\Models\Instalacion;
use App\Models\Muelle;
use App\Models\Plaza;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PlazaController extends Controller {


    public function index() {

        //Necesitamos mostrar únicamente las plazas de los muelles pertenecientes a las instalaciones en las que esté habilitado en usuario.

        // $plazas = Plaza::where('id',1)->with('muelle')->get();
        // dd($plazas[0]->muelle->idInstalacion);

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones.
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones y por tanto a todas las plazas.
            $plazas = Plaza::all(); // Recogemos todas las plazas disponibles.

        } else { // Si no, mostramos unicamente las plazas de los muelles pertenecientes a las instalaciones relacionadas con el usuario.
                 // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            // Traemos todas las plazas y su relacion con muelles.
            $plazas = Plaza::with('muelle');

            // Filtramos las plazas, para traer las que tengan los mismos puertos relacionados que el usuario logeado.
            $plazas = $plazas->whereHas('muelle',function ($query) use ($usuarioLogeado) {

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga).
                $query->where(function($query) use ($usuarioLogeado){
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion',$instalacion->id);
                    }
                });

            })->get();
        }

        return $plazas;
    }

    public function show($id) {
    /*     $muelle = Muelle::with('instalacion')->find($id);
        // Recogemos las plazas que correspondan del muelle. Es decir, las que su campo idMuelle coincida con el Id del muelle que estamos visualizando.
        $plazas = Plaza::where('idMuelle', $id);

        return [ //Especificamos la forma en la que recibimos los datos.
            "id"=>$muelle->id,
            "idInstalacion"=>$muelle->idInstalacion,
            "visto"=>$muelle->visto,
            "instalacion"=>$muelle->instalacion,
            "plazasTotales"=>count($plazas->get()), // Nº total de plazas del muelle.
            "plazasDisponibles"=>count($plazas->where('disponible',1)->get()), // Solo las plazas disponibles.
        ]; */

        $plazas = Plaza::find($id);

        return $plazas;
    }

    public function historialPlazas(){


        // Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones.
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones y por tanto a todas las plazas.
            $plazas = Plaza::with('transito', 'bases')->get(); // Recogemos todas las plazas disponibles con la informacion de bases o transito.
            return $plazas;

        } else { // Si no, mostramos unicamente las plazas de los muelles pertenecientes a las instalaciones relacionadas con el usuario.
                 // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            // Traemos todas las plazas y su relacion con muelles. Para comparar el valor idInstalcion con las instalaciones del usuario
            $plazas = Plaza::with('muelle','transito','bases');

            // Filtramos las plazas, para traer las que tengan los mismos puertos relacionados que el usuario logeado.
            $plazas = $plazas->whereHas('muelle',function ($query) use ($usuarioLogeado) {

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga).
                $query->where(function($query) use ($usuarioLogeado){
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion',$instalacion->id);
                    }
                });

                // Condiciones para el historial de movimientos
                // $query-> where('disponible',0); // Ejemplo

            })-> without('muelle')->get();
            // return count( $plazas ); //Comprobar la cantidad de plazas que nos mandan
            // foreach ($plazas as $plaza) {
            //     $plaza
            // }
            $valor=collect([[ 'ejemplo'=>0 ]]);


            return $plazas->concat($valor);

        }


    }

    public function historialPlaza($id){
        $plaza = Plaza::with('transito','bases')->where('id',$id)->get();
        $embarcacion = Embarcacione::where('id_plaza', $id)->get();
        $cliente = Cliente::find($embarcacion[0]->id_cliente);

        $muelle = Muelle::find($plaza[0]->idMuelle);
        $instalacion = Instalacion::find($muelle->idInstalacion);

        return [
            'plaza'=>$plaza,
            'embarcacion' => $embarcacion,
            'cliente' => $cliente,
            'puerto' => $instalacion
        ];
    }
}
