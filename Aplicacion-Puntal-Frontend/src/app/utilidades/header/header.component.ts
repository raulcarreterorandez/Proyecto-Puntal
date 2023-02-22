import { Component , OnInit} from '@angular/core';
import { TokenStorageService } from 'src/app/_services/token-storage.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {

  usuario?:any;

  constructor( private token: TokenStorageService) { }

  ngOnInit(): void {
    this.usuario = this.token.getUser();
  }
}
