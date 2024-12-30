<?php
    require_once __DIR__ . '/../core/Database.php';

    class Generic {
        public function select($query, $parameters) {
            try {
                $database = new Database();
                $conn = $database->getConnection();
                $stmt = $conn->prepare($query);

                if ($stmt->execute($parameters)) {
                    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $rs;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                error_log("Error selecting records: " . $e->getMessage());
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
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                error_log("Error inserting record: " . $e->getMessage());
                return false;
            } finally {
                $conn = null;
            }
        }
        
        public function update($query, $parameters) {
            $res = -1; // Inicializar el resultado por defecto
            try {
                $database = new Database();
                $conn = $database->getConnection();
                $stmt = $conn->prepare($query);
        
                // Ejecutar la consulta con los parámetros proporcionados
                $stmt->execute($parameters);
        
                // Obtener el número de filas afectadas
                $res = $stmt->rowCount();	
            } catch (PDOException $e) {
                // Manejo de errores: puedes registrar el error o lanzar una excepción personalizada
                error_log("Error en la actualización: " . $e->getMessage());
                throw new Exception("Error al ejecutar la consulta.");
            } finally {
                // Asegurarte de liberar recursos cerrando las conexiones
                $stmt = null;
                $conn = null;
            }
        
            return $res; // Retorna el número de filas afectadas
        }
        

        public function delete($query, $parameters) {
            try {
                $database = new Database();
                $conn = $database->getConnection();
                $stmt = $conn->prepare($query);
                $stmt->execute($parameters);
                $res = $stmt->rowCount();
            } catch (Exception $e) {
                $res = 0;
            }
            
            $database = null;
            return $res;
        }
        
    }