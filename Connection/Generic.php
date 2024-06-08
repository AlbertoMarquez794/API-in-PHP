<?php
    require 'Database.php';

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