import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { HistoricosService } from '../historicos.service';
import { Historico } from '../historico';


@Component({
  selector: 'app-vista-detallada-historico',
  templateUrl: './vista-detallada-historico.component.html',
  styleUrls: ['./vista-detallada-historico.component.css']
})
export class VistaDetalladaHistoricoComponent implements OnInit{
  historico:any;
  message="";

  constructor(
    private historicosService: HistoricosService,
    private route: ActivatedRoute,
    private router:Router
  ){}

  @Input() viewMode = false;

  @Input() currentHistorico: Historico={
    accionId:"",
    puerto:"",
    plaza:"",
    embarcacion:"",
    cliente:"",
    tripulantes:""

  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getHistorico(this.route.snapshot.params["id"]);

    }
  }

  getHistorico(id: string): void {
    this.historicosService.retornarUno(id)
      .subscribe({
        next: (data) => {
          this.currentHistorico = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }
}

