import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Usuario } from '../usuario';
import { UsuariosService } from '../usuarios.service';

@Component({
  selector: 'app-vista-detallada-usuario',
  templateUrl: './vista-detallada-usuario.component.html',
  styleUrls: ['./vista-detallada-usuario.component.css']
})
export class VistaDetalladaUsuarioComponent implements OnInit {

  usuario: any;
  message = '';

  constructor(
    private usuariosService: UsuariosService,
    private route: ActivatedRoute,
    private router: Router) { }


  @Input() viewMode = false;

  @Input() currentUsuario: Usuario = {

    nombreUsuario:'',
    nombreCompleto:'',
    email:'',
    habilitado:false,
    perfil:'',
    idioma:'',
    instalaciones_usuario:''
  };

  ngOnInit(): void {
    if (!this.viewMode) {
      this.message = '';
      this.getUsuario(this.route.snapshot.params["email"]);

    }
  }

  getUsuario(email: string): void {
    this.usuariosService.retornarUno(email)
      .subscribe({
        next: (data) => {
          this.currentUsuario = data;
          console.log(data);
        },
        error: (e) => console.error(e)
      });
  }
}

