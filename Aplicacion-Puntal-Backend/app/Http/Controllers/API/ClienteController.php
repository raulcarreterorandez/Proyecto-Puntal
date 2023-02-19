<?php

namespace App\Http\Controllers\API;

use App\Models\Cliente;
use App\Models\Telefono;
use App\Models\Embarcacione;
use App\Models\Plaza;
use App\Models\Muelle;
use App\Models\Usuario;

use App\Http\Controllers\Controller;

class ClienteController extends Controller
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

        return [
            "tipoDocumento" => $clientesOrdenado->tipoDocumento,
            "numDocumento" => $clientesOrdenado->numDocumento,
            "nombre" => $clientesOrdenado->nombre,
            "apellidos" => $clientesOrdenado->apellidos,
            "email" => $clientesOrdenado->email,
            "telefono" => $clientesOrdenado->email,
            "direccion" => $clientesOrdenado->direccion,
            "embarcaciones" => $embarcacionesOrdenado,
        ];
    }

    public function show($numDocumento)
    {
        $datos = Cliente::find($numDocumento)->toArray();
        $telefono1 = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];
        $cliente = array("numDocumento" => $datos["numDocumento"], "nombre" => $datos["nombre"], "apellidos" => $datos["apellidos"], "email" => $datos["email"], "direccion" => $datos["direccion"], "tipoDocumento" => $datos["tipoDocumento"], "telefono 1" => $telefono1["numero"], "observaciones" => $datos["observaciones"]);

        return $cliente;
    }
}
