<?php

namespace App\Http\Controllers;

use App\Models\Bases;
use App\Models\Plaza;
use App\Models\Usuario;
use Illuminate\Http\Request;

class BasesController extends Controller {

    public function index() {
        //Necesitamos mostrar únicamente las bases(plazas) de los muelles pertenecientes a las instalaciones en las que esté habilitado en usuario.

        $bases = Bases::with('muelle');
        //dd($bases->muelle->idInstalacion);

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            $bases = Bases::all();/* paginate() */ // Recogemos todos los bases.

        } else { //Si no mostramos unicamente los bases(plazas) de los muelles pertenecientes a las instalaciones relacionadas con el usuario.

            // Traemos a todos los bases (con las relaciones a Muelles)
            // Filtramos los usuarios, para traer los que tengan los mismos puertos relacionados que el usuario logeado.
            $bases = Bases::with('muelle')->whereHas('muelle', function ($query) use ($usuarioLogeado) {

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga)   
                $query->where(function ($query) use ($usuarioLogeado) {
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion', $instalacion->id);
                    }
                });
            })->get();
        }

        return view('bases.index', compact('bases'))
            ->with('i', 0 /* (request()->input('page', 1) - 1) * $bases->perPage() */);
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

        /*  YA NO NOS INTERESA CAMBIAR EL DISPONIBLE DE LA PLAZA AQUÍ PORQUE SI NO A LA HORA DE CREAR UNA EMBARCACIÓN Y AÑADIRLO A UNA PLAZA NO APARECE EL ID DE LA PLAZA AL NO ESTAR YA DISPONIBLE.
            AHORA SETEAMOS EL DISPONIBLE=0 EN EL CONTROLADOR DE EMBARCACIONES.
        $plazas = Plaza::find($bases["idPlaza"]); //Buscamos la plaza asociadda a esa base.
        $plazas->disponible = 0; //cambiamos el valor de disponible de la plaza.
        $plazas->update(); //Actualizamos la plaza para hacer permanentes los cambios.     */   

        //    dd($plazas);

        return redirect()->route('bases.index')
            ->with('success', 'Bases created successfully.');
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
