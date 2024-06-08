import { NgModule } from '@angular/core';
import { BrowserModule, provideClientHydration } from '@angular/platform-browser';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ListsEmployeesComponent } from './components/Employee/lists-employees/lists-employees.component';
import { AddEmployeeComponent } from './components/Employee/add-employee/add-employee.component';
import { UpdateEmployeeComponent } from './components/Employee/update-employee/update-employee.component';

@NgModule({
  declarations: [
    AppComponent,
    ListsEmployeesComponent,
    AddEmployeeComponent,
    UpdateEmployeeComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpClientModule
  ],
  providers: [
    provideClientHydration()
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
