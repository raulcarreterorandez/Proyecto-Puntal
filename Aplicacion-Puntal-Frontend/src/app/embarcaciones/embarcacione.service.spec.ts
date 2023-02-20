import { TestBed } from '@angular/core/testing';

import { EmbarcacioneService } from './embarcacione.service';

describe('EmbarcacioneService', () => {
  let service: EmbarcacioneService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(EmbarcacioneService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
