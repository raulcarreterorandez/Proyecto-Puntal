<?php

namespace App\Http\Controllers;

use App\Models\Embarcacione;
use Illuminate\Http\Request;
use App\Models\Plaza;
use App\Models\Cliente;

class EmbarcacioneController extends Controller
{
    public function index()
    {
        $embarcaciones = Embarcacione::paginate();

        return view('embarcacione.index', compact('embarcaciones'))
            ->with('i', (request()->input('página', 1) - 1) * $embarcaciones->perPage());
    }

    public function create()
    {
        $embarcacione = new Embarcacione();
        $plazas = Plaza::all()->where('disponible', '=', '1')->pluck('id', 'id');
        $clientes = Cliente::all()->pluck('numDocumento', 'numDocumento');

        return view('embarcacione.create', compact('embarcacione', 'plazas', 'clientes'));
    }

    public function store(Request $request)
    {
        request()->validate(Embarcacione::$rules);

        // $eslora = $request->eslora . "m";
        // $manga = $request->manga . "m";
        // $calado = $request->calado . "m";
        // $request->merge(['eslora' => $eslora]);
        // $request->merge(['manga' => $manga]);
        // $request->merge(['calado' => $calado]);

        $embarcacione = Embarcacione::create($request->all());
        $plazas = Plaza::find($embarcacione["id_plaza"]);
        $plazas->disponible = 0;
        $plazas->update();

        return redirect()->route('embarcaciones.index')
            ->with('correcto', 'Embarcación creada con exito.');
    }

    public function show($matricula)
    {
        $embarcacione = Embarcacione::where('matricula', $matricula)->get()->toArray()[0];
        $embarcacione = (object) $embarcacione;

        return view('embarcacione.show', compact('embarcacione'));
    }

    public function edit($matricula)
    {
        $embarcacione = Embarcacione::find($matricula);

        $plaza = Plaza::find($embarcacione["id_plaza"]);
        $plaza->disponible = 1;
        $plaza->update();

        $plazas = Plaza::all()->where('disponible', '=', '1')->pluck('id', 'id')->toArray();

        $clientes = Cliente::all()->pluck('numDocumento', 'numDocumento');

        return view('embarcacione.edit', compact('embarcacione', 'plazas', 'clientes'));
    }

    public function update(Request $request, Embarcacione $embarcacione)
    {
        request()->validate(Embarcacione::$rules);

        if ($request->id_plaza != $embarcacione->id_plaza) {
            $plazas = Plaza::find($embarcacione["id_plaza"]);
            $plazas->disponible = 1;
            $plazas->update();

            $plazas = Plaza::find($request['id_plaza']);
            $plazas->disponible = 0;
            $plazas->update();
        } else {
            $plazas = Plaza::find($embarcacione["id_plaza"]);
            $plazas->disponible = 0;
            $plazas->update();
        }

        // $eslora = $request->eslora . "m";
        // $manga = $request->manga . "m";
        // $calado = $request->calado . "m";
        // $request->merge(['eslora' => $eslora]);
        // $request->merge(['manga' => $manga]);
        // $request->merge(['calado' => $calado]);

        $embarcacione->update($request->all());
        $embarcacione->tripulantes()->update(['id_plaza' => $request->id_plaza]);

        return redirect()->route('embarcaciones.index')
            ->with('correcto', 'Embarcación actualizada con éxito');
    }

    public function destroy($matricula)
    {
        $plazas = Embarcacione::where('matricula', $matricula)->get()->toArray()[0];
        $plazas = Plaza::find($plazas['id_plaza']);
        $plazas->disponible = 1;
        $plazas->update();

        $embarcacione = Embarcacione::where('matricula', $matricula)->delete();

        return redirect()->route('embarcaciones.index')
            ->with('correcto', 'Embarcación borrada con éxito');
    }
}
