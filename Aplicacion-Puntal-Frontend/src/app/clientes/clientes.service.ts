import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Cliente } from './cliente';

@Injectable({
  providedIn: 'root'
})
export class ClientesService {

  public url: string;

  constructor(private http: HttpClient) {
    this.url = "http://localhost/api/clientes";
  }

  retornarClientes(): Observable<Cliente[]> {
    return this.http.get<Cliente[]>(this.url);
  }

  retornarUnCliente(numDocumento: any): Observable<Cliente> {
    return this.http.get(`${this.url}/${numDocumento}`);
  }
}
