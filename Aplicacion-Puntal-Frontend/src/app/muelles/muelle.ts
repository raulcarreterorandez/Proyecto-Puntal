export interface Muelle {

    id?: any;
    idInstalacion?: any;   
    visto?: boolean;
    instalacion?: any; //Traeremos una colección con las propiedades de las instalaciones. Mirar como traemos la info. en API/MuelleController del backend.
    plazasTotales?:any; //Traeremos una colección con las propiedades de las plazas. Mirar como traemos la info. en API/MuelleController del backend.
    plazasDisponibles?:any; //Traeremos una colección con las propiedades de las plazas. Mirar como traemos la info. en API/MuelleController del backend.
}
