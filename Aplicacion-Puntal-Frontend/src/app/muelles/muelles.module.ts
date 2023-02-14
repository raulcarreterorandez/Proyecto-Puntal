import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListaMuellesComponent } from './lista-muelles/lista-muelles.component';
import { VistaDetalladaMuelleComponent } from './vista-detallada-muelle/vista-detallada-muelle.component';
import { UtilidadesModule } from '../utilidades/utilidades.module';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';



@NgModule({
  declarations: [
    ListaMuellesComponent,
    VistaDetalladaMuelleComponent
  ],
  imports: [
    CommonModule,
    UtilidadesModule,
    DataTablesModule,
    RouterModule
  ]
})
export class MuellesModule { }
