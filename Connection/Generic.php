<?php
    require 'Database.php';

    class Generic {
        public static function select($query, $parameters) {
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
        
    }