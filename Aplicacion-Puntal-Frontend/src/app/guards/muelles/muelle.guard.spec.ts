import { TestBed } from '@angular/core/testing';

import { MuelleGuard } from './muelle.guard';

describe('MuelleGuard', () => {
  let guard: MuelleGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(MuelleGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
