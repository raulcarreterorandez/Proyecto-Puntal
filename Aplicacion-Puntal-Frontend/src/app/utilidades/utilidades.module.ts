import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { AsideComponent } from './aside/aside.component';
import { UserSettingsComponent } from './user-settings/user-settings.component';
import { NavbarComponent } from './navbar/navbar.component';
import { RouterModule, Routes } from '@angular/router';
// import { FormularioAltaInstalacionComponent } from '../instalaciones/formulario-alta-instalacion/formulario-alta-instalacion.component';

const routes: Routes = [
  // { path: 'añadirInst', component: FormularioAltaInstalacionComponent },
];

@NgModule({
  declarations: [
    HeaderComponent,
    AsideComponent,
    UserSettingsComponent,
    NavbarComponent
  ],
  imports: [
    CommonModule,
    RouterModule
  ],
  exports: [
    HeaderComponent,
    AsideComponent,
    UserSettingsComponent,
    NavbarComponent
  ]
})
export class UtilidadesModule { }
