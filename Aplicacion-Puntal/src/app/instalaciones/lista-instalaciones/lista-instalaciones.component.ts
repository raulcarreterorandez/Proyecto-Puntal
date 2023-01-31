import { Component, OnInit } from '@angular/core';
import { InstalacionesService } from '../instalaciones.service';

@Component({
  selector: 'app-lista-instalaciones',
  templateUrl: './lista-instalaciones.component.html',
  styleUrls: ['./lista-instalaciones.component.css']
})
export class ListaInstalacionesComponent implements OnInit{
  instalaciones: any;

  constructor(private instalacionesService: InstalacionesService) {}

  ngOnInit() {
    this.instalacionesService.retornar()
      .subscribe( result =>  this.instalaciones = result)
  }
}
