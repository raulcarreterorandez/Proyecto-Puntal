import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListaEmbarcacionesComponent } from './lista-embarcaciones/lista-embarcaciones.component';
import { VistaDetalladaEmbarcacioneComponent } from './vista-detallada-embarcacione/vista-detallada-embarcacione.component';
import { HttpClientModule } from '@angular/common/http';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';
import { UtilidadesModule } from '../utilidades/utilidades.module';



@NgModule({
  declarations: [
    ListaEmbarcacionesComponent,
    VistaDetalladaEmbarcacioneComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    DataTablesModule,
    RouterModule,
    UtilidadesModule
  ]
})
export class EmbarcacionesModule { }
