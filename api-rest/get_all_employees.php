<?php
    require_once('../include/Generic.php');
    require_once('../classes/Employee.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $emp = new Employee();
        $emp->getEmployees();
        //Function created correctly
    }