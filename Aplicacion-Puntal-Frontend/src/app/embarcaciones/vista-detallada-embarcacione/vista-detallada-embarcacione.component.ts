import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Embarcacione } from '../embarcacione';
import { EmbarcacioneService } from '../embarcacione.service';

@Component({
  selector: 'app-vista-detallada-embarcacione',
  templateUrl: './vista-detallada-embarcacione.component.html',
  styleUrls: ['./vista-detallada-embarcacione.component.css']
})
export class VistaDetalladaEmbarcacioneComponent implements OnInit {

  usuario: any;
  message = '';

  constructor(
    private embarcacioneService: EmbarcacioneService,
    private route: ActivatedRoute,
    private router: Router) { }

  @Input() viewMode = false;

  @Input() currentEmbarcacione: Embarcacione = {
    matricula: '',
    id_cliente: '',
    nombre: '',
    eslora: '',
    manga: '',
    calado: '',
    propulsion: '',
    id_plaza: ''
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getEmbarcacione(this.route.snapshot.params["matricula"]);
    }
  }

  getEmbarcacione(matricula: any): void {
    this.embarcacioneService.retornarUno(matricula)
      .subscribe({
        next: (data) => {
          this.currentEmbarcacione = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }


}
