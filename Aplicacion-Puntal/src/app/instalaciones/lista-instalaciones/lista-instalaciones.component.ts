import { Component, OnInit } from '@angular/core';
import { Instalacion } from '../instalacion';
import { InstalacionesService } from '../instalaciones.service';

@Component({
  selector: 'app-lista-instalaciones',
  templateUrl: './lista-instalaciones.component.html',
  styleUrls: ['./lista-instalaciones.component.css']
})
export class ListaInstalacionesComponent implements OnInit {

  /*  instalaciones: any; */
  instalaciones?: Instalacion[];
  currentInstalacion: Instalacion = {};
  /* currentIndex = -1;
  title = ''; */

  constructor(private instalacionesService: InstalacionesService) { }

  /* 
     ngOnInit() {
     this.instalacionesService.retornar()
       .subscribe( result =>  this.instalaciones = result)
   } 
   */

  ngOnInit(): void {
    this.recuperaInstalaciones();
  }

  recuperaInstalaciones(): void {
    this.instalacionesService.retornar()
      .subscribe({
        next: (data) => {
          this.instalaciones = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }
}
