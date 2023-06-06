import { Component, OnInit } from '@angular/core';
import { Servicio } from '../servicio';
/* import { ServiciosService } from '../servicios.service'; */
import { ServiciosService } from '../servicios.service';

@Component({
  selector: 'app-lista-servicios',
  templateUrl: './lista-servicios.component.html',
  styleUrls: ['./lista-servicios.component.css']
})
export class ListaServiciosComponent implements OnInit {

  servicios?: Servicio[];
  currentServicio: Servicio = {};

  dtOptions: DataTables.Settings = {};

  constructor(private ServiciosService: ServiciosService) { }

  ngOnInit(): void {
    this.recuperaServicios();

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

  recuperaServicios(): void {
    this.ServiciosService.retornar()
      .subscribe({
        next: (data) => {
          this.servicios = data;
        },
        error: (e) => console.error(e)
      });
  }

}
