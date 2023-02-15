import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaPlazasComponent } from './lista-plazas.component';

describe('ListaPlazasComponent', () => {
  let component: ListaPlazasComponent;
  let fixture: ComponentFixture<ListaPlazasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaPlazasComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaPlazasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
