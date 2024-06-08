 <?php
    header('Access-Control-Allow-Origin: http://localhost:8080');
    header('Access-Control-Allow-Headers: X-API-KEY, Origin, Content-Type, Accept, Access-Control-Request-Method');
    require_once 'C:\xampp\htdocs\API-in-PHP\models\Employee.php';
    $emp = new Employee();
    if (isset($_GET['id'])){
        echo json_encode($emp->getEmployeeId($_GET['id']));
    }
    else {
        echo json_encode($emp->getEmployees());
    }
    