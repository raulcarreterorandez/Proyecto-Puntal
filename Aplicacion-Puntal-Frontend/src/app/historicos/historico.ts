export interface Historico{
// Campos de la API index()
  id?: any;
  disponible?: boolean;
  visto?: boolean;
  puertoOrigen?: string;
  puertoDestino?: string;
  anyo?: any;
  idMuelle?: any;
  tipo?:any;
  fecha?:any;
  accion?:any;
  embarcacionId?:any;
  instalacionId?:any;
  clienteId?:any;



  // Objetos con informacion
  transito?:any;
  bases?:any;
    // Objetos en la llamada show() de API
  plaza?:any;
  embarcacion?:any;
  cliente?:any;
  puerto?:any;
  accionId?:any;
  tripulantes?:any;


// Campos sin valor que modificaremos
  fechaSalida?:any;

}
