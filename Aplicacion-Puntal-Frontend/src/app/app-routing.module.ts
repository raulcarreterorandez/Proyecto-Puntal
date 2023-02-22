import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

//GUARD
import { InstalacionGuard } from './guards/instalaciones/instalacion.guard';
import { HisotricoGuard } from './guards/historicos/hisotrico.guard';
import { LogeadoGuard } from './guards/logeado/logeado.guard';

// HOME Y LOGIN
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

// HISTORICOS
import { ListaHistoricosComponent } from './historicos/lista-historicos/lista-historicos.component';
import { VistaDetalladaHistoricoComponent } from './historicos/vista-detallada-historico/vista-detallada-historico.component';

// MENSAJES
import { ListaMensajesComponent } from './mensajes/lista-mensajes/lista-mensajes.component';
import { VistaDetalladaMensajeComponent } from './mensajes/vista-detallada-mensaje/vista-detallada-mensaje.component';

//TRIPULANTES
import { VistaDetalladaTripulantesComponent } from './tripulantes/vista-detallada-tripulantes/vista-detallada-tripulantes.component';

// TRIPULANTES

const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: '', redirectTo: 'home', pathMatch: 'full' },

  // RUTAS - INSTALACIONES
  { path: 'lista-instalaciones', component: ListaInstalacionesComponent, canActivate: [InstalacionGuard] },
  { path: 'vistaDetalleInst/:id', component: VistaDetalladaInstalacionComponent, canActivate: [InstalacionGuard] },

  // RUTAS - MUELLES
  { path: 'lista-muelles', component: ListaMuellesComponent, canActivate: [LogeadoGuard] },
  { path: 'vistaDetalleMuelle/:id', component: VistaDetalladaMuelleComponent, canActivate: [LogeadoGuard] },

  // RUTAS - PLAZAS
  { path: 'lista-plazas', component: ListaPlazasComponent, canActivate: [LogeadoGuard] },
  { path: 'vistaDetallePlaza/:id', component: VistaDetalladaPlazaComponent, canActivate: [LogeadoGuard] },

  // RUTAS - USUARIOS
  { path: 'lista-usuarios', component: ListaUsuariosComponent, canActivate: [LogeadoGuard] },
  { path: 'vistaDetalleUsuario/:email', component: VistaDetalladaUsuarioComponent, canActivate: [LogeadoGuard] },

  // RUTAS - CLIENTES
  { path: 'lista-clientes', component: ListaClientesComponent, canActivate: [LogeadoGuard] },
  { path: 'vistaDetalleCliente/:numDocumento', component: VistaDetalladaClienteComponent, canActivate: [LogeadoGuard] },

  // RUTAS - EMBARCACIONES
  { path: 'lista-embarcaciones', component: ListaEmbarcacionesComponent, canActivate: [LogeadoGuard] },
  { path: 'vistaDetalleEmbarcacione/:matricula', component: VistaDetalladaEmbarcacioneComponent, canActivate: [LogeadoGuard] },

  // RUTAS - HISTORICOS
  { path: 'lista-historicos', component: ListaHistoricosComponent, canActivate: [HisotricoGuard] },
  { path: 'vistaDetalleHistorico/:id', component: VistaDetalladaHistoricoComponent, canActivate: [HisotricoGuard] },

  // RUTAS - MENSAJES
  { path: 'lista-mensajes', component: ListaMensajesComponent, canActivate: [LogeadoGuard] },
  { path: 'vistaDetalleMensaje/:id', component: VistaDetalladaMensajeComponent, canActivate: [LogeadoGuard] },

  // RUTAS - TRIPULANTES
  { path: 'vistaDetalleTripulante/:numDocumento', component: VistaDetalladaTripulantesComponent, canActivate: [LogeadoGuard] },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
