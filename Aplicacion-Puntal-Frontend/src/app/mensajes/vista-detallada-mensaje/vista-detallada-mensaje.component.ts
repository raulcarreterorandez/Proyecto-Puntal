import { Component, OnInit, Input} from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Mensaje } from '../mensaje';
import { MensajesService } from '../mensajes.service';

@Component({
  selector: 'app-vista-detallada-mensaje',
  templateUrl: './vista-detallada-mensaje.component.html',
  styleUrls: ['./vista-detallada-mensaje.component.css']
})
export class VistaDetalladaMensajeComponent implements OnInit{
  mensaje:any;
  message="";

  constructor(
    private mensajesService: MensajesService,
    private route: ActivatedRoute,
    private router: Router) { }

    @Input() viewMode = false;

    @Input() currentMensaje: Mensaje = {

      id: '',
      texto: '',
      fecha_hora: '',
      leido: false,
      idUsuarioDestino: '',
      idUsuarioOrigen: '',
    };

    ngOnInit(): void {
      if (!this.viewMode) {
        this.message = '';
        this.getInstalacion(this.route.snapshot.params["id"]);

      }
    }

    getInstalacion(id: string): void {
      this.mensajesService.retornarUno(id)
        .subscribe({
          next: (data) => {
            this.currentMensaje = data;
            /* console.log(data); */
          },
          error: (e) => console.error(e)
        });
    }
  }

