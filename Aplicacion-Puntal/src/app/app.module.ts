import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DashboardModule } from './dashboard/dashboard.module'; /* Aquí nuestro home y login */
import { RegisterComponent } from './register/register.component';
import { ProfileComponent } from './profile/profile.component';
import { BoardAdminComponent } from './board-admin/board-admin.component';
import { BoardModeratorComponent } from './board-moderator/board-moderator.component';
import { BoardUserComponent } from './board-user/board-user.component';

/* import { authInterceptorProviders } from './_helpers/auth.interceptor'; */

import { DataTablesModule } from "angular-datatables";

@NgModule({
  declarations: [
    AppComponent,
    RegisterComponent,
    ProfileComponent,
    BoardAdminComponent,
    BoardModeratorComponent,
    BoardUserComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    DashboardModule,
    DataTablesModule,
    HttpClientModule, //Importando en la raíz soluciono el problema de que se quedaba colgada la vista. Mensaje de error abajo.
    DataTablesModule
    /*
    ERROR Error: Uncaught (in promise): NullInjectorError: R3InjectorError(AppModule)
    [InstalacionesService -> HttpClient -> HttpClient -> HttpClient]: NullInjectorError: No provider for HttpClient!  
    */
  ],
  providers: [/* authInterceptorProviders */],
  bootstrap: [AppComponent]
})
export class AppModule { }
