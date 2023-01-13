import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaInstalacionComponent } from './lista-instalacion.component';

describe('ListaInstalacionComponent', () => {
  let component: ListaInstalacionComponent;
  let fixture: ComponentFixture<ListaInstalacionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaInstalacionComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaInstalacionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
