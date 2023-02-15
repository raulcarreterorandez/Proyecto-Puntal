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
        }

        return $clientes;
    }

    public function show($numDocumento)
    {
        $datos = Cliente::find($numDocumento)->toArray();
        $telefono1 = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];
        $cliente = array("numDocumento" => $datos["numDocumento"], "nombre" => $datos["nombre"], "apellidos" => $datos["apellidos"], "email" => $datos["email"], "direccion" => $datos["direccion"], "tipoDocumento" => $datos["tipoDocumento"], "telefono 1" => $telefono1["numero"], "observaciones" => $datos["observaciones"]);

        return $cliente;
    }
}
