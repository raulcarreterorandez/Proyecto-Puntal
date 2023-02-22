import { Component, OnInit } from '@angular/core';
import { UserService } from '../_services/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  content?: any;
  perfil?:string;

  constructor(private userService: UserService, private router:Router) { }

    ngOnInit(): void {
      this.userService.getPublicContent().subscribe({
        next: data => {
          this.content = JSON.parse(data);
          this.perfil=this.content.success[0].perfil;
        },
        error: err => {
          this.router.navigate(['login']);
        }
      }
    );
  }
}

