<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use App\Models\Cliente;
use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    public function index()
    {
        $telefonos = Telefono::paginate();

        return view('telefono.index', compact('telefonos'))
            ->with('i', (request()->input('page', 1) - 1) * $telefonos->perPage());
    }

    public function create()
    {
        $clientes = Cliente::all()->pluck('numDocumento', 'numDocumento');
        $telefono = new Telefono();
        return view('telefono.create', compact('telefono', 'clientes'));
    }

    public function store(Request $request)
    {
        request()->validate(Telefono::$rules);

        $telefono = Telefono::create($request->all());

        return redirect()->route('telefonos.index')
            ->with('correcto', 'Teléfono creado con éxito.');
    }

    public function show($numero)
    {
        $telefono = Telefono::where('numero', $numero)->get()->toArray()[0];
        $telefono = (object) $telefono;

        return view('telefono.show', compact('telefono'));
    }

    public function edit($numero)
    {

        $telefono = Telefono::where('numero', $numero)->get()->toArray()[0];
        $telefono = (object) $telefono;
        $clientes = Cliente::all()->pluck('numDocumento', 'numDocumento');

        return view('telefono.edit', compact('telefono', 'clientes'));
    }

    public function update(Request $request, Telefono $telefono)
    {
        request()->validate(Telefono::$rules);

        $telefono->update($request->all());

        return redirect()->route('telefonos.index')
            ->with('correcto', 'Teléfono actualizado con éxito');
    }

    public function destroy($numero)
    {
        $telefono = Telefono::where('numero', $numero)->delete();

        return redirect()->route('telefonos.index')
            ->with('correcto', 'Teléfono borrado con éxito');
    }
}
