import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaHistoricosComponent } from './lista-historicos.component';

describe('ListaHistoricosComponent', () => {
  let component: ListaHistoricosComponent;
  let fixture: ComponentFixture<ListaHistoricosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaHistoricosComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaHistoricosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
