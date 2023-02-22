<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Embarcacione;
use App\Models\Instalacion;
use App\Models\Muelle;
use App\Models\Plaza;
use App\Models\Telefono;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct() { // Copia Instalación.
            
        $this->middleware('guarda-muelle'); // Desde Guarda-muelles hacia arriba, pasando por Gerencia y Xunta acceden a todo. 
    }
    
    public function index() {
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

        return view('cliente.index', compact('clientesOrdenado'))->with('i', 0);
    }

    public function create() {
        $cliente = new Cliente();
        $telefono = new Telefono();

        return view('cliente.create', compact('cliente', 'telefono'));
    }

    public function store(Request $request) {
        request()->validate(Cliente::$rules);
        $cliente = Cliente::create($request->all());
        $telefono = Telefono::create(['idCliente' => $request->numDocumento, 'numero' => $request->telefono]);

        return redirect()->route('clientes.index')
            ->with('correcto', 'Cliente creado con exito.');
    }

    public function show($numDocumento) {

        $cliente = Cliente::find($numDocumento);
        $telefonos = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];
        $telefonos = (object) $telefonos;

        $embarcaciones = Embarcacione::where('id_cliente', $numDocumento)->get();

        return view('cliente.show', compact('cliente', 'telefonos'));
    }

    public function edit($numDocumento) {

        $cliente = Cliente::find($numDocumento);
        $telefono = Telefono::where('idCliente', $numDocumento)->get()->toArray()[0];
        $telefono = (object) $telefono;

        return view('cliente.edit', compact('cliente', 'telefono'));
    }

    public function update(Request $request, Cliente $cliente) {

        request()->validate(Cliente::$rules);

        $cliente->update($request->all());
        $cliente->telefonos()->update(['numero' => $request->telefono]);


        return redirect()->route('clientes.index')
            ->with('correcto', 'Cliente actualizado con exito');
    }

    public function destroy($numDocumento) {
        
        $cliente = Cliente::where('numDocumento', $numDocumento)->delete();
        $telefono = Telefono::where('idCliente', $numDocumento)->delete();

        return redirect()->route('clientes.index')
            ->with('correcto', 'Cliente borrado con exito');
    }
}
