<?php

namespace App\Http\Controllers\API;

use App\Models\Cliente;
use App\Models\Telefono;
use App\Models\Embarcacione;
use App\Models\Plaza;
use App\Models\Muelle;
use App\Models\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Instalacion;
use App\Models\Tripulante;

class ClienteController extends Controller
{
    public function index()
    {
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $clientesOrdenado = Cliente::all();
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

            $clientes = [];
            for ($a = 0; $a < count($embarcaciones); $a++) {
                for ($i = 0; $i < count($embarcaciones[$a]); $i++) {
                    $cliente = Cliente::where('numDocumento', $embarcaciones[$a][$i]["id_cliente"])->get()->toArray();
                    array_push($clientes, $cliente);
                }
            }

            $clientesOrdenado = [];

            for ($i = 0; $i < count($clientes); $i++) {
                for ($a = 0; $a < count($clientes[$i]); $a++) {
                    $cliente = $clientes[$i][$a];
                    array_push($clientesOrdenado, $cliente);
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

        return $clientesOrdenado;
    }

    public function show($numDocumento)
    {
        $cliente = Cliente::find($numDocumento);
        $telefono1 = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];

        $embarcaciones = Embarcacione::where('id_cliente', $numDocumento)->get();

        $plazas = [];
        for ($i = 0; $i < count($embarcaciones); $i++) {
            $plaza = Plaza::where('id', $embarcaciones[$i]->id_plaza)->get();
            array_push($plazas, $plaza);
        }

        $plazasOrdenado = [];
        for ($i = 0; $i < count($plazas); $i++) {
            for ($a = 0; $a < count($plazas[$i]); $a++) {
                $plaza = $plazas[$i][$a];
                array_push($plazasOrdenado, $plaza);
            }
        }

        $muelles = [];
        for ($i = 0; $i < count($plazasOrdenado); $i++) {
            $muelle = Muelle::where('id', $plazasOrdenado[$i]->idMuelle)->get();
            array_push($muelles, $muelle);
        }

        $muellesOrdenado = [];
        for ($i = 0; $i < count($muelles); $i++) {
            for ($a = 0; $a < count($muelles[$i]); $a++) {
                $muelle = $muelles[$i][$a];
                array_push($muellesOrdenado, $muelle);
            }
        }

        $instalaciones = [];
        for ($i = 0; $i < count($muellesOrdenado); $i++) {
            $instalacion = Instalacion::where('id', $muellesOrdenado[$i]->idInstalacion)->get();
            array_push($instalaciones, $instalacion);
        }

        $instalacionesOrdenado = [];
        for ($i = 0; $i < count($instalaciones); $i++) {
            for ($a = 0; $a < count($instalaciones[$i]); $a++) {
                $instalacion = $instalaciones[$i][$a];
                array_push($instalacionesOrdenado, $instalacion);
            }
        }

        foreach ($embarcaciones as $embarcacione) {
            $plaza = Plaza::find($embarcacione->id_plaza);
            $muelle = Muelle::find($plaza->idMuelle);
            $instalacion = Instalacion::find($muelle->idInstalacion);
            $embarcacione->instalacion = $instalacion->nombrePuerto;
        }

        return [
            "tipoDocumento" => $cliente->tipoDocumento,
            "numDocumento" => $cliente->numDocumento,
            "nombre" => $cliente->nombre,
            "apellidos" => $cliente->apellidos,
            "email" => $cliente->email,
            "telefono" => $telefono1["numero"],
            "direccion" => $cliente->direccion,
            "embarcaciones" => $embarcaciones,
            "instalaciones" => $instalacionesOrdenado,
        ];
    }
}
