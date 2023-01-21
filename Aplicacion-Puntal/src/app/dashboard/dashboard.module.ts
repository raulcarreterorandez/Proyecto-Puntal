import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { InstalacionesModule } from '../instalaciones/instalaciones.module';
import { UtilidadesModuleModule } from '../utilidades-module/utilidades-module.module';

// import { AppRoutingModule } from './app-routing.module';
import { Routes, RouterModule } from '@angular/router';

@NgModule({
  declarations: [
    HomeComponent,
    LoginComponent
  ],
  imports: [
    CommonModule,
    InstalacionesModule,
    UtilidadesModuleModule,
    RouterModule
  ],
  exports : [
    HomeComponent,
    LoginComponent
  ]
})
export class DashboardModule { }