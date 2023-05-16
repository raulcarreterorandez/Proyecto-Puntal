<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Usuario;
use Illuminate\Http\Request;


class InstalacionController extends Controller {

 // Para proteger las rutas tienes 2 opciones:
     //  - except: para indicar a que métodos no se les aplicará el middleware.
     //  - only: para indicar los métodos a los que se les aplicaría el middleware.    
    public function __construct() { //Middlewares

        $this->middleware('gerencia')->only(['index','show']); //Acceden solo a show e index.
        $this->middleware('xunta')->except(['index','show']); // Se encargan de todo.
    }

    public function index() {

        //Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Si el usuario tiene acceso a todos los puertos, le pasamos todos los puertos disponibles.
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $instalaciones = Instalacion::all();
        }
        else{ //Si no mostramos unicamente los puertos relacionados con el usuario.

            $instalaciones = Instalacion::where(function ($query){

                $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get(); //Obtengo el usuario logeado.

                $query ->where(function ($query) use ($usuarioLogeado){
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        // dd($instalacion->id);
                        $query->orWhere("id", $instalacion->id);
                    }
                });
            })->get(); //Modificar para datables a un all(), no paginate();
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
