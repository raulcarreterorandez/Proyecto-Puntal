import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';

import { ListaHistoricosComponent } from './lista-historicos/lista-historicos.component';
import { VistaDetalladaHistoricoComponent } from './vista-detallada-historico/vista-detallada-historico.component';
import { UtilidadesModule } from '../utilidades/utilidades.module';


@NgModule({
  declarations: [
    ListaHistoricosComponent,
    VistaDetalladaHistoricoComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    DataTablesModule,
    RouterModule,
    UtilidadesModule,
  ],
  exports:[
    ListaHistoricosComponent,
  ],
})
export class HistoricosModule { }
