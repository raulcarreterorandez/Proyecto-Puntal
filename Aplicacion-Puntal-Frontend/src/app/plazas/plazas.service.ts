import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Plaza } from './plaza';


@Injectable({
  providedIn: 'root'
})
export class PlazasService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/plazas";
  }


  retornar(): Observable<Plaza[]> { /* Observable<any>  */
    return this.http.get<Plaza[]>(this.url);
  }

  retornarUno(id: any): Observable<Plaza> {
    return this.http.get(`${this.url}/${id}`);
  }
}
