import { Component, OnInit } from '@angular/core';
import { InstalacionesService } from '../instalaciones.service';

@Component({
  selector: 'app-vista-detallada-instalacion',
  templateUrl: './vista-detallada-instalacion.component.html',
  styleUrls: ['./vista-detallada-instalacion.component.css']
})
export class VistaDetalladaInstalacionComponent implements OnInit{

  instalacion: any;

  constructor(private instalacionesService: InstalacionesService) {}

  ngOnInit() {
    /* this.instalacionesService.retornarUno(id)
      .subscribe( result =>  this.instalacion = result) */
  }
}
