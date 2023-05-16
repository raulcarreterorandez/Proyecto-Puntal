<?php

namespace App\Http\Controllers;

use App\Models\Embarcacione;
use App\Models\Servicio;
use App\Models\Usuario;
use App\Models\Muelle;
use App\Models\Plaza;
use Illuminate\Http\Request;

class ServicioController extends Controller
{

    // Para proteger las rutas tienes 2 opciones:
    //  - except: para indicar a que métodos no se les aplicará el middleware.
    //  - only: para indicar los métodos a los que se les aplicaría el middleware.
    public function __construct()
    { // Copia Instalación.

        $this->middleware('gerencia')->except(['index', 'show']); // Desde Gerencia hacia arriba, es decir Xunta se encargan de todo. 
        $this->middleware('guarda-muelle')->only(['index', 'show']); // Desde Guarda-muelles, pasando por Policía hasta Gerencia solo acceden a show e index.
    }


    public function index()
    {
        //Necesitamos mostrar únicamente los muelles de las instalaciones en las que esté habilitado en usuario.

        //Obtengo el usuario logeado.
        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        // Where() devuelve siempre una colección de tipo Array. Aunque solo devuelva un elemento.

        // Accedemos al elemento que nos interesa dentro del Array obtenido, en este caso solo hay uno, y a su "colección" de instalaciones. 
        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id == 0) { // Si el usuario tiene acceso a todos los puertos lo tiene a los muelles creados en dichas instalaciones. 
            $servicios = Servicio::all(); // Recogemos todos los muelles disponibles.

        } else { //Si no, mostramos unicamente los muelles pertenecientes a las instalaciones relacionadas con el usuario.
            // Es decir, las instalaciones donde esté habilitado el usuario logeado.

            //Obtengo el usuario logeado.
            $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();

            //Obtengo la instalacion a la que pertenece el usuario logeado.
            $instalaciones = $usuarioLogeado[0]->instalacionesUsuario->toArray();

            //Obtengo los muelles a los que pertenece el usuario logeado.
            $muelles = Muelle::where('idInstalacion', $instalaciones)->get()->toArray();


            //Obtengo las plazas pertenecientes a la Instalacion a las que pertenece el usuario logeado.
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
                        array_push($embarcaciones, $embarcacione[0]);
                    }
                }
            }

            //Obtengo los servicios que pertenecen al usuario logeado.
            $servicios = [];
            for ($a = 0; $a < count($embarcaciones); $a++) {
                for ($i = 0; $i < count($embarcaciones[$a]); $i++) {
                    $servicio = Servicio::where('matricula', $embarcaciones[$a][$i])->get()->toArray();                    
                    array_push($servicios, $servicio[0]);   
                    
                }
            }
        }

        return view('servicio.index', compact('servicios'))
            ->with('i', 0 /* (request()->input('page', 1) - 1) * $muelles->perPage() */);
    }


    public function create()
    {

        // Cuando creamos un servicio necesitamos ver las embarcaciones creadas, dado que un servicio siempre va asociado a un muelle.
        $servicio = new Servicio();

        $embarcaciones = Embarcacione::all()->pluck('matricula', 'nombre'); // Mostraremos 

        return view('servicio.create', compact('servicio', 'embarcaciones'));
    }

    public function store(Request $request)
    {

        request()->validate(Servicio::$rules);

        /* $servicio = Servicio::create($request->all()); */
        Servicio::create($request->all());

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio created successfully.');
    }

    public function show($id)
    {

        $servicio = Servicio::find($id);

        return view('servicio.show', compact('servicio'));
    }


    public function edit($id)
    {

        $servicio = Servicio::find($id);
        $embarcaciones = Embarcacione::all()->pluck('matricula', 'nombre');

        return view('servicio.edit', compact('servicio', 'embarcaciones'));
    }


    public function update(Request $request, Servicio $servicio)
    {

        request()->validate(Servicio::$rules);

        $servicio->update($request->all());

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio updated successfully');
    }


    public function destroy($id)
    {

        /* $servicio = Servicio::find($id)->delete(); */
        Servicio::find($id)->delete();

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio deleted successfully');
    }
}
