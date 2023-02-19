<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Embarcacione;
use App\Models\Muelle;
use App\Models\Plaza;
use App\Models\Telefono;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        /////////////////////////////////////////////////////////////////////////////////////////////////
        /////Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario./////
        /////////////////////////////////////////////////////////////////////////////////////////////////

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        //Si el usuario tiene acceso a todos los puertos, le pasamos todos los puertos disponibles
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $clientes = Cliente::all();
        } else { //Si no mostramos unicamente los puertos relacionados con el usuario

            //$muelles = $usuarioLogeado[0]->instalacionesUsuario[0]->id;

            //Obtengo el usuario logeado.
            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            //Obtengo la instalacion a la que pertenece el usuario logeado.
            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            //Obtengo los muelles a los que pertenece el usuario logeado.
            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();

            //Obtengo las plazas a las que pertenece el usuario logeado.
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
                        array_push($embarcaciones, $embarcacione);
                    }
                }
            }

            //Obtengo los clientes a las que pertenece el usuario logeado.
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

            dd($embarcacionesOrdenado);
        }

        return view('cliente.index', compact('clientesOrdenado'))->with('i', 0);
    }

    public function create()
    {
        $cliente = new Cliente();
        $telefono = new Telefono();

        return view('cliente.create', compact('cliente', 'telefono'));
    }

    public function store(Request $request)
    {
        request()->validate(Cliente::$rules);
        $cliente = Cliente::create($request->all());
        $telefono = Telefono::create(['idCliente' => $request->numDocumento, 'numero' => $request->telefono]);

        return redirect()->route('clientes.index')
            ->with('correcto', 'Cliente creado con exito.');
    }

    public function show($numDocumento)
    {
        $cliente = Cliente::find($numDocumento);
        $telefonos = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];
        $telefonos = (object) $telefonos;

        return view('cliente.show', compact('cliente', 'telefonos'));
    }

    public function edit($numDocumento)
    {
        $cliente = Cliente::find($numDocumento);
        $telefono = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];
        $telefono = (object) $telefono;

        return view('cliente.edit', compact('cliente', 'telefono'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        request()->validate(Cliente::$rules);

        $cliente->update($request->all());
        $cliente->telefonos()->update(['numero' => $request->telefono]);


        return redirect()->route('clientes.index')
            ->with('correcto', 'Cliente actualizado con exito');
    }

    public function destroy($numDocumento)
    {
        $cliente = Cliente::where('numDocumento', $numDocumento)->delete();
        $telefono = Telefono::where('idCliente', $numDocumento)->delete();

        return redirect()->route('clientes.index')
            ->with('correcto', 'Cliente borrado con exito');
    }
}
