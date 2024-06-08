import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ListsEmployeesComponent } from './components/Employee/lists-employees/lists-employees.component';
import { AddEmployeeComponent } from './components/Employee/add-employee/add-employee.component';
import { UpdateEmployeeComponent } from './components/Employee/update-employee/update-employee.component';

const routes: Routes = [

  {
    path: '',
    component: ListsEmployeesComponent
  },
  {
    path: 'addEmployee',
    component: AddEmployeeComponent
  },
  {
    path: 'updateEmployee/:id',
    component: UpdateEmployeeComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
