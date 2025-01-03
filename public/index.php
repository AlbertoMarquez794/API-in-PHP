<?php

// Manual Loader for Controllers
function loadController($controllerName)
{
    $filePath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Controller not found: ' . $controllerName]);
        exit;
    }
}

// Load the EmployeeController manually
loadController('EmployeeController');

// Routing Class
class Router
{
    private $routes = [];

    /**
     * Add a route pattern and its handler.
     */
    public function add($pattern, $callback)
    {
        $this->routes[$pattern] = $callback;
    }

    /**
     * Dispatch the incoming request to the matching route.
     */
    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/');

        foreach ($this->routes as $pattern => $callback) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches); // Remove the full match
                return call_user_func_array($callback, $matches);
            }
        }

        // Handle 404 Not Found
        http_response_code(404);
        echo json_encode(['message' => 'Página no encontrada']);
    }
}

// Initialize Router
$router = new Router();

// Define Routes
$router->add('/^\/API-in-PHP\/public\/employees\/(\d+)$/', function ($id) {
    $controller = new EmployeeController();
    $empId = $controller->handleRequest(); // Procesa GET
    require_once '../app/views/employees/empInf.php';
});

$router->add('/^\/API-in-PHP\/public\/employees$/', function () {
    $controller = new EmployeeController();
    $employees = $controller->handleRequest(); // Procesa GET o POST
    require_once '../app/views/employees/index.php';
});

$router->add('/^\/API-in-PHP\/public\/employees\/(\d+)\/edit$/', function ($id) {
    $controller = new EmployeeController();
    $empId = $controller->handleRequest(); // Procesa GET para editar
    require_once '../app/views/employees/empEdt.php';
});

$router->add('/^\/API-in-PHP\/public\/employees\/up\/(\d+)$/', function ($id) {
    $controller = new EmployeeController();
    $empId = $controller->handleRequest(); // Procesa PUT para actualizar
});

$router->add('/^\/API-in-PHP\/public\/employees\/createEmployee$/', function () {
    require_once '../app/views/employees/createEmployee.php';
});

$router->add('/^\/API-in-PHP\/public\/employees\/newEmployee$/', function () {
    $controller = new EmployeeController();
    $controller->handleRequest(); // Process 'POST'
});

$router->add('/^\/API-in-PHP\/public\/employees\/deleteEmployee$/', function () {
    $controller = new EmployeeController();
    $controller->handleRequest(); // Process 'DELETE'
});

// Dispatch Request
$router->dispatch();
