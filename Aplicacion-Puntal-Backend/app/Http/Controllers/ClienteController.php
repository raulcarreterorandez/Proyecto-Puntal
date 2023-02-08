<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Telefono;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
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
