import { Component, OnInit } from '@angular/core';
import { Mensaje } from '../mensaje';
import { MensajesService } from '../mensajes.service';

@Component({
  selector: 'app-lista-mensajes',
  templateUrl: './lista-mensajes.component.html',
  styleUrls: ['./lista-mensajes.component.css']
})
export class ListaMensajesComponent implements OnInit{
  mensajes?: Mensaje[];
  currentInstalacion: Mensaje = {};

  dtOptions: DataTables.Settings = {};

  constructor(private mensajesService: MensajesService) { }

  ngOnInit(): void {
    this.recuperaInstalaciones();

    this.dtOptions = {
      order:[],
      pagingType: 'full_numbers',
      scrollY: '500px',
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
      columnDefs: [{
        width: "70px",
        targets: 0
      }],
      // columns:[
      //   {data:'Acciones', name:'Acciones', orderable:false, searchable:false}
      // ],
    };
  }

  recuperaInstalaciones(): void {
    this.mensajesService.retornar()
      .subscribe({
        next: (data) => {
          this.mensajes = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }
}
