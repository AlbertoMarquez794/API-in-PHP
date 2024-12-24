<?php
require_once __DIR__ . '/../models/Employee.php';// Ajusta la ruta si es necesario
class EmployeeController
{
    private $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    public function handleRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uriSegments = explode('/', trim($uri, '/')); // Divide la URL

        if (isset($uriSegments[3]) && is_numeric($uriSegments[3])) {
            $id = $uriSegments[3];
        }

        switch ($requestMethod) {
            case 'GET':
                if (isset($id)) {
                    // Obtener los datos del empleado
                    $employeeData = $this->getEmployeeId($id); // Aquí obtienes el JSON
                    // Decodificar el JSON antes de pasar a la vista
                    $employeeData = json_decode($employeeData, true); // Decodificamos el JSON
                    require_once '../app/views/employees/empInf.php'; // Pasamos los datos a la vista
                } else {
                    return $this->getEmployees();
                }
                break;
            default:
                echo json_encode(['mensaje' => 'Método no permitido']);
                break;
        }
    }


    public function getEmployees()
    {
        $emp = $this->employee->getEmployees();
        //echo json_encode($emp);
        return $emp;
    }

    public function getEmployeeId($id)
    {
        $empI = $this->employee->getEmployeeId($id);
        return json_encode($empI);
    }
    
    /*
    public function insertar()
    {
        // Leer y decodificar el cuerpo de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar si el JSON es válido
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode([
                'status' => 'error',
                'message' => 'JSON inválido: ' . json_last_error_msg()
            ]);
            exit;
        }

        // Realizar la inserción
        $resultado = $this->refranModel->insertar($data);
        echo json_encode($resultado);
    }

    public function actualizar($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode([
                'status' => 'error',
                'message' => 'JSON inválido: ' . json_last_error_msg()
            ]);
            exit;
        }

        $resultado = $this->refranModel->actualizar($id, $data);
        echo json_encode($resultado);
    }

    public function eliminar($id)
    {
        $resultado = $this->refranModel->eliminar($id);
        echo json_encode($resultado);
    }
    */
}
