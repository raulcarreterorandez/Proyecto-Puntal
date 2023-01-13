import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UserSettingsComponentComponent } from './user-settings-component.component';

describe('UserSettingsComponentComponent', () => {
  let component: UserSettingsComponentComponent;
  let fixture: ComponentFixture<UserSettingsComponentComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UserSettingsComponentComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UserSettingsComponentComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
