import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from './usuario';

@Injectable({
  providedIn: 'root'
})
export class UsuariosService {

  public url: string;

  constructor(private http: HttpClient) {

    this.url = "http://localhost/api/usuarios";
   }

  retornar(): Observable<Usuario[]> {
    return this.http.get<Usuario[]>(this.url);
  }

  retornarUno(email: any): Observable<Usuario> {
    // return this.http.get(this.url+"/"+email );
    return this.http.get(`${this.url}/${email}`);

  }

}

