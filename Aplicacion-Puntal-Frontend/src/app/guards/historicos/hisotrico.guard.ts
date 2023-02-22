import { Injectable} from '@angular/core';
import { CanActivate, Router} from '@angular/router';
import { TokenStorageService } from 'src/app/_services/token-storage.service';/* '../_services/token-storage.service'; */
import { UserService } from 'src/app/_services/user.service';/* '../_services/user.service'; */

@Injectable({
  providedIn: 'root'
})
export class HisotricoGuard implements CanActivate {
  currentUser: any;

  constructor(private router: Router, private token: TokenStorageService) { }

  canActivate(): boolean {
    this.currentUser = this.token.getUser();

    let acceso: boolean = false;

    if (this.currentUser.perfil == "CUERPO-SEGURIDAD") {
      acceso = true;
    }
    else{
      this.router.navigate(['/home']);
    }

    // switch (this.currentUser.perfil) {
    //   case 'XUNTA-GALICIA':
    //     console.log('Soy XUNTA-GALICIA.');
    //     acceso = false;
    //     break;

    //   case 'GERENCIA-PUERTO':
    //     console.log('Soy GERENCIA-PUERTO');
    //     acceso = false;
    //     break;

    //   case 'CUERPO-SEGURIDAD':
    //     console.log('Soy GERENCIA-PUERTO.');
    //     acceso = true;
    //     break;

    //   case 'GUARDA-MUELLES':
    //     console.log('Soy GUARDA-MUELLES.');
    //     acceso= false;
    //     break;

    //   default:
    //     console.log('No soy nadie.');
    //     break;
    // }

    return acceso;
  }
}
