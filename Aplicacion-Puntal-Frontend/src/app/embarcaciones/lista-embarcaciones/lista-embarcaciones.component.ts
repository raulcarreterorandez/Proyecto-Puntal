import { Component } from '@angular/core';
import { Embarcacione } from '../embarcacione';
import { EmbarcacioneService } from '../embarcacione.service';


@Component({
  selector: 'app-lista-embarcaciones',
  templateUrl: './lista-embarcaciones.component.html',
  styleUrls: ['./lista-embarcaciones.component.css']
})
export class ListaEmbarcacionesComponent {

  embarcaciones?: Embarcacione[];

  dtOptions: DataTables.Settings = {};

  constructor(private embarcacioneService: EmbarcacioneService) { }

  ngOnInit(): void {
    this.recuperaEmbarcaciones();

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

  recuperaEmbarcaciones(): void {
    this.embarcacioneService.retornar()
      .subscribe({
        next: (data) => {
          this.embarcaciones = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }

}
