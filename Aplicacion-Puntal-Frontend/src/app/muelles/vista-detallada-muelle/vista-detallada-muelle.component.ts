import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Muelle } from '../muelle';
import { MuellesService } from '../muelles.service';


@Component({
  selector: 'app-vista-detallada-muelle',
  templateUrl: './vista-detallada-muelle.component.html',
  styleUrls: ['./vista-detallada-muelle.component.css']
})
export class VistaDetalladaMuelleComponent implements OnInit{

  muelle: any;
  message = '';

  constructor(
    private muelleService: MuellesService,
    private route: ActivatedRoute,
    private router: Router) { }


  @Input() viewMode = false;

  @Input() currentMuelle: Muelle = {

    id: '',
    idInstalacion: '',  
    visto: false
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getMuelle(this.route.snapshot.params["id"]);
      
    }
  }

  getMuelle(id: string): void {
    this.muelleService.retornarUno(id)
      .subscribe({
        next: (data) => {
          this.currentMuelle = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }

}
