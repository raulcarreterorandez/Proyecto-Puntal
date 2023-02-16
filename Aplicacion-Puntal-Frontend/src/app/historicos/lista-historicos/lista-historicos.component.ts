import { Component } from '@angular/core';
import { Historico } from '../historico';
import { HistoricosService } from '../historicos.service';

@Component({
  selector: 'app-lista-historicos',
  templateUrl: './lista-historicos.component.html',
  styleUrls: ['./lista-historicos.component.css']
})
export class ListaHistoricosComponent {

  historicos?:Historico[];
  currentHistorico:Historico={};

  dtOptions: DataTables.Settings = {};

  constructor(private historicosService: HistoricosService) { }

  ngOnInit(): void {
    this.recuperaHistoricos();

    this.dtOptions = {
      order:[[1,'desc']], //Ordenamos por las fechas (columna 2) de mas actual a mas vieja
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

  recuperaHistoricos(): void {
    this.historicosService.retornar()
      .subscribe({
        next: (data) => {
          this.historicos = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }
}
