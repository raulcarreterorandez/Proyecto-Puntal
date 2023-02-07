import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './dashboard/home/home.component';
<<<<<<< HEAD
import { LoginComponent } from './dashboard/login/login.component';/* 
import { FormularioAltaInstalacionComponent } from './instalaciones/formulario-alta-instalacion/formulario-alta-instalacion.component'; */
=======
import { LoginComponent } from './dashboard/login/login.component';
import { FormularioAltaInstalacionComponent } from './instalaciones/formulario-alta-instalacion/formulario-alta-instalacion.component';
>>>>>>> d46a32f640f10be541c19b852f904b6074bd7e33
import { VistaDetalladaInstalacionComponent } from './instalaciones/vista-detallada-instalacion/vista-detallada-instalacion.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
<<<<<<< HEAD
  { path: 'login', component: LoginComponent },/* 
  { path: 'añadirInst', component: FormularioAltaInstalacionComponent }, */
  { path: 'vistaDetalleInst', component: VistaDetalladaInstalacionComponent },
=======
  { path: 'login', component: LoginComponent },
  { path: 'añadirInst', component: FormularioAltaInstalacionComponent },
  { path: 'vistaDetalladaInst', component: VistaDetalladaInstalacionComponent }
>>>>>>> d46a32f640f10be541c19b852f904b6074bd7e33
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
