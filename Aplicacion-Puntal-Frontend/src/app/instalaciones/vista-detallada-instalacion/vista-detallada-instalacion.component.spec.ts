import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaInstalacionComponent } from './vista-detallada-instalacion.component';

describe('VistaDetalladaInstalacionComponent', () => {
  let component: VistaDetalladaInstalacionComponent;
  let fixture: ComponentFixture<VistaDetalladaInstalacionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaInstalacionComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaInstalacionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
