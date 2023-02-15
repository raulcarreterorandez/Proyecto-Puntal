import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaPlazaComponent } from './vista-detallada-plaza.component';

describe('VistaDetalladaPlazaComponent', () => {
  let component: VistaDetalladaPlazaComponent;
  let fixture: ComponentFixture<VistaDetalladaPlazaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaPlazaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaPlazaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
