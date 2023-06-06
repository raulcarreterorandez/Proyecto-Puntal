import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Muelle } from './muelle';

@Injectable({
  providedIn: 'root'
})

export class MuellesService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/muelles";    
  }

/*   retornar() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos"); API DE PRUEBA
  }   */
/*   retornarUno() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos/1"); API DE PRUEBA
  }  */

  retornar(): Observable<Muelle[]> { /* Observable<any>  */
    return this.http.get<Muelle[]>(this.url);
    /* return this.http.get<Muelle[]>("https://localhost/api/muelles") */
  }  

  retornarUno(id: any): Observable<Muelle> {
    return this.http.get(`${this.url}/${id}`);
  }
}
