import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {HttpClientModule} from '@angular/common/http';
import { DataTablesModule } from 'angular-datatables';

import { FormularioAltaInstalacionComponent } from './formulario-alta-instalacion/formulario-alta-instalacion.component';
import { VistaDetalladaInstalacionComponent } from './vista-detallada-instalacion/vista-detallada-instalacion.component';
import { ListaInstalacionesComponent } from './lista-instalaciones/lista-instalaciones.component';



@NgModule({
  declarations: [
    /* ListaInstalacionComponent, */
    FormularioAltaInstalacionComponent,
    VistaDetalladaInstalacionComponent,
    ListaInstalacionesComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    DataTablesModule
  ],
  exports: [
    ListaInstalacionesComponent,
    FormularioAltaInstalacionComponent,
    VistaDetalladaInstalacionComponent
  ]
})
export class InstalacionesModule { }
