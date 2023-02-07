import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaInstalacionesComponent } from './lista-instalaciones.component';

describe('ListaInstalacionesComponent', () => {
  let component: ListaInstalacionesComponent;
  let fixture: ComponentFixture<ListaInstalacionesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaInstalacionesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaInstalacionesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
