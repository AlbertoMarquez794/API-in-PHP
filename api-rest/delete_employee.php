<?php
    require_once('../include/Generic.php');
    require_once('../classes/Employee.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && 
    isset($_GET['id'])) {
        $emp = new Employee();
        $emp->deleteEmployee($_GET['id']);
        //Employee::delete_employee($_GET['id']);
    }
