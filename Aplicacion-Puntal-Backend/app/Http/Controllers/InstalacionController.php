<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use App\Models\Usuario;
use Illuminate\Http\Request;


class InstalacionController extends Controller {

    public function index() {

        //Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario.

        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get(); //Obtengo el usuario logeado.

        // Si el usuario tiene acceso a todos los puertos, le pasamos todos los puertos disponibles
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
           $instalaciones = Instalacion::all();
        }
        else{ //Si no mostramos unicamente los puertos relacionados con el usuario
            
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
/*          Index Raul 
    public function index() {

        // Traemos a todos los usuarios (con las relaciones a Instalaciones) menos el usuario logueado
        $usuarios = Usuario::with('instalacionesUsuario')->where('email', '!=', auth()->user()->email);

        // Filtramos los usuarios, para traer los que tengan los mismos puertos relacionados que el usuario logeado
        $usuarios = $usuarios->whereHas('instalacionesUsuario', function ($query) {

            // Traemos todos los datos del usuario logueado y sus relaciones con los puertos
            $usuarioLogeado = Usuario::where("email", auth()->user()->email)->with('instalacionesUsuario')->get();

            // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga)
            $query->where(function ($query) use ($usuarioLogeado) {
                foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                    $query->orWhere('idInstalacion', $instalacion->id);
                }
            });
        })->get();

        return view('usuario.index', compact('usuarios'))->with('i', 0);
    } */

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
