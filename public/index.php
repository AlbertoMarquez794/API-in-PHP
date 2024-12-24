<?php

require_once __DIR__ . '/../app/controllers/EmployeeController.php';

// Get the path to request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Clan the path of any trailing slashes to avoid problems
$uri = rtrim($uri, '/');

// Check which controller to use base on URI
if (preg_match('/^\/API-in-PHP\/public\/employees\/(\d+)$/', $uri, $matches)) {
    $controller = new EmployeeController();
    $empId = $controller->handleRequest();
    require_once '../app/views/employees/empInf.php';
    
} elseif ($uri === '/API-in-PHP/public/employees') {
    $controller = new EmployeeController();
    $employees = $controller->handleRequest();
    require_once '../app/views/employees/index.php';
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Página no encontrada']);
}
