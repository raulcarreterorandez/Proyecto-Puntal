import { Component,OnInit } from '@angular/core';
import { InstalacionesService } from '../instalaciones.service';

@Component({
  selector: 'app-lista-instalacion',
  templateUrl: './lista-instalacion.component.html',
  styleUrls: ['./lista-instalacion.component.css']
})
export class ListaInstalacionComponent implements OnInit{

  instalaciones: any;

  constructor(private instalacionesService: InstalacionesService) {}

  ngOnInit() {
    this.instalacionesService.retornar()
      .subscribe( result =>  this.instalaciones = result)
  }
}
