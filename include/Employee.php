<?php
    require_once('../include/Database.php');
    
    class Employee{
        public static function create_employee($name, $email, $age, $designation){
            $database = new Database();
            $conn = $database->getConnection();

            $st = $conn->prepare("INSERT INTO employee (name, email, age, designation) VALUES (:name, :email, :age,:designation)");
            $st->bindParam(":name", $name);
            $st->bindParam(":email", $email);
            $st->bindParam(":age", $age);
            $st->bindParam(":designation", $designation);

            if ($st->execute()){
                header('HTTP/1.1 201 Employee created correctly');
            }
            else {
                header('HTTP/1.1 404 Employee hasnt created correctly');
            }

        }

        public static function delete_employee($id){
            $database = new Database();
            $conn = $database->getConnection();

            $st = $conn->prepare("DELETE FROM employee WHERE id = :id");
            $st->bindParam(":id", $id);

            if ($st->execute()){
                header('HTTP/1.1 201 Employee deleted correctly');
            }
            else {
                header('HTTP/1.1 404 Employee hasnt deleted correctly');
            }

        }
    }