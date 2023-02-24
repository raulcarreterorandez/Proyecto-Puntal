import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Instalacion } from './instalacion';


@Injectable({
  providedIn: 'root'
})

export class InstalacionesService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/instalaciones";    
  }

/*   retornar() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos"); API DE PRUEBA
  }   */
/*   retornarUno() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos/1"); API DE PRUEBA
  }  */

  retornar(): Observable<Instalacion[]> { /* Observable<any>  */
    return this.http.get<Instalacion[]>(this.url);
    /* return this.http.get<Instalacion[]>("https://localhost/api/instalaciones") */
  }  

  retornarUno(id: any): Observable<Instalacion> {
    return this.http.get(`${this.url}/${id}`);
  }

}

