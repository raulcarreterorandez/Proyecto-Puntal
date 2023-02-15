import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Mensaje } from './mensaje';

@Injectable({
  providedIn: 'root'
})
export class MensajesService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/mensajes";
   }

  retornar(): Observable<Mensaje[]> {
    return this.http.get<Mensaje[]>(this.url);
  }

  retornarUno(id: any): Observable<Mensaje> {

    return this.http.get(`${this.url}/${id}`);

  }

}
