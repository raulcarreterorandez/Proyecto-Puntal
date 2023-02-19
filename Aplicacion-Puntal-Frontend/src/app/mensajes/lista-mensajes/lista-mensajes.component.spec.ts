import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaMensajesComponent } from './lista-mensajes.component';

describe('ListaMensajesComponent', () => {
  let component: ListaMensajesComponent;
  let fixture: ComponentFixture<ListaMensajesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaMensajesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaMensajesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
