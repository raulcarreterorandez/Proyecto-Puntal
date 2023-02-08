import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Instalacion } from './instalacion';


@Injectable({
  providedIn: 'root'
})

export class InstalacionesService {

  constructor(private http: HttpClient) { }

/*   retornar() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos");
  }   */
/*   retornarUno() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos/1");
  }  */

  retornar(): Observable<Instalacion[]> { /* Observable<any>  */
    return this.http.get<Instalacion[]>("https://jsonplaceholder.typicode.com/todos");/* ("https://localhost/api/instalaciones") */
  }

  retornarUno(id: any): Observable<Instalacion> {
    return this.http.get(`${"https://jsonplaceholder.typicode.com/todos"}/${id}`);
  }
}

