<?php

namespace App\Http\Controllers;

use App\Models\Tripulante;
use Illuminate\Http\Request;
use App\Models\Transito;
use App\Models\Embarcacione;
use App\Models\Usuario;
use App\Models\Muelle;
use App\Models\Plaza;

class TripulanteController extends Controller{

    public function __construct() { // Copia Instalación.

        $this->middleware('guarda-muelle'); // Desde Guarda-muelles hacia arriba, pasando por Gerencia y Xunta acceden a todo.
    }

    public function index() {

        ///Necesitamos mostrar únicamente las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

        //Si el usuario tiene acceso a todos los puertos, le pasamos todos los puertos disponibles
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) {
            $tripulantesOrdenado = Tripulante::all();
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

            //Obtengo los transitos a los que pertenece el usuario logeado.
            $transitos = [];
            for ($a = 0; $a < count($plazas); $a++) {
                for ($i = 0; $i < count($plazas[$a]); $i++) {
                    $transito = Transito::where('idPlaza', $plazas[$a][$i])->get()->toArray();
                    if (isset($transito[0]["idPlaza"])) {
                        array_push($transitos, $transito);
                    }
                }
            }

            //Obtengo los tripulantes que pertenecen el usuario logeado.
            $tripulantes = [];
            for ($a = 0; $a < count($transitos); $a++) {
                for ($i = 0; $i < count($transitos[$a]); $i++) {
                    $tripulante = Tripulante::where('id_plaza', $transitos[$a][$i])->get()->toArray();
                    if (isset($tripulante[0]["numDocumento"])) {
                        array_push($tripulantes, $tripulante);
                    }
                }
            }

            $tripulantesOrdenado = [];
            for ($a = 0; $a < count($tripulantes); $a++) {
                for ($i = 0; $i < count($tripulantes[$a]); $i++) {
                    array_push($tripulantesOrdenado, $tripulantes[$a][$i]);
                }
            }
        } // fin del else

        return view('tripulante.index', compact('tripulantesOrdenado'))->with('i', 0);
    }

    public function create() {
        $tripulante = new Tripulante();
        $plazas = Transito::all()->pluck('idPlaza', 'idPlaza');
        $embarcaciones = Embarcacione::all()->pluck('matricula', 'matricula');

        return view('tripulante.create', compact('tripulante', 'embarcaciones', 'plazas'));
    }

    public function store(Request $request) {
        $plaza = Embarcacione::where('matricula', $request->id_embarcacion)->get()->toArray()[0];
        $plaza = $plaza['id_plaza'];

        $request->merge(['id_plaza' => $plaza]);
        request()->validate(Tripulante::$rules);

        $tripulante = Tripulante::create($request->all());

        return redirect()->route('tripulantes.index')
            ->with('correcto', 'Tripulante creado con éxito.');
    }

    public function show($numDocumento) {

        $tripulante = Tripulante::where("numDocumento", $numDocumento)->get()->toArray()[0];
        $tripulante = (object) $tripulante;

        return view('tripulante.show', compact('tripulante'));
    }

    public function edit($numDocumento) {

        $tripulante = Tripulante::where("numDocumento", $numDocumento)->get()->toArray()[0];
        $tripulante = (object) $tripulante;
        $plazas = Transito::all()->pluck('idPlaza', 'idPlaza');
        $embarcaciones = Embarcacione::all()->pluck('matricula', 'matricula');

        return view('tripulante.edit', compact('tripulante', 'plazas', 'embarcaciones'));
    }

    public function update(Request $request, Tripulante $tripulante) {
        $plaza = Embarcacione::where('matricula', $request->id_embarcacion)->get()->toArray()[0];
        $plaza = $plaza['id_plaza'];
        $request->merge(['id_plaza' => $plaza]);

        request()->validate(Tripulante::$rules);
        $tripulante->update($request->all());

        return redirect()->route('tripulantes.index')
            ->with('correcto', 'Tripulante actualizado con éxito');
    }

    public function destroy($numDocumento) {

        Tripulante::where("numDocumento", $numDocumento)->delete();

        return redirect()->route('tripulantes.index')
            ->with('correcto', 'Tripulante borrado con éxito');
    }
}
