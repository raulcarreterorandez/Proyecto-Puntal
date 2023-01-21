import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from './header/header.component';
import { AsideComponent } from './aside/aside.component';
import { UserSettingsComponent } from './user-settings/user-settings.component';

@NgModule({
  declarations: [
    HeaderComponent,
    AsideComponent,
    UserSettingsComponent
  ],
  imports: [
    CommonModule,
  ],
  exports: [
    HeaderComponent,
    AsideComponent,
    UserSettingsComponent
  ]
})
export class UtilidadesModule { }
