import { TestBed } from '@angular/core/testing';
import { InstalacionGuard } from './instalacion.guard';

describe('InstalacionGuard', () => {
  let guard: InstalacionGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(InstalacionGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
