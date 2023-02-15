import { Component, OnInit } from '@angular/core';
import { Plaza } from '../plaza';
import { PlazasService } from '../plazas.service';

@Component({
  selector: 'app-lista-plazas',
  templateUrl: './lista-plazas.component.html',
  styleUrls: ['./lista-plazas.component.css']
})
export class ListaPlazasComponent implements OnInit {

  plazas?: Plaza[];
  currentPlaza: Plaza = {};

  dtOptions: DataTables.Settings = {};

  constructor(private plazasService:PlazasService) { }

  ngOnInit(): void {
    this.recuperaPlazas();
  
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

  

  recuperaPlazas():void {
    this.plazasService.retornar()
      .subscribe({
        next: (data) => {
          this.plazas = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }
}
