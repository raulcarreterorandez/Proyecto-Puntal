import { Component , OnInit} from '@angular/core';
import { TokenStorageService } from 'src/app/_services/token-storage.service';
@Component({
  selector: 'app-aside',
  templateUrl: './aside.component.html',
  styleUrls: ['./aside.component.css']
})
export class AsideComponent implements OnInit{

  usuario?:any;

  constructor( private token: TokenStorageService) { }

  ngOnInit(): void {
    this.usuario = this.token.getUser();
  }
}
