import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Cliente } from './cliente';
import { EmbarcacionesCliente } from './embarcacionesCliente';

@Injectable({
  providedIn: 'root'
})
export class ClientesService {

  public urlClientes: string;

  constructor(private http: HttpClient) {
    this.urlClientes = "http://localhost/api/clientes";
  }

  retornarClientes(): Observable<Cliente[]> {
    return this.http.get<Cliente[]>(this.urlClientes);
  }

  retornarUnCliente(id: any): Observable<Cliente> {
    return this.http.get(`${this.urlClientes}/${id}`);
  }
}
