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

        // Accedemos al elemento que nos interesa(solo hay uno) dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            // $muelles = Muelle::all(); // Recogemos todos los muelles disponibles.
            return Muelle::with('instalacion', 'plazas')->get(); // Pasamos la relación con Instalaciones y con Plazas para poder hacer uso de sus propiedades 

        } else { //Si no, mostramos unicamente los muelles pertenecientes a las instalaciones relacionadas con el usuario.
            // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            $muelles = Muelle::where(function ($query) use ($usuarioLogeado) {

                foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) { //Recorremos la coleccion de instalaciones del usuario.
                    // dd($instalacion->id);
                    $query->orWhere("idInstalacion", $instalacion->id); // Los muelles pertenecientes a las instalaciones relacionadas con el usuario a través de la tabla instalacionesUsuarios.
                }
            });
            return $muelles->with('instalacion', 'plazas')->get(); // Pasamos la relación con Instalaciones y con Plazas para poder hacer uso de sus propiedades 
            // en el frontend de Angular. En este caso queremos visualizar datos de las Instalaciones o las Plazas en las vistas de Muelles. Lo devuelve en formato colección.
        }
    }

    public function show($id) {

        $muelle = Muelle::with('instalacion')->find($id); //Recogemos los muelles con su relación a instalaciones. Queremos mostrar el código y alguna cosa más de ahí.

        // Recogemos las plazas que correspondan del muelle. Es decir, las que su campo idMuelle coincida con el Id del muelle que estamos visualizando.
        // También pasamos la info de bases y transitos.
        $plazas = Plaza::with('transito', 'bases')->where('idMuelle', $id)->get(); // Queremos mostrar de que tipo són las plazas(bases o tránsitos).
        

        foreach ($plazas as $plaza) { // Recorremos la colección.

            if ($plaza->transito == null && $plaza->bases == null) { // Si los dos campos están en null...

                // La plaza está vacía.
                $plaza->tipo = "Disponible"; // Creamos un nuevo campo en la colección(tipo) que manejaremos a nuestro antojo.

            } else if ($plaza->transito == null) { // Si tránsito es null...

                $plaza->tipo = "Base"; // La plaza es de tipo base.

            } else {  // Si base es null...

                $plaza->tipo = "Tránsito"; // La plaza es de tipo tránsito.
            }
        }

        $plazasDisponibles = Plaza::where('idMuelle', $id)->where('disponible', 1)->get(); // Recogemos las plazas pertenecientes al muelle que estén disponibles.

        return [ //Especificamos la forma en la que recibimos los datos.
            "id" => $muelle->id,
            "idInstalacion" => $muelle->idInstalacion,
            "visto" => $muelle->visto,
            "instalacion" => $muelle->instalacion, // Colección con la info de la instalación a la que pertenece el muelle.
            "plazas" => $plazas, // Colección con info de bases y transitos. Con el nuevo campo(tipo) creado.
            "plazasTotales" => count($plazas), // Nº total de plazas del muelle.
            "plazasDisponibles" => count($plazasDisponibles) // Solo las plazas disponibles del muelle.
        ];
    }
}
