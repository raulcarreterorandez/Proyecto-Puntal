import { TestBed } from '@angular/core/testing';

import { PlazasService } from './plazas.service';

describe('PlazasService', () => {
  let service: PlazasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PlazasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
