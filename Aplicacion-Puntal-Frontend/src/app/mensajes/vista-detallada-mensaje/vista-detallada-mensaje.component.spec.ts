import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaMensajeComponent } from './vista-detallada-mensaje.component';

describe('VistaDetalladaMensajeComponent', () => {
  let component: VistaDetalladaMensajeComponent;
  let fixture: ComponentFixture<VistaDetalladaMensajeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaMensajeComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaMensajeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
