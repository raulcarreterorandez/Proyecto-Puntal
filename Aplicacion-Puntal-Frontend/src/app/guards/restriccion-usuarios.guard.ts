import { Injectable, Input } from '@angular/core';
import { ActivatedRoute, ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { Usuario } from '../usuarios/usuario';
import { TokenStorageService } from '../_services/token-storage.service';
import { UserService } from '../_services/user.service';

@Injectable({
  providedIn: 'root'
})

@Injectable()

export class RestriccionUsuariosGuard implements CanActivate {

  currentUser: any;

  constructor(private authService: UserService, private router: Router, private token: TokenStorageService) { }

  canActivate(): boolean {
    this.currentUser = this.token.getUser();
    console.log(this.currentUser.details[0].perfil);

    /*  if ( this.getUsuarioRole() != 'XUNTA-GALICIA') {
  
       console.log(this.getUsuarioRole()); 
       console.log('No entramos');
     } else {
       console.log('Si entramos');
     } */

    let acceso: boolean = false;
    switch (this.currentUser.details[0].perfil) {
      case 'XUNTA-GALICIA':
        console.log('Soy XUNTA-GALICIA.');
        acceso = true;
        /* this.router.navigate(['/']); */ //Lo enviamos a la página que queramos
        break;

      case 'GERENCIA-PUERTO':
        console.log('Soy GERENCIA-PUERTO');

        break;

      case 'CUERPO-SEGURIDAD':
        console.log('Soy GERENCIA-PUERTO.');
        break;

      case 'GUARDA-MUELLES':
        console.log('Soy GUARDA-MUELLES.');
        break;

      default:
        console.log('No soy nadie.');
        break;
    }

    return acceso;

  }

}

/* public canActivate() {

  console.log(this.authService.getRole());

  if ( this.getUsuarioRole() != 'XUNTA-GALICIA') {
 
    console.log(this.getUsuarioRole()); 
    console.log('No entramos');
  } else {
    console.log('Si entramos');
  }


  return true; //Este camino deja continuar con la vista con normalidad
}

getUsuarioRole(): any {
  this.authService.getRole()
    .subscribe({
      next: (data) => {
        this.authService = data;
        console.log(data);
        return data;
      },
      
      error: (e) => console.error(e)

    });
} */