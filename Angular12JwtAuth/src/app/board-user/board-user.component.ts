import { Component, OnInit } from '@angular/core';
import { UserService } from '../_services/user.service';

@Component({
  selector: 'app-board-user',
  templateUrl: './board-user.component.html',
  styleUrls: ['./board-user.component.css']
})
export class BoardUserComponent implements OnInit {
  content: any;
  nombre?:string;
  email?:string;

  constructor(private userService: UserService) { }

  ngOnInit(): void {
    this.userService.getPublicContent().subscribe({
      next: data => {
        this.content = JSON.parse(data);
        this.nombre = this.content.success.name;
        this.email = this.content.success.email;

      },
      error:err => {
        this.content = JSON.parse(err.error).message;
      }
    }
    );
  }
}