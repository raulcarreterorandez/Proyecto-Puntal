export interface Muelle {

    id?: any;
    idInstalacion?: any;   
    visto?: boolean;
    instalacion?: any; //Traeremos una colección con las propiedades de las instalaciones. Mirar como traemos la info. en el Index() de API/MuelleController del backend. 
    plazas?:any; //Traeremos una colección con las propiedades de las plazas. Mirar como traemos la info. en el Index() de API/MuelleController del backend. 
    plazasTotales?:any; //Traeremos un count() de plazas. Mirar como traemos la info. en el Show() de API/MuelleController del backend. 
    plazasDisponibles?:any; //Traeremos un count() de las plazas disponibles. Mirar como traemos la info. en el Show() de API/MuelleController del backend. 
    plazasOcupadas?:any; //Traeremos un count() de las plazas disponibles. Mirar como traemos la info. en el Show() de API/MuelleController del backend. 
}


// RETURN DEL INDEX DEL BACKEND(API/MuelleController).
/* 
return $muelles->with('instalacion','plazas')->get(); // Pasamos la relación con Instalaciones y con Plazas para poder hacer uso de sus propiedades 
    // en el frontend de Angular. En este caso queremos visualizar datos de las Instalaciones o las Plazas en las vistas de Muelles. Lo devuelve en formato colección. 
*/

// RETURN DEL SHOW DEL BACKEND(API/MuelleController).
/* 
return [ //Especificamos la forma en la que recibimos los datos.
"id"=>$muelle->id,
"idInstalacion"=>$muelle->idInstalacion,
"visto"=>$muelle->visto,
"instalacion"=>$muelle->instalacion,
"plazasTotales"=>count($plazas->get()), // Nº total de plazas del muelle.
"plazasDisponibles"=>count($plazas->where('disponible',1)->get()), // Solo las plazas disponibles.
];
*/