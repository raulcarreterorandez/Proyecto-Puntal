import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Tripulante } from '../tripulante';
import { TripulanteService } from '../tripulante.service';

@Component({
  selector: 'app-vista-detallada-tripulantes',
  templateUrl: './vista-detallada-tripulantes.component.html',
  styleUrls: ['./vista-detallada-tripulantes.component.css']
})
export class VistaDetalladaTripulantesComponent {

  usuario: any;
  message = '';

  constructor(
    private tripulanteService: TripulanteService,
    private route: ActivatedRoute,
    private router: Router) { }

  @Input() viewMode = false;

  @Input() currentTripulante: Tripulante = {
    numDocumento: '',
    nombre: '',
    apellidos: '',
    nacionalidad: '',
    fechaNacimiento: '',
    lugarNacimiento: '',
    paisNacimiento: '',
    tipoDocumento: '',
    fechaExpedicionDocumento: '',
    fechaCaducidadDocumento: '',
    id_plaza: '',
    id_embarcacion: '',
    instalacion: ''
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getTripulante(this.route.snapshot.params["numDocumento"]);
    }
  }

  getTripulante(numDocumento: any): void {
    this.tripulanteService.retornarUno(numDocumento)
      .subscribe({
        next: (data) => {
          this.currentTripulante = data;
        },
        error: (e) => console.error(e)
      });
  }

}
