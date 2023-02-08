<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Embarcacione;
use App\Models\Instalacion;
use App\Models\Muelle;
use App\Models\Plaza;
use Illuminate\Http\Request;

class PlazaController extends Controller {


    public function index() {
        $plazas = Plaza::all();

        return $plazas;
    }

    public function show($id) {
        $plazas = Plaza::find($id);

        return $plazas;
    }

    public function historialPlazas(){
        $plazas = Plaza::with('transito','bases')->get();

        return $plazas;
    }

    public function historialPlaza($id){
        $plaza = Plaza::with('transito','bases')->where('id',$id)->get();
        $embarcacion = Embarcacione::where('id_plaza', $id)->get();
        $cliente = Cliente::find($embarcacion[0]->id_cliente);

        $muelle = Muelle::find($plaza[0]->idMuelle);
        $instalacion = Instalacion::find($muelle->idInstalacion);

        return [
            'plaza'=>$plaza,
            'embarcacion' => $embarcacion,
            'cliente' => $cliente,
            'puerto' => $instalacion
        ];
    }
}
