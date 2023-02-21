import { Injectable} from '@angular/core';
import { CanActivate, Router} from '@angular/router';
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
        acceso= false;
        break;

      default:
        console.log('No soy nadie.');        
        break;
    }

    return acceso;
  }
}

