import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaClienteComponent } from './vista-detallada-cliente.component';

describe('VistaDetalladaClienteComponent', () => {
  let component: VistaDetalladaClienteComponent;
  let fixture: ComponentFixture<VistaDetalladaClienteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaClienteComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaClienteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
