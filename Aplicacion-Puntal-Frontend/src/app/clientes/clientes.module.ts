import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';
import { ListaClientesComponent } from './lista-clientes/lista-clientes.component';
import { VistaDetalladaClienteComponent } from './vista-detallada-cliente/vista-detallada-cliente.component';
import { UtilidadesModule } from '../utilidades/utilidades.module';
import { HttpClientModule } from '@angular/common/http';

@NgModule({
  declarations: [
    ListaClientesComponent,
    VistaDetalladaClienteComponent,
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    UtilidadesModule,
    DataTablesModule,
    RouterModule
  ]
})
export class ClientesModule { }
