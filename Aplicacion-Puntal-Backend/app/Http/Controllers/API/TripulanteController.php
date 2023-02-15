<?php

namespace App\Http\Controllers\API;

use App\Models\Tripulante;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\Muelle;
use App\Models\Plaza;
use App\Models\Transito;

use App\Http\Controllers\Controller;

class TripulanteController extends Controller
{
    public function index()
    {
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $clientes = Cliente::all();
        } else {
            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();

            $plazas = [];
            for ($i = 0; $i < count($muelles); $i++) {
                $plaza = Plaza::where('idMuelle', $muelles[$i])->get()->toArray();
                array_push($plazas, $plaza);
            }
            $transitos = [];
            for ($a = 0; $a < count($plazas); $a++) {
                for ($i = 0; $i < count($plazas[$a]); $i++) {
                    $transito = Transito::where('idPlaza', $plazas[$a][$i])->get()->toArray();
                    if (isset($transito[0]["idPlaza"])) {
                        array_push($transitos, $transito);
                    }
                }
            }
            $tripulantes = [];
            for ($a = 0; $a < count($transitos); $a++) {
                for ($i = 0; $i < count($transitos[$a]); $i++) {
                    $tripulante = Tripulante::where('id_plaza', $transitos[$a][$i])->get()->toArray();
                    if (isset($tripulante[0]["numDocumento"])) {
                        array_push($tripulantes, $tripulante);
                    }
                }
            }
        }
        $tripulantesOrdenado = [];
        for ($a = 0; $a < count($tripulantes); $a++) {
            for ($i = 0; $i < count($tripulantes[$a]); $i++) {
                array_push($tripulantesOrdenado, $tripulantes[$a][$i]);
            }
        }

        return $tripulantesOrdenado;
    }

    public function show($numDocumento)
    {

        $tripulante = Tripulante::find($numDocumento);

        return $tripulante;
    }
}
