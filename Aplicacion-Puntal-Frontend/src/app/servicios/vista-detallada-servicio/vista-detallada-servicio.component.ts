import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Servicio } from '../servicio';
import { ServiciosService } from '../servicios.service';


@Component({
  selector: 'app-vista-detallada-servicio',
  templateUrl: './vista-detallada-servicio.component.html',
  styleUrls: ['./vista-detallada-servicio.component.css']
})
export class VistaDetalladaServicioComponent implements OnInit{

  servicio: any;
  message = '';

  constructor(
    private serviciosService: ServiciosService,
    private route: ActivatedRoute,
    private router: Router) { }


  @Input() viewMode = false;

  @Input() currentServicio: Servicio = {

    id: '',
    matriculaEmbarcacion: '',   
    tipoServicio: '',
    precioHora: '', 
    abonado: '',  
    finalizado: '',
    numHoras: '', 
    fechaSolicitud: '', 
    embarcacion:''
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getServicio(this.route.snapshot.params["id"]);

    }
  }

  getServicio(id: string): void {
    this.serviciosService.retornarUno(id)
      .subscribe({
        next: (data) => {
          this.currentServicio = data;
        },
        error: (e) => console.error(e)
      });
  }

}
