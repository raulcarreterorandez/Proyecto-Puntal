import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaEmbarcacionesComponent } from './lista-embarcaciones.component';

describe('ListaEmbarcacionesComponent', () => {
  let component: ListaEmbarcacionesComponent;
  let fixture: ComponentFixture<ListaEmbarcacionesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaEmbarcacionesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaEmbarcacionesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
