import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  url = 'http://localhost:8080/API-in-PHP/clients';
  constructor(private http: HttpClient) { }

  
  getEmployees(): Observable<any>{
    return this.http.get(`${this.url}/select.php`);
  }

  getEmployeesWhere(id: number): Observable<any>{
    return this.http.get(`${this.url}/select.php?id=`+id);
  }

  addEmployees(employee: any): Observable<any>{
    return this.http.post(`${this.url}/insert.php`,JSON.stringify(employee));
  }

  updateEmployee(employee: any): Observable<any>{
    return this.http.put(`${this.url}/update.php`,JSON.stringify(employee));
  }



}
