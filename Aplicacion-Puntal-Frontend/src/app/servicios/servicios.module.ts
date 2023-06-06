import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListaServiciosComponent } from './lista-servicios/lista-servicios.component';
import { VistaDetalladaServicioComponent } from './vista-detallada-servicio/vista-detallada-servicio.component';
import { UtilidadesModule } from '../utilidades/utilidades.module';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';



@NgModule({
  declarations: [
    ListaServiciosComponent,
    VistaDetalladaServicioComponent
  ],
  imports: [
    CommonModule,
    UtilidadesModule,
    DataTablesModule,
    RouterModule
  ],
  exports:[
    ListaServiciosComponent,
  ]
})
export class ServiciosModule { }
