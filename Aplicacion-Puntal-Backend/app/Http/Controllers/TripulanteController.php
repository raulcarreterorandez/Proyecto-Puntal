<?php

namespace App\Http\Controllers;

use App\Models\Tripulante;
use Illuminate\Http\Request;
use App\Models\Transito;
use App\Models\Embarcacione;

class TripulanteController extends Controller
{
    public function index()
    {
        $tripulantes = Tripulante::paginate();

        return view('tripulante.index', compact('tripulantes'))
            ->with('i', (request()->input('page', 1) - 1) * $tripulantes->perPage());
    }

    public function create()
    {
        $tripulante = new Tripulante();
        $embarcaciones = Embarcacione::all()->pluck('matricula', 'matricula');

        return view('tripulante.create', compact('tripulante', 'embarcaciones',));
    }

    public function store(Request $request)
    {
        $plaza = Embarcacione::where('matricula', $request->id_embarcacion)->get()->toArray()[0];
        $plaza = $plaza['id_plaza'];

        $request->merge(['id_plaza' => $plaza]);
        request()->validate(Tripulante::$rules);

        $tripulante = Tripulante::create($request->all());

        return redirect()->route('tripulantes.index')
            ->with('correcto', 'Tripulante creado con éxito.');
    }

    public function show($numDocumento)
    {
        $tripulante = Tripulante::where("numDocumento", $numDocumento)->get()->toArray()[0];
        $tripulante = (object) $tripulante;

        return view('tripulante.show', compact('tripulante'));
    }

    public function edit($numDocumento)
    {
        $tripulante = Tripulante::where("numDocumento", $numDocumento)->get()->toArray()[0];
        $tripulante = (object) $tripulante;
        $plazas = Transito::all()->pluck('idPlaza', 'idPlaza');
        $embarcaciones = Embarcacione::all()->pluck('matricula', 'matricula');

        return view('tripulante.edit', compact('tripulante', 'plazas', 'embarcaciones'));
    }

    public function update(Request $request, Tripulante $tripulante)
    {
        $plaza = Embarcacione::where('matricula', $request->id_embarcacion)->get()->toArray()[0];
        $plaza = $plaza['id_plaza'];
        $request->merge(['id_plaza' => $plaza]);

        request()->validate(Tripulante::$rules);
        $tripulante->update($request->all());

        return redirect()->route('tripulantes.index')
            ->with('correcto', 'Tripulante actualizado con éxito');
    }

    public function destroy($numDocumento)
    {
        Tripulante::where("numDocumento", $numDocumento)->delete();

        return redirect()->route('tripulantes.index')
            ->with('correcto', 'Tripulante borrado con éxito');
    }
}
