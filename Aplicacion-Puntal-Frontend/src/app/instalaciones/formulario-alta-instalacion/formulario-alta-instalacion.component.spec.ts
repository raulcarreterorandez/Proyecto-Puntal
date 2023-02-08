import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormularioAltaInstalacionComponent } from './formulario-alta-instalacion.component';

describe('FormularioAltaInstalacionComponent', () => {
  let component: FormularioAltaInstalacionComponent;
  let fixture: ComponentFixture<FormularioAltaInstalacionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FormularioAltaInstalacionComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FormularioAltaInstalacionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
