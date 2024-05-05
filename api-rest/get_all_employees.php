<?php
    require_once('../include/Employee.php');
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Employee::get_all_clients();
    }