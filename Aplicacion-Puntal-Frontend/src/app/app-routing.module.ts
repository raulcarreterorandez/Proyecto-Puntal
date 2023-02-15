import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
// INSTALACIONES
/* import { FormularioAltaInstalacionComponent } from './instalaciones/formulario-alta-instalacion/formulario-alta-instalacion.component'; */
import { ListaInstalacionesComponent } from './instalaciones/lista-instalaciones/lista-instalaciones.component';
import { VistaDetalladaInstalacionComponent } from './instalaciones/vista-detallada-instalacion/vista-detallada-instalacion.component';
// MUELLES
import { ListaMuellesComponent } from './muelles/lista-muelles/lista-muelles.component';
import { VistaDetalladaMuelleComponent } from './muelles/vista-detallada-muelle/vista-detallada-muelle.component';
// PLAZAS
import { ListaPlazasComponent } from './plazas/lista-plazas/lista-plazas.component';
import { VistaDetalladaPlazaComponent } from './plazas/vista-detallada-plaza/vista-detallada-plaza.component';
// USUARIOS
import { ListaUsuariosComponent } from './usuarios/lista-usuarios/lista-usuarios.component';
import { VistaDetalladaUsuarioComponent } from './usuarios/vista-detallada-usuario/vista-detallada-usuario.component';
//Mensajes
import { ListaMensajesComponent } from './mensajes/lista-mensajes/lista-mensajes.component';
import { VistaDetalladaMensajeComponent } from './mensajes/vista-detallada-mensaje/vista-detallada-mensaje.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: '', redirectTo: 'home', pathMatch: 'full' },

  // RUTAS - INSTALACIONES
  { path: 'lista-instalaciones', component: ListaInstalacionesComponent },
  { path: 'vistaDetalleInst/:id', component: VistaDetalladaInstalacionComponent },

  // RUTAS - MUELLES
  { path: 'lista-muelles', component: ListaMuellesComponent },
  { path: 'vistaDetalleMuelle/:id', component: VistaDetalladaMuelleComponent },

  // RUTAS - PLAZAS
  { path: 'lista-plazas', component: ListaPlazasComponent },
  { path: 'vistaDetallePlaza/:id', component: VistaDetalladaPlazaComponent },

  // RUTAS - USUARIOS
  { path: 'lista-usuarios', component: ListaUsuariosComponent },
  { path: 'vistaDetalleUsuario/:email', component: VistaDetalladaUsuarioComponent },

  //RUTAS - MENSAJES
  { path: 'lista-mensajes', component: ListaMensajesComponent },
  { path: 'vistaDetalleMensaje/:id', component: VistaDetalladaMensajeComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
