import { TestBed } from '@angular/core/testing';

import { PlazasGuard } from './plazas.guard';

describe('PlazasGuard', () => {
  let guard: PlazasGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(PlazasGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
