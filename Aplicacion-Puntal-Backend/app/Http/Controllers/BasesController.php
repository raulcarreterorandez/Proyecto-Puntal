<?php

namespace App\Http\Controllers;

use App\Models\Bases;
use App\Models\Plaza;
use Illuminate\Http\Request;

class BasesController extends Controller {

    public function index() {

        $bases = Bases::paginate();

        return view('bases.index', compact('bases'))
            ->with('i', (request()->input('page', 1) - 1) * $bases->perPage());
    }

    public function create() {

        $bases = new Bases();
        $plazas = Plaza::all()->where('disponible', '1')->pluck('id', 'id');  //Seleccionamos solo las plazas que estén disponibles y solo mostramos el id

        return view('bases.create', compact('bases', 'plazas'));
    }

    public function store(Request $request) {

        //Cuando creamos la base necesitamos que la plaza asociada deje de estar disponible.
        request()->validate(Bases::$rules);

        $bases = Bases::create($request->all());
        $plazas = Plaza::find($bases["idPlaza"]); //Buscamos la plaza asociadda a esa base.

        $plazas->disponible = 0; //cambiamos el valor de disponible de la plaza.

        $plazas->update(); //Actualizamos la plaza para hacer permanentes los cambios.       

        //    dd($plazas);

        return redirect()->route('bases.index')
            ->with('success', 'Basis created successfully.');
    }

    public function show($id) {
        $bases = Bases::find($id);

        return view('bases.show', compact('bases'));
    }

    public function edit($id) {

        //Cuando editamos una base necesitamos poder modificar la plaza asociada. Mostraremos las plazas creadas y disponiles.
        $bases = Bases::find($id);
        $plazas = Plaza::all()->where('disponible', '1')->pluck('id', 'id'); 

        return view('bases.edit', compact('bases', 'plazas'));
    }

    public function update(Request $request, Bases $bases) {

        request()->validate(Bases::$rules);

        $bases->update($request->all());

        return redirect()->route('bases.index')
            ->with('success', 'Bases updated successfully');
    }

    public function destroy($id) {

        //Cuando destruimos la base necesitamos que la plaza asociada vuelva a estar disponible.
        $bases = Bases::find($id)->delete();
        
        $plazas = Plaza::find($id); //Buscamos la plaza asociada a esa base(mismo ID).

        $plazas->disponible = 1; //Cambiamos el valor del campo disponible de la plaza.

        $plazas->update(); //Actualizamos la plaza para hacer permanentes los cambios.

        return redirect()->route('bases.index')
            ->with('success', 'Bases deleted successfully');
    }
}
