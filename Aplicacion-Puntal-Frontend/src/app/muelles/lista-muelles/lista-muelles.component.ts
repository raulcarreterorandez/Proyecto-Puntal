import { Component, OnInit } from '@angular/core';
import { Muelle } from '../muelle';
import { MuellesService } from '../muelles.service';

@Component({
  selector: 'app-lista-muelles',
  templateUrl: './lista-muelles.component.html',
  styleUrls: ['./lista-muelles.component.css']
})
export class ListaMuellesComponent implements OnInit {

  muelles?: Muelle[];
  currentMuelle: Muelle = {};

  dtOptions: DataTables.Settings = {};


  constructor(private muellesService: MuellesService) { }
  /* 
    Servicio sin Observable
     ngOnInit() {
     this.muellesService.retornar()
       .subscribe( result =>  this.muelles = result)
   } 
   */

   ngOnInit(): void {
    this.recuperaMuelles();

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

  recuperaMuelles(): void {
    this.muellesService.retornar()
      .subscribe({
        next: (data) => {
          this.muelles = data;
          /* console.log(data); */
        },
        error: (e) => console.error(e)
      });
  }

}
