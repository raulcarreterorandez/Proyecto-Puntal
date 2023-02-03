<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use Illuminate\Http\Request;


class InstalacionController extends Controller {

    public function index() {

        $instalaciones = Instalacion::paginate();

        return view('instalacione.index', compact('instalaciones'))
            ->with('i', (request()->input('page', 1) - 1) * $instalaciones->perPage());
    }

    public function create() {

        $instalacion = new Instalacion();
        return view('instalacion.create', compact('instalacion'));
    }

    public function store(Request $request) {
        
        request()->validate(Instalacion::$rules);

        $instalacion = Instalacion::create($request->all());

        return redirect()->route('instalaciones.index')
            ->with('success', 'Instalacion created successfully.');
    }

    public function show($id) {

        $instalacion = Instalacion::find($id);

        return view('instalacion.show', compact('instalacion'));
    }

    public function edit($id) {

        $instalacion = Instalacion::find($id);

        return view('instalacion.edit', compact('instalacion'));
    }

    public function update(Request $request, Instalacion $instalacion  ) {

        request()->validate(Instalacion::$rules);

        $instalacion->update($request->all());

        return redirect()->route('instalaciones.index')
            ->with('success', 'Instalacione updated successfully');
    }

    public function destroy($id) {

        $instalacion = Instalacion::find($id)->delete();

        return redirect()->route('instalaciones.index')
            ->with('success', 'Instalacione deleted successfully');
    }
}
