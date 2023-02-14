import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { VistaDetalladaInstalacionComponent } from './instalaciones/vista-detallada-instalacion/vista-detallada-instalacion.component';
import { ListaInstalacionesComponent } from './instalaciones/lista-instalaciones/lista-instalaciones.component';
import { ListaUsuariosComponent } from './usuarios/lista-usuarios/lista-usuarios.component';
import { VistaDetalladaUsuarioComponent } from './usuarios/vista-detallada-usuario/vista-detallada-usuario.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: '', redirectTo: 'home', pathMatch: 'full' },

  // RUTAS - INSTALACIONES
  { path: 'lista-instalaciones', component: ListaInstalacionesComponent },
  { path: 'vistaDetalleInst/:id', component: VistaDetalladaInstalacionComponent },

  // RUTAS - USUARIOS
  { path: 'lista-usuarios', component: ListaUsuariosComponent },
  { path: 'vistaDetalleUsuario/:email', component: VistaDetalladaUsuarioComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
