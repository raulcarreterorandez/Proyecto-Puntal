import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaServicioComponent } from './vista-detallada-servicio.component';

describe('VistaDetalladaServicioComponent', () => {
  let component: VistaDetalladaServicioComponent;
  let fixture: ComponentFixture<VistaDetalladaServicioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaServicioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaServicioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
