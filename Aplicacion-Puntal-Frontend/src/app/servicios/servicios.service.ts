import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Servicio } from './servicio';

@Injectable({
  providedIn: 'root'
})

export class ServiciosService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/servicios";
  }

  retornar(): Observable<Servicio[]> { 
    return this.http.get<Servicio[]>(this.url);
  }  

  retornarUno(id: any): Observable<Servicio> {
    return this.http.get(`${this.url}/${id}`);
  }
}
