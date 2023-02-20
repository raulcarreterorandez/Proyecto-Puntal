import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListaPlazasComponent } from './lista-plazas/lista-plazas.component';
import { VistaDetalladaPlazaComponent } from './vista-detallada-plaza/vista-detallada-plaza.component';
import { UtilidadesModule } from '../utilidades/utilidades.module';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';
import { MatTabsModule } from '@angular/material/tabs';



@NgModule({
  declarations: [
    ListaPlazasComponent,
    VistaDetalladaPlazaComponent
  ],
  imports: [
    CommonModule, 
    UtilidadesModule,
    DataTablesModule,
    RouterModule, 
    MatTabsModule
  ]
})
export class PlazasModule { }
