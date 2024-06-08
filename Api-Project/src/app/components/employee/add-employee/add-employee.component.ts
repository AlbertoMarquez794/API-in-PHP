import { Component, OnInit } from '@angular/core';
import { Employee } from "../../../classes/employee";
import { EmployeeService } from "../../../services/employees/employee.service";

@Component({
  selector: 'app-add-employee',
  templateUrl: './add-employee.component.html',
  styleUrls: ['./add-employee.component.css' ]  // Corrected property name
})

export class AddEmployeeComponent implements OnInit {
  employee = new Employee(0, '', '', 0, '');

  constructor(private employeeService: EmployeeService) {}

  ngOnInit(): void {}

  add(){
    console.log(this.employee);
  }
}
