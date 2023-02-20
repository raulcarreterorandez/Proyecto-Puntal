<?php

namespace App\Http\Controllers;

use App\Models\Embarcacione;
use Illuminate\Http\Request;
use App\Models\Plaza;
use App\Models\Muelle;
use App\Models\Usuario;
use App\Models\Cliente;

class EmbarcacioneController extends Controller
{
    public function index()
    {

        /////////////////////////////////////////////////////////////////////////////////////////////////
        /////Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario./////
        /////////////////////////////////////////////////////////////////////////////////////////////////

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        //Si el usuario tiene acceso a todos los puertos, le pasamos todos los puertos disponibles
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $clientes = Cliente::all();
        } else { //Si no mostramos unicamente los puertos relacionados con el usuario

            //$muelles = $usuarioLogeado[0]->instalacionesUsuario[0]->id;

            //Obtengo el usuario logeado.
            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            //Obtengo la instalacion a la que pertenece el usuario logeado.
            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            //Obtengo los muelles a los que pertenece el usuario logeado.
            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();

            //Obtengo las plazas a las que pertenece el usuario logeado.
            $plazas = [];
            for ($i = 0; $i < count($muelles); $i++) {
                $plaza = Plaza::where('idMuelle', $muelles[$i])->get()->toArray();
                array_push($plazas, $plaza);
            }

            //Obtengo las embarcaciones a las que pertenece el usuario logeado.
            $embarcaciones = [];
            for ($a = 0; $a < count($plazas); $a++) {
                for ($i = 0; $i < count($plazas[$a]); $i++) {
                    $embarcacione = Embarcacione::where('id_plaza', $plazas[$a][$i])->get()->toArray();
                    if (isset($embarcacione[0]["matricula"])) {
                        array_push($embarcaciones, $embarcacione);
                    }
                }
            }
        }

        return view('embarcacione.index', compact('embarcaciones'))->with('i', 0);

        // return view('embarcacione.index', compact('embarcaciones'))
        //     ->with('i', (request()->input('página', 1) - 1) * $embarcaciones->perPage());
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
        // $embarcacione = Embarcacione::where('matricula', $matricula)->get()->toArray()[0];
        // $embarcacione = (object) $embarcacione;
        $embarcacione = Embarcacione::find($matricula);

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
