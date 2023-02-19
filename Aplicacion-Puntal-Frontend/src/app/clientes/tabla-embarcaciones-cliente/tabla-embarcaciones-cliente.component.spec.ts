import { ComponentFixture, TestBed } from '@angular/core/testing';

import { TablaEmbarcacionesClienteComponent } from './tabla-embarcaciones-cliente.component';

describe('TablaEmbarcacionesClienteComponent', () => {
  let component: TablaEmbarcacionesClienteComponent;
  let fixture: ComponentFixture<TablaEmbarcacionesClienteComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ TablaEmbarcacionesClienteComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(TablaEmbarcacionesClienteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
