<?php
    require_once('../include/Generic.php');
    require_once('../classes/Employee.php');

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Leer el cuerpo de la solicitud como JSON
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (isset($data['id'])) {
            $emp = new Employee();
            $result = $emp->deleteEmployee($data['id']);
            
            if ($result) {
                http_response_code(200); // OK
                echo json_encode(['message' => 'Empleado eliminado correctamente']);
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(['message' => 'Error al eliminar el empleado']);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['message' => 'ID de empleado no proporcionado']);
        }
    } else {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['message' => 'Método no permitido']);
    }
?>
