<?php
    header('Access-Control-Allow-Origin: http://localhost:8080');
    header('Access-Control-Allow-Headers: X-API-KEY, Origin, Content-Type, Accept, Access-Control-Request-Method');
    header('Access-Control-Allow-Methods: PUT');
    require_once "Models/Employee.php";

    // Get the raw POST data
    $rawData = file_get_contents('php://input');
    // Decode the JSON data
    $inf = json_decode($rawData);
    if ($inf != null){
        $name = $inf->name;
        $email = $inf->email;
        $age = $inf->age;
        $designation = $inf->designation;
        $id = $inf->id;
        $emp = new Employee($name, $email, $age, $designation); 
        if ($emp->updateEmployee($id)>0){
            echo json_encode(['insert' => TRUE]);
        } 
        else {
            echo json_encode(['insert' => FALSE]);
        }
    }
    else {
        echo json_encode(['insert' => FALSE]);
    }