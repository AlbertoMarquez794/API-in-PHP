<?php
    require_once('../include/Generic.php');
    require_once('../classes/Employee.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && 
    isset($_GET['name']) && isset($_GET['email']) && isset($_GET['age']) && isset($_GET['designation'])) {
        $emp = new Employee($_GET['name'], $_GET['email'], $_GET['age'], $_GET['designation']);
        $emp->insertEmployee();
    }

