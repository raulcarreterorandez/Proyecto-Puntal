import { TestBed } from '@angular/core/testing';

import { InstalacionesService } from './instalaciones.service';

describe('InstalacionesService', () => {
  let service: InstalacionesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(InstalacionesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
