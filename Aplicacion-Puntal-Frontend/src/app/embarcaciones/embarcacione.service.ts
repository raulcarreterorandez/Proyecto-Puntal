import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Embarcacione } from './embarcacione';

@Injectable({
  providedIn: 'root'
})
export class EmbarcacioneService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/embarcaciones";

  }

  retornar(): Observable<Embarcacione[]> {
    return this.http.get<Embarcacione[]>(this.url);
  }

  retornarUno(matricula: any): Observable<Embarcacione> {
    return this.http.get(`${this.url}/${matricula}`);
  }
}
