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
// CLIENTES
import { VistaDetalladaClienteComponent } from './clientes/vista-detallada-cliente/vista-detallada-cliente.component';
import { ListaClientesComponent } from './clientes/lista-clientes/lista-clientes.component';
// EMBARCACIONES
import { VistaDetalladaEmbarcacioneComponent } from './embarcaciones/vista-detallada-embarcacione/vista-detallada-embarcacione.component';
import { ListaEmbarcacionesComponent } from './embarcaciones/lista-embarcaciones/lista-embarcaciones.component';
import { ListaHistoricosComponent } from './historicos/lista-historicos/lista-historicos.component';
import { VistaDetalladaHistoricoComponent } from './historicos/vista-detallada-historico/vista-detallada-historico.component';
import { ListaClientesComponent } from './clientes/lista-clientes/lista-clientes.component';
import { VistaDetalladaClienteComponent } from './clientes/vista-detallada-cliente/vista-detallada-cliente.component';

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

  // RUTAS - CLIENTES
  { path: 'lista-clientes', component: ListaClientesComponent },
  { path: 'vistaDetalleCliente/:id', component: VistaDetalladaClienteComponent },

  // RUTAS - EMBARCACIONES
  { path: 'lista-embarcaciones', component: ListaEmbarcacionesComponent },
  { path: 'vistaDetalleEmbarcacione/:id', component: VistaDetalladaEmbarcacioneComponent },
  // RUTAS - HISTORICOS
  { path: 'lista-historicos', component: ListaHistoricosComponent },
  { path: 'vistaDetalleHistorico/:id', component: VistaDetalladaHistoricoComponent },

  // RUTAS - CLIENTES
  { path: 'lista-clientes', component: ListaClientesComponent },
  { path: 'vistaDetalleHistorico/:id', component: VistaDetalladaClienteComponent },

  // RUTAS - EMBARCACIONES


  // RUTAS - TRIPULANTES


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
