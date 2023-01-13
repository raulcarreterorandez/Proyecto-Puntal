import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
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
    CommonModule
  ],
  exports: [
    ListaInstalacionComponent,
    FormularioAltaInstalacionComponent,
    VistaDetalladaInstalacionComponent
  ]
})
export class InstalacionesModule { }
