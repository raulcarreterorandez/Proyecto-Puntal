<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use App\Models\Muelle;
use Illuminate\Http\Request;


class PlazaController extends Controller {
    public function index() {

        $plazas = Plaza::paginate();

        return view('plaza.index', compact('plazas'))
            ->with('i', (request()->input('page', 1) - 1) * $plazas->perPage());
    }

    public function create() {

        // Cuando creamos una plaza debe estar asignada a un muelle obligatoriamente. Mostraremos los muelles existentes.
        $plaza = new Plaza();
        $muelles = Muelle::all()->pluck('id', 'id'); //El pluck devuelve un array de clave valor. primero clave y luego valor.

        return view('plaza.create', compact('plaza', 'muelles'));
    }

    public function store(Request $request) {

        request()->validate(Plaza::$rules);

        $plaza = Plaza::create($request->all());

        return redirect()->route('plazas.index')
            ->with('success', 'Plaza created successfully.');
    }

    public function show($id) {

        $plaza = Plaza::find($id);

        return view('plaza.show', compact('plaza'));
    }

    public function edit($id) {

        // Cuando modificamos una plaza debemos poder cambiar el muelle al que pertenece. Mostraremos los muelles existentes.
        $plaza = Plaza::find($id);
        $muelles = Muelle::all()->pluck('id', 'id'); //El pluck devuelve un array de clave valor. primero clave y luego valor.

        return view('plaza.edit', compact('plaza', 'muelles'));
    }

    public function update(Request $request, Plaza $plaza) {

        request()->validate(Plaza::$rules);

        $plaza->update($request->all());

        return redirect()->route('plazas.index')
            ->with('success', 'Plaza updated successfully');
    }

    public function destroy($id) {

        $plaza = Plaza::find($id)->delete();

        return redirect()->route('plazas.index')
            ->with('success', 'Plaza deleted successfully');
    }
}
