<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use App\Models\Embarcacione;
use App\Models\Muelle;
use App\Models\Usuario;
use App\Models\Plaza;
use Illuminate\Http\Request;

class ServicioController extends Controller {   


    public function index() {
        
        //Necesitamos mostrar únicamente los muelles de las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            $servicios = Servicio::all(); // Recogemos todos los muelles disponibles.

        } else { //Si no, mostramos unicamente los muelles pertenecientes a las instalaciones relacionadas con el usuario.
            // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            //Obtengo el usuario logeado.
            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            //Obtengo la instalacion a la que pertenece el usuario logeado.
            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            //Obtengo los muelles a los que pertenece el usuario logeado.
            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();

            //Obtengo las plazas pertenecientes a la Instalacion a las que pertenece el usuario logeado.
            $plazas = [];
            for ($i = 0; $i < count($muelles); $i++) {
                $plaza = Plaza::where('idMuelle', $muelles[$i])->get()->toArray();
                array_push($plazas, $plaza);
            }

            //Obtengo las embarcaciones a las que pertenece el usuario logeado.
            $embarcaciones = [];
            for ($a = 0; $a < count($plazas); $a++) {
                for ($i = 0; $i < count($plazas[$a]); $i++) {
                    $embarcacione = Embarcacione::where('id_plaza', $plazas[$a][$i])->get()->toArray();
                    if (isset($embarcacione[0]["matricula"])) {
                        array_push($embarcaciones, $embarcacione[0]);
                    }
                }
            }

            $servicios = [];
            for ($a = 0; $a < count($embarcaciones); $a++) {                
                    $servicio = Servicio::where('matriculaEmbarcacion', $embarcaciones[$a]['matricula'])->get()->toArray();
                    if (isset($servicios[0]["matriculaEmbarcacion"])) {
                        $servicio['embarcacion'] = $embarcaciones[$a];
                        array_push($servicios, $servicio[0]); 
                    }                 
            }
            /* $servicio = Servicio::where('matriculaEmbarcacion', 'matricula-15')->get()->toArray();
            dd($servicio);   */                 
        }
        return $servicios;
    }

    public function show($id) {

        $servicio = Servicio::with('embarcacion')->find($id); //Recogemos los servicios con su relación a embarcaciones. Queremos mostrar nombre y alguna cosa más de ahí.       

        return $servicio;
    }


}
