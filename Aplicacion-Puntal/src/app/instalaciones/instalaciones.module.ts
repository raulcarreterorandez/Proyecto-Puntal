import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListaComponent } from './lista/lista.component';
import { FormularioAltaComponent } from './formulario-alta/formulario-alta.component';
import { VistaDetalladaComponent } from './vista-detallada/vista-detallada.component';



@NgModule({
  declarations: [
    ListaComponent,
    FormularioAltaComponent,
    VistaDetalladaComponent
  ],
  imports: [
    CommonModule
  ],
  exports: [
    ListaComponent,
    FormularioAltaComponent,
    VistaDetalladaComponent
  ]
})
export class InstalacionesModule { }
