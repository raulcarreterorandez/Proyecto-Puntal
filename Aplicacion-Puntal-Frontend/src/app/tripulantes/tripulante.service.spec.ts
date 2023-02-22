import { TestBed } from '@angular/core/testing';

import { TripulanteService } from './tripulante.service';

describe('TripulanteService', () => {
  let service: TripulanteService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TripulanteService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
