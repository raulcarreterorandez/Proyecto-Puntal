import { Injectable} from '@angular/core';
import { CanActivate, Router} from '@angular/router';
import { TokenStorageService } from 'src/app/_services/token-storage.service';/* '../_services/token-storage.service'; */
import { UserService } from 'src/app/_services/user.service';/* '../_services/user.service'; */

@Injectable({
  providedIn: 'root'
})
export class MuelleGuard implements CanActivate {
  currentUser: any;

  constructor(private authService: UserService, private router: Router, private token: TokenStorageService) { }

  canActivate(): boolean {
    this.currentUser = this.token.getUser();
    console.log(this.currentUser.details[0].perfil);

    let acceso: boolean = false;

    switch (this.currentUser.details[0].perfil) {
      case 'XUNTA-GALICIA':
        console.log('Soy XUNTA-GALICIA.');
        acceso = true;
        /* this.router.navigate(['/']); */ //Lo enviamos a la página que queramos
        break;

      case 'GERENCIA-PUERTO':
        console.log('Soy GERENCIA-PUERTO');
        acceso = true;
        break;

      case 'CUERPO-SEGURIDAD':
        console.log('Soy GERENCIA-PUERTO.');
        acceso = true;
        break;

      case 'GUARDA-MUELLES':
        console.log('Soy GUARDA-MUELLES.');
        acceso= true;
        break;

      default:
        console.log('No soy nadie.');        
        break;
    }

    return acceso;
  }
}

