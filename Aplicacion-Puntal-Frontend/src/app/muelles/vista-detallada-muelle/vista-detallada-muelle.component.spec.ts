import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaDetalladaMuelleComponent } from './vista-detallada-muelle.component';

describe('VistaDetalladaMuelleComponent', () => {
  let component: VistaDetalladaMuelleComponent;
  let fixture: ComponentFixture<VistaDetalladaMuelleComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ VistaDetalladaMuelleComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaDetalladaMuelleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
