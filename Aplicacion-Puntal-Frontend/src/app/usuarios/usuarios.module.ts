import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';

import { UtilidadesModule } from '../utilidades/utilidades.module';
import { VistaDetalladaUsuarioComponent } from './vista-detallada-usuario/vista-detallada-usuario.component';
import { ListaUsuariosComponent } from './lista-usuarios/lista-usuarios.component';
import { UserService } from '../_services/user.service';
import { UsuariosService } from './usuarios.service';



@NgModule({
  declarations: [
    VistaDetalladaUsuarioComponent,
    ListaUsuariosComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    DataTablesModule,
    RouterModule,
    UtilidadesModule,
  ],
  exports: [
    ListaUsuariosComponent,
  ]
})
export class UsuariosModule { }
