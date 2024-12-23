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

        switch ($requestMethod) {
            case 'GET':
                if (isset($_GET['id'])) {
                    $this->getEmployeeId($_GET['id']);
                } else {
                    $this->getEmployees();
                }
                break;
                /*
            case 'POST':
                $this->insertar();
                break;
            case 'PUT':
                if (isset($_GET['id'])) {
                    $this->actualizar($_GET['id']);
                }
                break;
            case 'DELETE':
                if (isset($_GET['id'])) {
                    $this->eliminar($_GET['id']);
                }
                break;
                */
            default:
                echo json_encode(['mensaje' => 'Método no permitido']);
                break;
        }
    }

    public function getEmployees()
    {
        $emp = $this->employee->getEmployees();
        echo json_encode($emp);
    }

    public function getEmployeeId($id)
    {
        $empI= $this->employee->getEmployeeId($id);
        echo json_encode($empI);
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
