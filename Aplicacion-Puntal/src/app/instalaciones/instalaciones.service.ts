import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class InstalacionesService {

  constructor(private http: HttpClient) { }

  retornar() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos");
  }  
  retornarUno() {
    return this.http.get("https://jsonplaceholder.typicode.com/todos/1");
  } 
}

