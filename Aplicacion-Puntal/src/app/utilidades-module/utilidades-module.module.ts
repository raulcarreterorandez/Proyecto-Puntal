import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HeaderComponentComponent } from './header-component/header-component.component';
import { AsideComponentComponent } from './aside-component/aside-component.component';
import { MainComponentComponent } from './main-component/main-component.component';
import { UserSettingsComponentComponent } from './user-settings-component/user-settings-component.component';



@NgModule({
  declarations: [
    HeaderComponentComponent,
    AsideComponentComponent,
    MainComponentComponent,
    UserSettingsComponentComponent
  ],
  imports: [
    CommonModule
  ],
  exports: [
    HeaderComponentComponent,
    AsideComponentComponent,
    MainComponentComponent,
    UserSettingsComponentComponent
  ]
})
export class UtilidadesModuleModule { }
