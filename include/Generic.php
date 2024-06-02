<?php
require_once('../include/Database.php');

class Generic {
    public static function select($query, $parameters) {
        try {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare($query);

            if ($stmt->execute($parameters)) {
                $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($rs);
                http_response_code(200); // OK
            } else {
                http_response_code(404); // ERROR
            }
        } catch (PDOException $e) {
            error_log("Error selecting records: " . $e->getMessage());
            http_response_code(500); // Internal Server Error
        } finally {
            $conn = null;
        }
    }
    public function insert($query, $parameters) {
        try {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare($query);
            if ($stmt->execute($parameters)) {
                http_response_code(201); // Created
                echo json_encode(['message' => 'Empleado creado correctamente']);
                return true;
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['message' => 'Error al crear el empleado']);
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error inserting record: " . $e->getMessage());
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Error interno del servidor']);
            return false;
        } finally {
            $conn = null;
        }
    }
    

    public static function delete($query, $parameters = []) {
        try {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare($query);
    
            // Bind parameters if provided
            foreach ($parameters as $param => $value) {
                $stmt->bindValue($param, $value);
            }
    
            if ($stmt->execute()) {
                http_response_code(204); // No Content
                return true;
            } else {
                http_response_code(404); // Not Found
                echo json_encode(['message' => 'Error al eliminar el registro']);
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error deleting record: " . $e->getMessage());
            http_response_code(500); // Internal Server Error
            echo json_encode(['message' => 'Error interno del servidor']);
            return false;
        } finally {
            $conn = null;
        }
    }
    
}

