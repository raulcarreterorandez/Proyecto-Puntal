import { Injectable} from '@angular/core';
import { CanActivate, Router} from '@angular/router';
import { TokenStorageService } from 'src/app/_services/token-storage.service';/* '../_services/token-storage.service'; */
import { UserService } from 'src/app/_services/user.service';/* '../_services/user.service'; */

@Injectable({
  providedIn: 'root'
})
export class LogeadoGuard implements CanActivate {
  currentUser: any;

  constructor(private authService: UserService, private router: Router, private token: TokenStorageService) { }

  canActivate(): boolean {
    this.currentUser = this.token.getUser();

    let acceso: boolean = false;

    if (this.currentUser.perfil == "CUERPO-SEGURIDAD" ||
        this.currentUser.perfil == "XUNTA-GALICIA" ||
        this.currentUser.perfil == "GERENCIA-PUERTO" ||
        this.currentUser.perfil == "GUARDA-MUELLES" ) {
      acceso = true;
    }
    else{
      this.router.navigate(['/login']);
    }

    return acceso;
  }
}

