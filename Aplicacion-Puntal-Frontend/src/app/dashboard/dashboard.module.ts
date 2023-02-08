import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RouterModule } from '@angular/router';
import { UtilidadesModule } from '../utilidades/utilidades.module';
import { InstalacionesModule } from '../instalaciones/instalaciones.module';

@NgModule({
  declarations: [
    HomeComponent,
    LoginComponent
  ],
  imports: [
    CommonModule,
    UtilidadesModule,
    RouterModule,
    InstalacionesModule
  ],
  exports: [
    HomeComponent,
    LoginComponent
  ]
})
export class DashboardModule { }
