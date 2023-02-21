import { Component, OnInit } from '@angular/core';
import { Instalacion } from '../instalacion';
import { InstalacionesService } from '../instalaciones.service';

@Component({
  selector: 'app-lista-instalaciones',
  templateUrl: './lista-instalaciones.component.html',
  styleUrls: ['./lista-instalaciones.component.css']
})
export class ListaInstalacionesComponent implements OnInit {


  instalaciones?: Instalacion[];
  currentInstalacion: Instalacion = {}; 

  dtOptions: DataTables.Settings = {};

  constructor(private instalacionesService: InstalacionesService) { }

  /* 
     ngOnInit() {
     this.instalacionesService.retornar()
       .subscribe( result =>  this.instalaciones = result)
   } 
   */

  ngOnInit(): void {
    this.recuperaInstalaciones();

    this.dtOptions = {
      pagingType: 'full_numbers',
      scrollY: '600px',
      scrollCollapse:true,      
      language: {
        processing: "Procesando...",
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron resultados",
        emptyTable: "Ningún dato disponible en esta tabla",
        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
        infoFiltered: "(filtrado de un total de _MAX_ registros)",
        search: "Buscar:",
        loadingRecords: "Cargando...",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "Siguiente",
          previous: "Anterior"
        },
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      },
    };
  }

  recuperaInstalaciones(): void {
    this.instalacionesService.retornar()
      .subscribe({
        next: (data) => {
          this.instalaciones = data;
          /* console.log(data); */
        },
        error: (e) => console.error(e)
      });
  }
}
