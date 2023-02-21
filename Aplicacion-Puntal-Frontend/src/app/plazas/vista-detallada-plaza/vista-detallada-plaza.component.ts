import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Plaza } from '../plaza';
import { PlazasService } from '../plazas.service';

@Component({
  selector: 'app-vista-detallada-plaza',
  templateUrl: './vista-detallada-plaza.component.html',
  styleUrls: ['./vista-detallada-plaza.component.css']
})
export class VistaDetalladaPlazaComponent implements OnInit {

  plaza: any;
  message = '';

  constructor(
    private plazaService: PlazasService,
    private route: ActivatedRoute,
    private router: Router) { }

    @Input() viewMode = false;

    @Input() currentPlaza: Plaza = {

      id: '',
      disponible: true,
      visto: false,
      puertoOrigen: '',
      puertoDestino: '',
      anyo: '',
      idMuelle: ''
    };

    ngOnInit(): void {
      if (!this.viewMode) {
        this.message = '';
        this.getPlaza(this.route.snapshot.params["id"]);
        
      }
    }

    getPlaza(id: string): void{
      this.plazaService.retornarUno(id)
        .subscribe({
          next: (data) => {
            this.currentPlaza = data;
            /* console.log(data); */
          },
          error: (e) => console.error(e)
        });
    }

}
