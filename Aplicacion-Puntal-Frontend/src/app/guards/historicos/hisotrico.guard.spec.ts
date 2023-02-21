import { TestBed } from '@angular/core/testing';

import { HisotricoGuard } from './hisotrico.guard';

describe('HisotricoGuard', () => {
  let guard: HisotricoGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(HisotricoGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
