<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Instalacion;
use App\Models\Muelle;
use Illuminate\Http\Request;


class MuelleController extends Controller {

    public function __construct() {
        $this->middleware('auth')->only(['index','show']); 
        $this->middleware('gerencia')->except(['index','show']);
    }

    public function index() {
        //Necesitamos mostrar únicamente los muelles de las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            $muelles = Muelle::all(); // Recogemos todos los muelles disponibles.

        } else { //Si no mostramos unicamente los muelles pertenecientes a las instalaciones relacionadas con el usuario.
                // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            $muelles = Muelle::where(function ($query) use ($usuarioLogeado) {

                foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) { //Recorremos la coleccion de instalaciones del usuario.
                    // dd($instalacion->id);
                    $query->orWhere("idInstalacion", $instalacion->id); // Los muelles pertenecientes a las instalaciones relacionadas con el usuario a través de la tabla instalacionesUsuarios.
                }
            })->get();
        }

        return view('muelle.index', compact('muelles'))
            ->with('i', 0 /* (request()->input('page', 1) - 1) * $muelles->perPage() */);
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
        $instalaciones = Instalacion::all()->pluck('nombrePuerto', 'id');

        return view('muelle.edit', compact('muelle', 'instalaciones'));
    }

    public function update(Request $request, Muelle $muelle) {

        request()->validate(Muelle::$rules);

        /* $muelle = Muelle::find($muelle); */

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
