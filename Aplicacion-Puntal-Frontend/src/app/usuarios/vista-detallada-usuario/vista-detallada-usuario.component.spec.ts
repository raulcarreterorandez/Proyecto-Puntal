import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaUsuarioComponent } from './vista-detallada-usuario.component';

describe('VistaDetalladaUsuarioComponent', () => {
  let component: VistaDetalladaUsuarioComponent;
  let fixture: ComponentFixture<VistaDetalladaUsuarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaUsuarioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaUsuarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
