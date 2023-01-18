import { Component, OnInit } from '@angular/core';
import { InstalacionesService } from '../instalaciones.service';

@Component({
  selector: 'app-vista-detallada-instalacion',
  templateUrl: './vista-detallada-instalacion.component.html',
  styleUrls: ['./vista-detallada-instalacion.component.css']
})
export class VistaDetalladaInstalacionComponent implements OnInit{

  articulos: any;

  constructor(private instalacionesService: InstalacionesService) {}

  ngOnInit() {
    this.instalacionesService.retornar()
      .subscribe( result =>  this.articulos = result)
  }
}
