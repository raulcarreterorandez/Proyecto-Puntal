import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { DashboardModule } from './dashboard/dashboard.module'; /* Aquí nuestro home y login */


/* import { authInterceptorProviders } from './_helpers/auth.interceptor'; */

import { DataTablesModule } from "angular-datatables";
import { LoginComponent } from './login/login.component';
import { HomeComponent } from './home/home.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    HomeComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    DashboardModule,
    DataTablesModule,
    HttpClientModule //Importando en la raíz soluciono el problema de que se quedaba colgada la vista. Mensaje de error abajo.
   
    /*
    ERROR Error: Uncaught (in promise): NullInjectorError: R3InjectorError(AppModule)
    [InstalacionesService -> HttpClient -> HttpClient -> HttpClient]: NullInjectorError: No provider for HttpClient!  
    */
  ],
  providers: [/* authInterceptorProviders */],
  bootstrap: [AppComponent]
})
export class AppModule { }
