<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Embarcacione;
use App\Models\Instalacion;
use App\Models\Muelle;
use App\Models\Plaza;
use App\Models\Tripulante;
use App\Models\Usuario;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class PlazaController extends Controller {

    public function index() {

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
        return $plazas;
    }

    public function show($id) {

        $muelle = Muelle::with('instalacion')->find($id); // Recogemos los muelles con su relación a instalaciones. Queremos mostrar el código y alguna cosa más de ahí.

        $plaza = Plaza::with('transito', 'bases')->find($id); // Recogemos las plazas con su relación a tránsitos y bases. Queremos mostrar de que tipo són(bases o tránsitos).

        $tripulantes = Tripulante::where('id_plaza',$id)->get(); // Devolvemos una colección con los tripulantes donde su idPlaza sea el mismo que el de nuestra plaza a mostrar.

        $embarcacion = Embarcacione::where('id_plaza',$id)->get(); // Devolvemos una colección pero con un solo elemento. Solo hay una embarcación por plaza.

        $cliente = Cliente::with('embarcaciones','telefonos')->find($embarcacion[0]->id_cliente);

        if ($plaza->transito == null && $plaza->bases == null) { // Si los dos campos están en null...

            // La plaza está vacía.
            $plaza->tipo = "Disponible"; // Creamos un nuevo campo en la colección(tipo) que manejaremos a nuestro antojo.

        } else if ($plaza->transito == null) { // Si tránsito es null...

            $plaza->tipo = "Base"; // La plaza es de tipo base.
            $plaza->fechaEntrada = $plaza->bases->fechaEntrada;
        } else {  // Si base es null...

            $plaza->tipo = "Transito"; // La plaza es de tipo tránsito.
            $plaza->fechaEntrada = $plaza->transito->fechaSalida;
        }

        return [ //Especificamos la forma en la que recibimos los datos.
            "id" => $plaza->id,
            "disponible" => $plaza->disponible,
            "visto" => $plaza->visto,
            "puertoOrigen" => $plaza->puertoOrigen,
            "puertoDestino" => $plaza->puertoDestino,
            "anyo" => $plaza->anyo,
            "idMuelle" => $plaza->idMuelle,
            "tipo" => $plaza->tipo,
            "instalacion" => $muelle->instalacion, // Colección con la info de la instalación a la que pertenece el muelle.
            "bases" => $plaza->bases,
            "transitos" => $plaza->transito,
            "tripulantes" => $tripulantes,
            "embarcacion" => $embarcacion[0], // Especificamos la posicion para devolver un único elemento y no toda la colección. Así no jhay que recorrerlo en la vista con un forEach().
            "cliente" => $cliente
        ];
    }

    public function historialPlazas(){

        $usuarioLogeado = Usuario::with('instalacionesUsuario')->where('email', '=', auth()->user()->email)->get();
        $plazas = Plaza::with('transito', 'bases')->where('disponible',0);

        if ($usuarioLogeado[0]->instalacionesUsuario[0]->id != 0) {

            $plazas->with('muelle');
            $plazas = $plazas->whereHas('muelle',function ($query) use ($usuarioLogeado) {

                // $query-> where('disponible',0);
                $query->where(function($query) use ($usuarioLogeado){

                    foreach ($usuarioLogeado[0]->instalacionesUsuario as $instalacion) {

                        $query->orWhere('idInstalacion',$instalacion->id);
                    }
                });
            })->without('muelle');
        }

        $plazas=$plazas->get();

        // LA FECHA DE HOY **ENTERO Y STRING**
        $now = new DateTime('now', new DateTimeZone("Europe/Madrid"));
        $hoyNum = strtotime( $now->format('Y-m-d H:i:s') );

        foreach ($plazas as $plaza) {
            // SALE ERROR DE UNDEFINED, PERO FUNCIONA

            // TIPO DE EMBARCACION (BASE o TRANSITO)
            if ($plaza->transito == null) {
                $plaza->tipo = "Base";
            }
            else{
                $plaza->tipo = "Transito";
            }

            // FECHA (Salida de la embarcacion o entrada de la embarcacion)
            // ACCION (si es salida o entrada a la plaza)
            //dependiendo de la fecha que cojamos previamente

            // Almacenamos en formato entero y string de las fechas de entrada y salida **PLAZA BASE O TRANSITO**
            if($plaza->tipo == "Transito"){
                // ENTERO
                $fechaEntradaNum = strtotime( $plaza->transito->fechaEntrada );
                $fechaSalidaNum = strtotime( $plaza->transito->fechaSalida );
                // STRING
                $fechaEntrada = $plaza->transito->fechaEntrada;
                $fechaSalida = $plaza->transito->fechaSalida;

            }
            else{
                // ENTERO
                $fechaEntradaNum = strtotime( $plaza->bases->fechaEntrada );
                $fechaSalidaNum = strtotime( $plaza->bases->fechaSalida );
                //STRING
                $fechaEntrada = $plaza->bases->fechaEntrada;
                $fechaSalida = $plaza->bases->fechaSalida;

            }

            // Comprobamos la diferencia de dias con la fecha de entrada con la de hoy
            if($fechaEntradaNum < $hoyNum){
                $diferenciaDiasEntrada = $hoyNum - $fechaEntradaNum;
            }
            else{
                $diferenciaDiasEntrada = $fechaEntradaNum - $hoyNum;
            }

            // Comprobamos la diferencia de dias con la fecha de salida con la de hoy
            if($fechaSalidaNum < $hoyNum){
                $diferenciaDiasSalida = $hoyNum - $fechaSalidaNum;
            }
            else{
                $diferenciaDiasSalida = $fechaSalidaNum - $hoyNum;
            }

            // Quien tenga la diferencia de dias mas pequeña, sera la fecha y la accion del historico
            if($diferenciaDiasEntrada < $diferenciaDiasSalida){
                $plaza->fecha = $fechaEntrada;
                $plaza->accion = "REGISTRO DE ENTRADA";

            }
            else{
                $plaza->fecha = $fechaSalida;
                $plaza->accion = "REGISTRO DE SALIDA";

            }

            // EMBARCACION QUE ESTA EN LA PLAZA
            $embarcacion = Embarcacione::orWhere('id_plaza',$plaza->id)->get();
            $plaza-> embarcacionId = $embarcacion[0]->matricula;

            // CLIENTE QUE ESTA EN LA PLAZA
            $cliente = Cliente::find($embarcacion[0]->id_cliente);
            $plaza->clienteId = $cliente->nombre." ".$cliente->nombre;

            // INSTALACION EN LA QUE ESTA LA PLAZA
            $muelle = Muelle::find($plaza->idMuelle);
            $instalacion = Instalacion::find($muelle->idInstalacion);
            $plaza->instalacionId = $instalacion->nombrePuerto;


        }

        return $plazas;

    }

    public function historialPlaza($id){

        $plaza = Plaza::with('transito','bases')->find($id);


        $embarcacion = Embarcacione::where('id_plaza', $id)->get();
        $cliente = Cliente::with('embarcaciones','telefonos')->find($embarcacion[0]->id_cliente);

        $muelle = Muelle::find($plaza->idMuelle);
        $instalacion = Instalacion::find($muelle->idInstalacion);

        //Dejamos el campo visto y lo actualizamos en la base de da
        $historicoVisto= clone $plaza;
        $historicoVisto->visto=1;
        $plaza->update($historicoVisto->toArray());

        // CON LA PLAZA QUE TENEMOS -> AVERIGUAMOS SI ES TRANSITO O BASE
        if ($plaza->transito == null) {

            $plaza->tipo = "Base";
            $plaza->fechaEntrada = $plaza->bases->fechaEntrada;
            $plaza->fechaSalida = $plaza->bases->fechaSalida;
        } else {

            $plaza->tipo = "Transito";
            $plaza->fechaEntrada = $plaza->transito->fechaEntrada;
            $plaza->fechaSalida = $plaza->transito->fechaSalida;
        }

        // SABIENDO EL TIPO DE PLAZA, AVERIGUAMOS QUE TIPO DE ACCION ES DEL HISTORICO

            // LA FECHA DE HOY **ENTERO Y STRING**
            $now = new DateTime('now', new DateTimeZone("Europe/Madrid"));
            $hoyNum = strtotime( $now->format('Y-m-d H:i:s') );

            // Almacenamos en formato entero y string de las fechas de entrada y salida **PLAZA BASE O TRANSITO**
            if($plaza->tipo == "Transito"){

                $fechaEntradaNum = strtotime( $plaza->transito->fechaEntrada );
                $fechaSalidaNum = strtotime( $plaza->transito->fechaSalida );
            }
            else{

                $fechaEntradaNum = strtotime( $plaza->bases->fechaEntrada );
                $fechaSalidaNum = strtotime( $plaza->bases->fechaSalida );
            }

            // Comprobamos la diferencia de dias con la fecha de entrada con la de hoy
            if($fechaEntradaNum < $hoyNum){
                $diferenciaDiasEntrada = $hoyNum - $fechaEntradaNum;
            }
            else{
                $diferenciaDiasEntrada = $fechaEntradaNum - $hoyNum;
            }

            // Comprobamos la diferencia de dias con la fecha de salida con la de hoy
            if($fechaSalidaNum < $hoyNum){
                $diferenciaDiasSalida = $hoyNum - $fechaSalidaNum;
            }
            else{
                $diferenciaDiasSalida = $fechaSalidaNum - $hoyNum;
            }

            // Quien tenga la diferencia de dias mas pequeña, sera la fecha y la accion del historico
            if($diferenciaDiasEntrada < $diferenciaDiasSalida){

                $accion = "REGISTRO DE ENTRADA";
            }
            else{

                $accion = "REGISTRO DE SALIDA";
            }

            $tripulantes = Tripulante::where('id_plaza',$id)->get();


        return [
            'accionId'=>$accion,
            'plaza'=>$plaza,
            'embarcacion' => $embarcacion[0],
            'cliente' => $cliente,
            'puerto' => $instalacion,
            'tripulantes'=> $tripulantes
        ];
    }


    // LO QUE DEVUELVE LA LLAMADA A LA API DEL SHOW PLAZA( localhost/api/plazas/108 )
   /*  {      // LA INFORMACIÓN DE LA PLAZA A MOSTRAR.
        "id": 108,
        "disponible": 0,
        "visto": 1,
        "puertoOrigen": "Norman Wells",
        "puertoDestino": "Basse Terre",
        "anyo": "1985",
        "idMuelle": 108,
        "tipo": "Transito",
        "instalacion": {   // LA INSTALACIÓN A LA QUE PERTENECE DICHA PLAZA.
            "id": 4,
            "codigo": "KP-96",
            "nombrePuerto": "Port-au-Prince",
            "descripcion": "Abierto de 8:00 a 20:00",
            "estado": "Mantenimiento",
            "visto": 1,
            "fechaDisposicion": "2008-07-14 11:10:02"
        },
        "bases": null,   // LA INFORMACIÓN DE BASE DE DICHA PLAZA.
        "transitos": {   // LA INFORMACIÓN DEL TRÁNSITO DE DICHA PLAZA.
            "idPlaza": 108,
            "fechaEntrada": "2021-11-16 00:17:04",
            "fechaSalida": "2022-09-17 14:28:42"
        },
        "tripulantes": [  // LOS TRIPULANTES ASIGNADOS A ESTA PLAZA(ÚNICAMENTE EN TRÁNSITOS).
            {
                "numDocumento": "documento-54",
                "nombre": "Virgil",
                "apellidos": "MacMenamin",
                "nacionalidad": "China",
                "fechaNacimiento": "1980-04-25",
                "lugarNacimiento": "Xiangfu",
                "paisNacimiento": "Ecuador",
                "tipoDocumento": "DNI",
                "fechaExpedicionDocumento": "2016-10-07",
                "fechaCaducidadDocumento": "2028-01-29",
                "id_plaza": 108,
                "id_embarcacion": "matricula-554"
            },
            {
                "numDocumento": "documento-554",
                "nombre": "Wynnie",
                "apellidos": "Slopier",
                "nacionalidad": "China",
                "fechaNacimiento": "1993-01-27",
                "lugarNacimiento": "Gulong",
                "paisNacimiento": "China",
                "tipoDocumento": "DNI",
                "fechaExpedicionDocumento": "2015-09-06",
                "fechaCaducidadDocumento": "2028-05-24",
                "id_plaza": 108,
                "id_embarcacion": "matricula-554"
            }
        ],
        "embarcacion": {      // LAS EMBARCACION QUE ESTÁ ASIGNADA EN DICHA PLAZA
            "matricula": "matricula-554",
            "nombre": "Hevea",
            "eslora": "19.48m",
            "manga": "3.28m",
            "calado": "13.89m",
            "propulsion": "Motor",
            "id_cliente": "documento-554",
            "id_plaza": 108
        },
        "cliente": {           // EL CLIENTE AL QUE PERTENECE DICHA EMBARCACIÓN
            "numDocumento": "documento-554",
            "nombre": "Devan",
            "apellidos": "Duffet",
            "email": "dduffetfd@cnn.com",
            "direccion": "73191 Eastwood Center",
            "tipoDocumento": "NIE",
            "observaciones": "Llamar para cumplimientos de pagos",
            "embarcaciones": [     // LAS EMBARCACIONES QUE PERTENECEN A DICHO CLIENTE
                {
                    "matricula": "matricula-554",
                    "nombre": "Hevea",
                    "eslora": "19.48m",
                    "manga": "3.28m",
                    "calado": "13.89m",
                    "propulsion": "Motor",
                    "id_cliente": "documento-554",
                    "id_plaza": 108
                }
            ],
            "telefonos": [
                {
                    "numero": "+62-820-713-8058",
                    "idCliente": "documento-554"
                }
            ]
        }
    } */
}
