export interface Instalacion {

  id?: any;
  codigo?: string;
  nombrePuerto?: string;
  descripcion?: string;
  estado?: string;
  visto?: boolean;
  fechaDisposicion?: any;  

  //CAMBIAR A CAMPOS DE INSTALACIÓN CUANDO LA API SEA FUNCIONAL    
  /*   userId?: any;
    id?: any;
    title?: string;
    completed?: boolean; */
}


/* 
  EJEMPLO JAVIER
  export class Empleado {

  constructor(
    public nombre: string, 
    public edad: number, 
    public cargo: string, 
    public contratado: number
    ) {  }
} */
