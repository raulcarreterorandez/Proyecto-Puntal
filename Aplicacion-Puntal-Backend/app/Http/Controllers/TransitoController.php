<?php

namespace App\Http\Controllers;

use App\Models\Transito;
use App\Models\Plaza;
use Illuminate\Http\Request;


class TransitoController extends Controller {

    public function index() {
        $transitos = Transito::all();/* paginate() */

        return view('transito.index', compact('transitos'))
            ->with('i', 0 /* (request()->input('page', 1) - 1) * $transitos->perPage() */);
    }

    public function create() {

        // Cuando creamos un transito queremos que este unido a una plaza ya creada y que la plaza este disponible.
        $transito = new Transito();
        $plazas = Plaza::all()->where('disponible', '1')->pluck('id', 'id'); //Seleccionamos solo las plazas que estén disponibles y solo mostramos el id
        return view('transito.create', compact('transito', 'plazas'));
    }

    public function store(Request $request) {

        //Cuando creamos el tránsito necesitamos que la plaza asociada deje de estar disponible.
        request()->validate(Transito::$rules);

        $transito = Transito::create($request->all());

        $plazas = Plaza::find($transito["idPlaza"]); //Buscamos la plaza asociadda a esa base.
        $plazas->disponible = 0; //cambiamos el valor de disponible de la plaza.
        $plazas->update(); //Actualizamos la plaza para hacer permanentes los cambios.

        return redirect()->route('transitos.index')
            ->with('success', 'Transito created successfully.');
    }

    public function show($id) {

        $transito = Transito::find($id);

        return view('transito.show', compact('transito'));
    }

    public function edit($id) {

        // Cuando editamos un transito queremos que muestre las plazas creadas que estén disponibles.
        $transito = Transito::find($id);

        $plazas = Plaza::all()->where('disponible', '1')->pluck('id', 'id'); 

        return view('transito.edit', compact('transito', 'plazas'));
    }

    public function update(Request $request, Transito $transito) {

        request()->validate(Transito::$rules);

        $transito->update($request->all());

        return redirect()->route('transitos.index')
            ->with('success', 'Transito updated successfully');
    }

    public function destroy($id) {

        //Cuando destruimos el tránsito necesitamos que la plaza asociada vuelva a estar disponible.
        $transito = Transito::find($id)->delete();

        $plazas = Plaza::find($id); //Buscamos la plaza asociada a ese tránsito(mismo ID).
        $plazas->disponible = 1; //Cambiamos el valor del campo disponible de la plaza.
        $plazas->update(); //Actualizamos la plaza para hacer permanentes los cambios.

        return redirect()->route('bases.index')
            ->with('success', 'Transito deleted successfully');
    }
}
