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

          this.organizacionDatos(this.historicos);

          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }

  // TRATAMOS LOS DATOS QUE RECIBIMOS DE LA API
  organizacionDatos(historicos:any):void{
    for (const historico of historicos) {

      //EJEMPLO PARA TRATAR LOS DATOS DE LA TABLA
      if (historico.bases != null && historico.transito == null) {
        historico.bases = "SI";
        historico.transito = "NO";
        historico.tipo="BASE";
      }
      else if (historico.transito != null && historico.bases == null) {
        historico.transito = "SI";
        historico.bases = "NO";
        historico.tipo="TRANSITO";
      }
      else{
        historico.transito = "NO";
        historico.bases = "NO";
        historico.tipo="VACIO";
      }
    }
  }
}
