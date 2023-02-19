import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaHistoricoComponent } from './vista-detallada-historico.component';

describe('VistaDetalladaHistoricoComponent', () => {
  let component: VistaDetalladaHistoricoComponent;
  let fixture: ComponentFixture<VistaDetalladaHistoricoComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaHistoricoComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaHistoricoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
