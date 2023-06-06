<?php

namespace App\Http\Controllers\API;

use App\Models\Embarcacione;
use App\Models\Usuario;
use App\Models\Muelle;
use App\Models\Plaza;

use App\Http\Controllers\Controller;
use App\Models\Instalacion;
use App\Models\Tripulante;

class EmbarcacioneController extends Controller
{
    public function index()
    {
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $embarcacionesOrdenado = Embarcacione::all();
        } else {

            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();

            $plazas = [];
            for ($i = 0; $i < count($muelles); $i++) {
                $plaza = Plaza::where('idMuelle', $muelles[$i])->get()->toArray();
                array_push($plazas, $plaza);
            }

            $embarcaciones = [];
            for ($a = 0; $a < count($plazas); $a++) {
                for ($i = 0; $i < count($plazas[$a]); $i++) {
                    $embarcacione = Embarcacione::where('id_plaza', $plazas[$a][$i])->get()->toArray();
                    if (isset($embarcacione[0]["matricula"])) {
                        array_push($embarcaciones, $embarcacione);
                    }
                }
            }

            $embarcacionesOrdenado = [];
            for ($i = 0; $i < count($embarcaciones); $i++) {
                for ($a = 0; $a < count($embarcaciones[$i]); $a++) {
                    $embarcacione = $embarcaciones[$i][$a];
                    array_push($embarcacionesOrdenado, $embarcacione);
                }
            }
        }

        return $embarcacionesOrdenado;
    }

    public function show($matricula)
    {
        $embarcacione = Embarcacione::find($matricula);
        $plaza = Plaza::find($embarcacione->id_plaza);
        $muelle = Muelle::find($plaza->idMuelle);
        $instalacion = Instalacion::find($muelle->idInstalacion);

        $tripulantes = Tripulante::where('id_embarcacion', $matricula)->get();

        foreach ($tripulantes as $tripulante) {
            $plaza = Plaza::find($tripulante->id_plaza);
            $muelle = Muelle::find($plaza->idMuelle);
            $instalacion = Instalacion::find($muelle->idInstalacion);
            $tripulante->instalacion = $instalacion->nombrePuerto;
        }

        return [
            "matricula" => $embarcacione->matricula,
            "nombre" => $embarcacione->nombre,
            "eslora" => $embarcacione->eslora,
            "manga" => $embarcacione->manga,
            "calado" => $embarcacione->calado,
            "propulsion" => $embarcacione->propulsion,
            "id_cliente" => $embarcacione->id_cliente,
            "id_plaza" => $embarcacione->id_plaza,
            "instalacionCodigo" => $instalacion->codigo,
            "instalacionNombre" => $instalacion->nombrePuerto,
            "instalacionDescripcion" => $instalacion->descripcion,
            "instalacionFecha" => $instalacion->fechaDisposicion,
            "tripulantes" => $tripulantes
        ];
    }
}
