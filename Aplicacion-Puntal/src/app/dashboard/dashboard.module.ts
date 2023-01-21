import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RouterModule } from '@angular/router';
import { UtilidadesModule } from '../utilidades/utilidades.module';

@NgModule({
  declarations: [
    HomeComponent,
    LoginComponent
  ],
  imports: [
    CommonModule,
    UtilidadesModule,
    RouterModule
  ],
  exports: [
    HomeComponent,
    LoginComponent
  ]
})
export class DashboardModule { }
