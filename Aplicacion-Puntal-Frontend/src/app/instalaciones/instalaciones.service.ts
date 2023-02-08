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

    this.url = "https://jsonplaceholder.typicode.com/todos";
   }

/*   retornar() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos");
  }   */
/*   retornarUno() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos/1");
  }  */

  retornar(): Observable<Instalacion[]> { /* Observable<any>  */
    return this.http.get<Instalacion[]>("https://jsonplaceholder.typicode.com/todos");/* ("https://localhost/api/instalaciones") */
  }

  //MÍO:

  retornarUno(id: any): Observable<Instalacion> {
    return this.http.get(`${"https://jsonplaceholder.typicode.com/todos"}/${id}`);
  }

 /*  retornarUno(id: any) {
    return this.http.get(this.url+"/"+id);
  } */
}

