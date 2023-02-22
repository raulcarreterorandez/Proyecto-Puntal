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
  { path: 'lista-muelles', component: ListaMuellesComponent, canActivate: [RestriccionUsuariosGuard]  },
  { path: 'vistaDetalleMuelle/:id', component: VistaDetalladaMuelleComponent, canActivate: [RestriccionUsuariosGuard, MuelleGuard]  },

  // RUTAS - PLAZAS
  { path: 'lista-plazas', component: ListaPlazasComponent, canActivate: [RestriccionUsuariosGuard, PlazasGuard]  },
  { path: 'vistaDetallePlaza/:id', component: VistaDetalladaPlazaComponent, canActivate: [RestriccionUsuariosGuard, PlazasGuard]  },

  // RUTAS - USUARIOS
  { path: 'lista-usuarios', component: ListaUsuariosComponent, canActivate: [RestriccionUsuariosGuard]  },
  { path: 'vistaDetalleUsuario/:email', component: VistaDetalladaUsuarioComponent, canActivate: [RestriccionUsuariosGuard]  },

  // RUTAS - CLIENTES
  { path: 'lista-clientes', component: ListaClientesComponent, canActivate: [RestriccionUsuariosGuard]  },
  { path: 'vistaDetalleCliente/:numDocumento', component: VistaDetalladaClienteComponent, canActivate: [RestriccionUsuariosGuard]  },

  // RUTAS - EMBARCACIONES
  { path: 'lista-embarcaciones', component: ListaEmbarcacionesComponent, canActivate: [RestriccionUsuariosGuard]  },
  { path: 'vistaDetalleEmbarcacione/:matricula', component: VistaDetalladaEmbarcacioneComponent , canActivate: [RestriccionUsuariosGuard] },

  // RUTAS - HISTORICOS
  { path: 'lista-historicos', component: ListaHistoricosComponent, canActivate: [RestriccionUsuariosGuard, HisotricoGuard]  },
  { path: 'vistaDetalleHistorico/:id', component: VistaDetalladaHistoricoComponent, canActivate: [RestriccionUsuariosGuard, HisotricoGuard]  },

  // RUTAS - MENSAJES
  { path: 'lista-mensajes', component: ListaMensajesComponent, canActivate: [RestriccionUsuariosGuard]  },
  { path: 'vistaDetalleMensaje/:id', component: VistaDetalladaMensajeComponent, canActivate: [RestriccionUsuariosGuard]  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
