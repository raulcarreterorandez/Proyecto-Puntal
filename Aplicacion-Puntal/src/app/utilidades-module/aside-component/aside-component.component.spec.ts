import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AsideComponentComponent } from './aside-component.component';

describe('AsideComponentComponent', () => {
  let component: AsideComponentComponent;
  let fixture: ComponentFixture<AsideComponentComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AsideComponentComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AsideComponentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
