import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaMuellesComponent } from './lista-muelles.component';

describe('ListaMuellesComponent', () => {
  let component: ListaMuellesComponent;
  let fixture: ComponentFixture<ListaMuellesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaMuellesComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaMuellesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
