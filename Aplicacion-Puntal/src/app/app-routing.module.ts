import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './dashboard/home/home.component';
import { LoginComponent } from './dashboard/login/login.component';
import { FormularioAltaInstalacionComponent } from './instalaciones/formulario-alta-instalacion/formulario-alta-instalacion.component';
import { VistaDetalladaInstalacionComponent } from './instalaciones/vista-detallada-instalacion/vista-detallada-instalacion.component';

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'añadirInst', component: FormularioAltaInstalacionComponent },
  { path: 'vistaDetalladaInst', component: VistaDetalladaInstalacionComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
