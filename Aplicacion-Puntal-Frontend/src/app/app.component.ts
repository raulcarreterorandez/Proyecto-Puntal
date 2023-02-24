import { Component } from '@angular/core';
import {
  transition,
  trigger,
  query,
  style,
  animate,
  group,
  animateChild
} from '@angular/animations';
import { ChildrenOutletContexts } from '@angular/router';
import { difuminado, deslizamiento } from './animations';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],

  // ANIMACION
  animations: [
    // difuminado,
    deslizamiento,
  ]

  })

export class AppComponent {
  title = 'Aplicacion-Puntal';

  constructor(private contexts: ChildrenOutletContexts) {}

    getRouteAnimationData() {
      return this.contexts.getContext('primary')?.route?.snapshot?.data?.['animation'];
    }

}
