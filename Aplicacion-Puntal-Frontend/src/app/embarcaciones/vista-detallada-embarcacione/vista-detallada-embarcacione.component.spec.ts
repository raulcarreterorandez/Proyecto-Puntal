import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaEmbarcacioneComponent } from './vista-detallada-embarcacione.component';

describe('VistaDetalladaEmbarcacioneComponent', () => {
  let component: VistaDetalladaEmbarcacioneComponent;
  let fixture: ComponentFixture<VistaDetalladaEmbarcacioneComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaEmbarcacioneComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaEmbarcacioneComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
