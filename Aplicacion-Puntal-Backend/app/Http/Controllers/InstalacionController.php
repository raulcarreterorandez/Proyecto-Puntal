<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Usuario;
use Illuminate\Http\Request;


class InstalacionController extends Controller {

    public function index() {
        //Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones.
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos...
           $instalaciones = Instalacion::all(); // Recogemos todos los puertos disponibles.
        }
        else{ //Si no mostramos unicamente los puertos relacionados con el usuario. Es decir, las instalaciones donde esté habilitado el usuario logeado.

            $instalaciones = Instalacion::where(function ($query) use ($usuarioLogeado){

                foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) { //Recorremos la coleccion de instalaciones del usuario.
                    // dd($instalacion->id);
                    $query->orWhere("id", $instalacion->id); // Las instalaciones que tengan relación con el usuario a través de la tabla instalacionesUsuarios.
                }

            })->get(); // Recogemos las instalaciones
        }

        // dd($instalaciones);

        return view('instalacion.index', compact('instalaciones'))
            ->with('i', 0 /* (request()->input('page', 1) - 1) * $instalaciones->perPage() (Cambios por dataTables)*/);
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

    public function update(Request $request, $instalacion) {

        request()->validate(Instalacion::$rules);

        $instalacion = Instalacion::find($instalacion);

        $instalacion->update($request->all());
        //dump($instalacion);
        //dd($request->all());
        //dd($request->id, $request->codigo);

        return redirect()->route('instalaciones.index')
            ->with('success', 'Instalacione updated successfully');
    }

    public function destroy($id) {

        $instalacion = Instalacion::find($id)->delete();

        return redirect()->route('instalaciones.index')
            ->with('success', 'Instalacione deleted successfully');
    }
}
