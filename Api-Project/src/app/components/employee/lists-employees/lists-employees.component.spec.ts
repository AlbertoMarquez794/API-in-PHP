import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListsEmployeesComponent } from './lists-employees.component';

describe('ListsEmployeesComponent', () => {
  let component: ListsEmployeesComponent;
  let fixture: ComponentFixture<ListsEmployeesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ListsEmployeesComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListsEmployeesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
