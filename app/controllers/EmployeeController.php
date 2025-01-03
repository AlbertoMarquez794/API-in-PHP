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
        //var_dump($uriSegments);
        $op = count( $uriSegments);
        switch ($op){
            case 4:
                $ent = intval($uriSegments[3]);
                if (isset($ent) && is_numeric($ent)) {
                    $id = $ent;
                }
                break;
            case 5: 
                if ($uriSegments[4] == "edit"){
                    $ent = intval($uriSegments[3]);
                    if (isset($ent) && is_numeric($ent)) {
                        $id = $ent;
                    }
                }
                else {
                    $ent = intval($uriSegments[4]);
                    if (isset($ent) && is_numeric($ent)) {
                        $id = $ent;
                    }
                }
                break;
        }
        switch ($requestMethod) {
            case 'GET':
                if (isset($id)) {
                    // Obtener los datos del empleado
                    $employeeData = $this->getEmployeeId($id); // Aquí obtienes el JSON
                    // Decodificar el JSON antes de pasar a la vista
                    $employeeData = json_decode($employeeData, true); // Decodificamos el JSON
                    return $employeeData;
                }
                else {
                    $employeeData = $this->getEmployees();
                    return $employeeData;
                }
            case 'PUT':
                $inputData = json_decode(file_get_contents('php://input'), true);
                 // Verificar que todos los campos necesarios estén presentes
                if (!isset($inputData['age']) || !isset($inputData['designation']) || !isset($inputData['name']) || !isset($inputData['email'])) {
                    echo json_encode(['error' => 'Datos incompletos o inválidos']);
                    return;
                }
                // Validar que el correo electrónico tenga un formato correcto
                if (!filter_var($inputData['email'], FILTER_VALIDATE_EMAIL)) {
                    echo json_encode(['error' => 'El correo electrónico no tiene un formato válido']);
                    return;
                }
            
                // Validar que la edad sea un número y esté dentro de un rango válido
                if (!is_numeric($inputData['age']) || $inputData['age'] <= 0 || $inputData['age'] > 120) {
                    echo json_encode(['error' => 'La edad no es válida']);
                    return;
                }
            
                // Si todos los campos están presentes y son válidos, actualizar el empleado
                $this->updateEmployee($id, $inputData);
                break;
            case 'POST':
                $inputData = json_decode(file_get_contents('php://input'), true);
                $this->insertEmployee( $inputData);
                break;
            case 'DELETE':
                // Decodifica el cuerpo de la solicitud
                $inputData = json_decode(file_get_contents('php://input'), true);
            
                // Verifica que se haya recibido un 'id' válido
                if (!isset($inputData['id']) || !is_numeric($inputData['id'])) {
                    http_response_code(400); // Código de respuesta para "Bad Request"
                    echo json_encode(['error' => 'ID inválido o no proporcionado']);
                    break;
                }
            
                // Llama a la función para eliminar al empleado
                $this->deleteEmployee($inputData['id']);
            
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

    public function insertEmployee($inputData){

        $this->employee->setAge($inputData['age']);
        $this->employee->setDesignation($inputData['designation']);
        $this->employee->setName($inputData['name']);
        $this->employee->setEmail($inputData['email']);

        // Lógica para actualizar el empleado en la base de datos
        header('Content-Type: application/json'); // Establece el tipo de contenido como JSON
        $res = $this->employee->insertEmployee();

        if ($res){
            http_response_code(200);
            echo json_encode(['message' => 'Employee added correctly']);
        }
        else {
            echo json_encode(['error' => 'Error uploading employee']);
        }
    }
    public function updateEmployee($id, $inputData)
    {
        // Asegúrate de que estás utilizando correctamente los datos proporcionados
        $this->employee->setAge($inputData['age']);
        $this->employee->setDesignation($inputData['designation']);
        $this->employee->setName($inputData['name']);
        $this->employee->setEmail($inputData['email']);

        // Lógica para actualizar el empleado en la base de datos
        header('Content-Type: application/json'); // Establece el tipo de contenido como JSON

        $rowAffecteds = $this->employee->updateEmployee($id);
        
        if ($rowAffecteds > 0) {
            http_response_code(200);
            echo json_encode(['message' => 'Employee updated correctly']);
        } else if ($rowAffecteds === 0){
            //http_response_code(304); // Not Modified
            echo json_encode(['message' => 'There is no new data to update']);
        } 
        else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar el empleado']);
        }
    }




    public function deleteEmployee($id)
    {
        // Lógica para actualizar el empleado en la base de datos
        header('Content-Type: application/json'); // Establece el tipo de contenido como JSON
        $rowAffecteds = $this->employee->deleteEmployee($id);
        if ($rowAffecteds > 0) {
            http_response_code(200);
            echo json_encode(['message' => 'Employee deleted correctly']);
        }
        else {
            http_response_code(200);
            echo json_encode(['error' => 'Failed to delete employee']);
        }
    }

}
