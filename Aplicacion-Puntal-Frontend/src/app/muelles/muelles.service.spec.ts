import { TestBed } from '@angular/core/testing';

import { MuellesService } from './muelles.service';

describe('MuellesService', () => {
  let service: MuellesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MuellesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
