import { Component } from '@angular/core';
import { Cliente } from '../cliente';
import { ClientesService } from '../clientes.service';

@Component({
  selector: 'app-lista-clientes',
  templateUrl: './lista-clientes.component.html',
  styleUrls: ['./lista-clientes.component.css']
})
export class ListaClientesComponent {

  clientes?: Cliente[];
  currentCliente: Cliente = {};

  dtOptions: DataTables.Settings = {};

  constructor(private clientesService: ClientesService) { }

  ngOnInit(): void {
    this.recuperaClientes();

    this.dtOptions = {
      pagingType: 'full_numbers',
      scrollY: '600px',
      scrollCollapse: true,
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

  recuperaClientes(): void {
    this.clientesService.retornarClientes()
      .subscribe({
        next: (data) => {
          this.clientes = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }

}
