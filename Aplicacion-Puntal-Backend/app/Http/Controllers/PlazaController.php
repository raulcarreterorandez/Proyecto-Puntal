<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use App\Models\Instalacion;
use App\Models\Muelle;
use App\Models\Plaza;
use Illuminate\Support\Facades\Auth;

class PlazaController extends Controller {

    // Para proteger las rutas tienes 2 opciones:
     //  - except: para indicar a que métodos no se les aplicará el middleware.
     //  - only: para indicar los métodos a los que se les aplicaría el middleware.

     public function __construct() { // Copia Instalación.
            
        $this->middleware('guarda-muelle'); // Desde Guarda-muelles hacia arriba, pasando por Gerencia y Xunta acceden a todo. 
    }

    public function index() {
        // dd(Auth::user());
        //Necesitamos mostrar únicamente las plazas de los muelles pertenecientes a las instalaciones en las que esté habilitado en usuario.

        // $plazas = Plaza::where('id',1)->with('muelle')->get();
        // dd($plazas[0]->muelle->idInstalacion);

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones y por tanto a todas las plazas. 
            $plazas = Plaza::all(); // Recogemos todas las plazas disponibles.

        } else { // Si no, mostramos unicamente las plazas de los muelles pertenecientes a las instalaciones relacionadas con el usuario.
                 // Es decir, las instalaciones donde esté habilitado el usuario logeado.
                 
            // Traemos todas las plazas y su relacion con muelles.
            $plazas = Plaza::with('muelle');

            // Filtramos las plazas, para traer las que tengan los mismos puertos relacionados que el usuario logeado.
            $plazas = $plazas->whereHas('muelle',function ($query) use ($usuarioLogeado) {             

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga).  
                $query->where(function($query) use ($usuarioLogeado){
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion',$instalacion->id);
                    }
                });

            })->get();
        }

        return view('plaza.index', compact('plazas'))
            ->with('i', 0);
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
        $muelles = Muelle::all()->pluck('id', 'id'); //El pluck devuelve un array de clave valor. Primero clave y luego valor.

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
