import { Component } from '@angular/core';
import { TokenStorageService } from 'src/app/_services/token-storage.service';

@Component({
  selector: 'app-user-settings',
  templateUrl: './user-settings.component.html',
  styleUrls: ['./user-settings.component.css']
})
export class UserSettingsComponent {
  constructor(private tokenStorageService: TokenStorageService) { }

  logout(): void {
    this.tokenStorageService.signOut();
    window.location.reload();
  }
}
