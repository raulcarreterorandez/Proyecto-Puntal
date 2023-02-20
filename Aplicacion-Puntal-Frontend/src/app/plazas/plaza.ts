

/* export interface Plaza {  ANTIGUO

    id?: any;
    disponible?: boolean;
    visto?: boolean;
    puertoOrigen?: string;
    puertoDestino?: string;
    anyo?: any;
    idMuelle?: any;
    instalacion?: any; //Traeremos una colección con las propiedades de las instalaciones. Mirar como traemos la info. en el Index() de API/MuelleController del backend. 
    plazas?:any; //Traeremos una colección con las propiedades de las plazas. Mirar como traemos la info. en el Index() de API/MuelleController del backend. 
    tipo?:any
} */


export interface Plaza { //NUEVO

    id?: any;
    disponible?: boolean;
    visto?: boolean;
    puertoOrigen?: string;
    puertoDestino?: string;
    anyo?: any;
    idMuelle?: any;
    bases?: any;
    transitos?: any;
    instalacion?: any; //Traeremos una colección con las propiedades de las instalaciones. Mirar como traemos la info. en el Index() de API/MuelleController del backend. 
    plazas?:any; //Traeremos una colección con las propiedades de las plazas. Mirar como traemos la info. en el Index() de API/MuelleController del backend. 
    tipo?:any;
    tripulantes?:any;
    embarcacion?:any;
    cliente?:any;
}