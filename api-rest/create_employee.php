<?php
    require_once('../include/Employee.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && 
    isset($_GET['name']) && isset($_GET['email']) && isset($_GET['age']) && isset($_GET['designation'])) {
        Employee::create_employee($_GET['name'], $_GET['email'], $_GET['age'], $_GET['designation']);
    }

