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


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
