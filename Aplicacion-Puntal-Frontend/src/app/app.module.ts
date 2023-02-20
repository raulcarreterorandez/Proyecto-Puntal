import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';

// import { AuthInterceptor } from './_helpers/auth.interceptor';
import { authInterceptorProviders } from './_helpers/auth.interceptor';

import { DataTablesModule } from "angular-datatables";
import { MatTabsModule } from '@angular/material/tabs';

import { UtilidadesModule } from './utilidades/utilidades.module';
import { InstalacionesModule } from './instalaciones/instalaciones.module';
import { MuellesModule } from './muelles/muelles.module';
import { PlazasModule } from './plazas/plazas.module';
import { UsuariosModule } from './usuarios/usuarios.module';
import { ClientesModule } from './clientes/clientes.module';
import { EmbarcacionesModule } from './embarcaciones/embarcaciones.module';
import { MensajesModule } from './mensajes/mensajes.module';
import { HistoricosModule } from './historicos/historicos.module';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    DataTablesModule,
    HttpClientModule,
    FormsModule,
    UtilidadesModule,
    InstalacionesModule,
    MuellesModule,
    PlazasModule,
    UsuariosModule,
    ClientesModule,
    EmbarcacionesModule,
    MensajesModule,
    HistoricosModule,
    BrowserAnimationsModule,
    MatTabsModule
  ],
  providers: [authInterceptorProviders],
  bootstrap: [AppComponent]
})
export class AppModule { }
