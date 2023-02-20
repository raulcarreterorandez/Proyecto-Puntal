<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Instalacion;
use App\Models\Muelle;
use App\Models\Plaza;
use App\Models\Transito;
use Illuminate\Http\Request;


class TransitoController extends Controller {

    public function index() {
        //Necesitamos mostrar únicamente los tránsitos(plazas) de los muelles pertenecientes a las instalaciones en las que esté habilitado en usuario.

        $transito = Transito::with('muelle');
        //dd($transito->muelle->idInstalacion);

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones.
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones.
            $transitos = Transito::all(); // Recogemos todos los transitos.

        } else { //Si no mostramos unicamente los transitos(plazas) de los muelles pertenecientes a las instalaciones relacionadas con el usuario.

            // Traemos a todos los transito (con las relaciones a Muelles)
            // Filtramos los usuarios, para traer los que tengan los mismos puertos relacionados que el usuario logeado.
            $transitos = Transito::with('muelle')->whereHas('muelle', function ($query) use ($usuarioLogeado) {

                // Filtramos para que el idInstalacion sea el mismo que el puerto relacionado con el usuario logueado (tantas veces como puertos tenga)
                $query->where(function ($query) use ($usuarioLogeado) {
                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {
                        $query->orWhere('idInstalacion', $instalacion->id);
                    }
                });
            })->get();
        }

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

        /* $plazas = Plaza::find($transito["idPlaza"]); //Buscamos la plaza asociadda a esa base.
        $plazas->disponible = 0; //cambiamos el valor de disponible de la plaza.
        $plazas->update(); //Actualizamos la plaza para hacer permanentes los cambios. */

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

        return redirect()->route('transitos.index')
            ->with('success', 'Transito deleted successfully');
    }
}
