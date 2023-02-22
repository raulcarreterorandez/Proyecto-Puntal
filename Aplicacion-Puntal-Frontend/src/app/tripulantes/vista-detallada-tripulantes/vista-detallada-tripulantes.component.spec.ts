import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaTripulantesComponent } from './vista-detallada-tripulantes.component';

describe('VistaDetalladaTripulantesComponent', () => {
  let component: VistaDetalladaTripulantesComponent;
  let fixture: ComponentFixture<VistaDetalladaTripulantesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaTripulantesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaTripulantesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
