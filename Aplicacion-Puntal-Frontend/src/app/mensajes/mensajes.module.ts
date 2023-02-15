import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';

import { ListaMensajesComponent } from './lista-mensajes/lista-mensajes.component';
import { VistaDetalladaMensajeComponent } from './vista-detallada-mensaje/vista-detallada-mensaje.component';
import { UtilidadesModule } from '../utilidades/utilidades.module';



@NgModule({
  declarations: [
    ListaMensajesComponent,
    VistaDetalladaMensajeComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    DataTablesModule,
    RouterModule,
    UtilidadesModule,
  ],
  exports:[
    ListaMensajesComponent,
  ]
})
export class MensajesModule { }
