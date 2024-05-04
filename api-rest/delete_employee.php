<?php
    require_once('../include/Employee.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && 
    isset($_GET['id'])) {
        Employee::delete_employee($_GET['id']);
    }
