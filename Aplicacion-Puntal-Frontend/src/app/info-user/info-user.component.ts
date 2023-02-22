import { Component, OnInit } from '@angular/core';
import { UserService } from '../_services/user.service';
import { Router } from '@angular/router';
import { UsuariosService } from '../usuarios/usuarios.service';

@Component({
  selector: 'app-info-user',
  templateUrl: './info-user.component.html',
  styleUrls: ['./info-user.component.css']
})
export class InfoUserComponent implements OnInit {
  usuario?:any;
  email?:any;

  constructor(private userService: UserService, private router:Router) { }

    ngOnInit(): void {
      this.userService.getPublicContent().subscribe({
        next: data => {
          this.usuario = JSON.parse(data).success[0];
          // this.email=this.usuario.success[0].email;
        },
        error: err => {
          this.router.navigate(['login']);
        }
      }
    );
  }

}
