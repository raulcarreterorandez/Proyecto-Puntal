import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Tripulante } from './tripulante';

@Injectable({
  providedIn: 'root'
})
export class TripulanteService {

  public url: string;

  constructor(private http: HttpClient) {
    this.url = "http://localhost/api/tripulantes";
  }

  retornarUno(numDocumento: any): Observable<Tripulante> {
    return this.http.get(`${this.url}/${numDocumento}`);
  }
}
