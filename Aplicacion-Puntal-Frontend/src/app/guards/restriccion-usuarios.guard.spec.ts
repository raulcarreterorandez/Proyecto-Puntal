import { TestBed } from '@angular/core/testing';

import { RestriccionUsuariosGuard } from './restriccion-usuarios.guard';

describe('RestriccionUsuariosGuard', () => {
  let guard: RestriccionUsuariosGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(RestriccionUsuariosGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
