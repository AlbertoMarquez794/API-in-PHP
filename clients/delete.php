<?php
    header('Access-Control-Allow-Origin: http://localhost:8080');
    header('Access-Control-Allow-Headers: X-API-KEY, Origin, Content-Type, Accept, Access-Control-Request-Method');
    header('Access-Control-Allow-Methods: DELETE');
    require_once "Models/Employee.php";

    if (isset($_GET['id'])){
        if ($emp->deleteEmployee($_GET['id'])> 0){
            echo json_encode(['insert' => TRUE]);
        } 
        else {
            echo json_encode(['insert' => FALSE]);
        }
    }
    else {
        echo json_encode(['insert' => FALSE]);
    }