<?php 
    require_once "Models/Employee.php";

    switch ($_SERVER['REQUEST_METHOD']){
        case 'GET':
            $emp = new Employee();
            if (isset($_GET['id'])){
                echo json_encode($emp->getEmployeeId($_GET['id']));
            }
            else {
                echo json_encode($emp->getEmployees());
            }
            
            break;
        case 'POST':
           // Get the raw POST data
            $rawData = file_get_contents('php://input');
            // Decode the JSON data
            $inf = json_decode($rawData);

            if ($inf != null){
                $name = $inf->name;
                $email = $inf->email;
                $age = $inf->age;
                $designation = $inf->designation;
                $emp = new Employee($name, $email, $age, $designation); 
                if ($emp->insertEmployee()){
                    http_response_code(200);
                } 
                else {
                    http_response_code(400);
                }
            }
            else {
                http_response_code(405);
            }
            break;
        default:
            break;
    }
