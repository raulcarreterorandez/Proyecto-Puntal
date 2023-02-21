import { Component, Input, OnInit } from '@angular/core';
import { InstalacionesService } from '../instalaciones.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Instalacion } from '../instalacion';

@Component({
  selector: 'app-vista-detallada-instalacion',
  templateUrl: './vista-detallada-instalacion.component.html',
  styleUrls: ['./vista-detallada-instalacion.component.css']
})
export class VistaDetalladaInstalacionComponent implements OnInit {

  /* id: string; */
  instalacion: any;
  message = '';

  constructor(
    private instalacionesService: InstalacionesService,
    private route: ActivatedRoute,
    private router: Router) { }


  @Input() viewMode = false;

  @Input() currentInstalacion: Instalacion = {

    id: '',
    codigo: '',
    nombrePuerto: '',
    descripcion: '',
    estado: '',
    visto: false,    
    fechaDisposicion: ''
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getInstalacion(this.route.snapshot.params["id"]);
      
    }
  }

  getInstalacion(id: string): void {
    this.instalacionesService.retornarUno(id)
      .subscribe({
        next: (data) => {
          this.currentInstalacion = data;
          /* console.log(data); */
        },
        error: (e) => console.error(e)
      });
  }
}

