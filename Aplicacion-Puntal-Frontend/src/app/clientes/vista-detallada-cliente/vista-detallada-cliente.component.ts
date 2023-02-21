import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Cliente } from '../cliente';
import { ClientesService } from '../clientes.service';

@Component({
  selector: 'app-vista-detallada-cliente',
  templateUrl: './vista-detallada-cliente.component.html',
  styleUrls: ['./vista-detallada-cliente.component.css']
})
export class VistaDetalladaClienteComponent implements OnInit {

  cliente: any;
  message = '';

  constructor(
    private clienteService: ClientesService,
    private route: ActivatedRoute,
    private router: Router) { }

  @Input() viewMode = false;

  @Input() currentCliente: Cliente = {
    numDocumento: '',
    nombre: '',
    apellidos: '',
    email: '',
    direccion: '',
    tipoDocumento: '',
    observaciones: ''
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      console.log(this.getCliente(this.route.snapshot.params["numDocumento"]));
      this.getCliente(this.route.snapshot.params["numDocumento"]);
    }
  }

  getCliente(numDocumento: string): void {
    this.clienteService.retornarUnCliente(numDocumento)
      .subscribe({
        next: (data) => {
          this.currentCliente = data;
          /* console.log(data); */
        },
        error: (e) => console.error(e)
      });
  }
}
