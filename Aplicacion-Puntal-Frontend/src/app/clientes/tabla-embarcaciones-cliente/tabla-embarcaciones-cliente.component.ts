import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-tabla-embarcaciones-cliente',
  templateUrl: './tabla-embarcaciones-cliente.component.html',
  styleUrls: ['./tabla-embarcaciones-cliente.component.css']
})
export class TablaEmbarcacionesClienteComponent implements OnInit {

  @Input() titulos: any;
  @Input() filas: any;

  objectKeys = Object.keys;

  constructor() { }

  ngOnInit(): void {
  }
}
