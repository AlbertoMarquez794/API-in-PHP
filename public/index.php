<?php

require_once __DIR__ . '/../app/controllers/EmployeeController.php';

// Obtener la ruta de la solicitud
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Limpiar la ruta de cualquier barra diagonal final para evitar problemas
$uri = rtrim($uri, '/');

// Determinar qué controlador utilizar según la URI
if (preg_match('/^\/API-in-PHP\/public\/employees\/(\d+)$/', $uri, $matches)) {
    $id = $matches[1]; // Extrae el ID de la URL
    $controller = new EmployeeController();
    $controller->getEmployeeId($id);
} elseif ($uri === '/API-in-PHP/public/employees') {
    $controller = new EmployeeController();
    $controller->handleRequest();
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Página no encontrada']);
}
