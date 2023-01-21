import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {HttpClientModule} from '@angular/common/http';
import { DataTablesModule } from 'angular-datatables';

import { ListaInstalacionComponent } from './lista-instalacion/lista-instalacion.component';
import { FormularioAltaInstalacionComponent } from './formulario-alta-instalacion/formulario-alta-instalacion.component';
import { VistaDetalladaInstalacionComponent } from './vista-detallada-instalacion/vista-detallada-instalacion.component';



@NgModule({
  declarations: [
    ListaInstalacionComponent,
    FormularioAltaInstalacionComponent,
    VistaDetalladaInstalacionComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    DataTablesModule
  ],
  exports: [
    ListaInstalacionComponent,
    FormularioAltaInstalacionComponent,
    VistaDetalladaInstalacionComponent
  ]
})
export class InstalacionesModule { }
