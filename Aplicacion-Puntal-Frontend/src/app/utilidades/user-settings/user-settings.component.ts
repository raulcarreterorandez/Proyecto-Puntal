import { Component } from '@angular/core';
import { TokenStorageService } from 'src/app/_services/token-storage.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-settings',
  templateUrl: './user-settings.component.html',
  styleUrls: ['./user-settings.component.css']
})
export class UserSettingsComponent {
  constructor(private tokenStorageService: TokenStorageService, private router:Router) { }

  logout(): void {
    this.tokenStorageService.signOut();
    this.router.navigate(['login']);

    // window.location.reload();
  }
}
