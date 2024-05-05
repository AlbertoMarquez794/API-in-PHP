<?php
    require_once('../include/Database.php');


    class Generic{
        public static function select($query, $parameters){
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare($query);

            if ($stmt->execute($parameters)){
                $rs = $stmt->fetchAll();
                echo json_encode($rs);
                header('HTTP/1.1 201 OK');
            }
            else {
                header('HTTP/1.1 404 ERROR');
            }
        }

        public function insert($query, $parameters){
    
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare($query);
            if ($stmt->execute($parameters)){
                header('HTTP/1.1 201 Employee created correctly');
            }
            else {
                header('HTTP/1.1 404 Employee hasnt created correctly');
            }

        }

        public function delete($query, $parameters = []) {
            try {
                $database = new Database();
                $conn = $database->getConnection();
                
                $stmt = $conn->prepare($query);
                
                // Bind parameters if provided
                foreach ($parameters as $param => $value) {
                    $stmt->bindParam($param, $value);
                }
        
                if ($stmt->execute()) {
                    header('HTTP/1.1 201 Deleted correctly');
                } else {
                    header('HTTP/1.1 404 ERROR');
                }
            } catch (PDOException $e) {
                // Log or handle the exception appropriately
                error_log("Error deleting record: " . $e->getMessage());
                return false; // Return false in case of an exception
            } finally {
                // Close the database connection
                $conn = null;
            }
        }
    }