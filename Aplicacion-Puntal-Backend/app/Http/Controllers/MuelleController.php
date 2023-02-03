<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Muelle;
use Illuminate\Http\Request;


class MuelleController extends Controller {

    public function index() {

        $muelles = Muelle::paginate();

        return view('muelle.index', compact('muelles'))
            ->with('i', (request()->input('page', 1) - 1) * $muelles->perPage());
    }

    public function create() {

        // Cuando creamos un muelle necesitamos ver las instalaciones creadas, dado que un muelle siempre va asociado a una instalación.
        $muelle = new Muelle();

        $instalaciones = Instalacion::all()->pluck('nombrePuerto', 'id'); // Mostraremos 

        return view('muelle.create', compact('muelle', 'instalaciones'));
    }

    public function store(Request $request) {

        request()->validate(Muelle::$rules);

        $muelle = Muelle::create($request->all());

        return redirect()->route('muelles.index')
            ->with('success', 'Muelle created successfully.');
    }

    public function show($id) {

        $muelle = Muelle::find($id);

        return view('muelle.show', compact('muelle'));
    }

    public function edit($id) {

        $muelle = Muelle::find($id);
        $instalaciones = Instalacion::all()->pluck('nombrePuerto','id');

        return view('muelle.edit', compact('muelle', 'instalaciones'));
    }

    public function update(Request $request, Muelle $muelle) {
        request()->validate(Muelle::$rules);

        $muelle->update($request->all());

        return redirect()->route('muelles.index')
            ->with('success', 'Muelle updated successfully');
    }

    public function destroy($id) {
        $muelle = Muelle::find($id)->delete();

        return redirect()->route('muelles.index')
            ->with('success', 'Muelle deleted successfully');
    }
}
