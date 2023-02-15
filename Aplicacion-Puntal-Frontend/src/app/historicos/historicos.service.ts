import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Historico } from './historico';

@Injectable({
  providedIn: 'root'
})
export class HistoricosService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/historial";
   }

  retornar(): Observable<Historico[]> {
    return this.http.get<Historico[]>(this.url);
  }

  retornarUno(id: any): Observable<Historico> {
    return this.http.get(`${this.url}/${id}`);

  }
}
