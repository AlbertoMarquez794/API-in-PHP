<?php
    require_once 'C:\xampp\htdocs\API-in-PHP\Connection\Generic.php';
    class Employee extends Generic {

        private $name;
        private $email;
        private $age;
        private $designation;

        public function __construct($name = null, $email = null, $age = null, $designation = null) {
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->designation = $designation;
        }

        public function getEmployees() {
            $data = $this->select("SELECT * FROM employee", null);
            $inf = array();
            if ($data != null && is_array($data)){
                foreach ($data as $row) {
                    $inf[] = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'age' => $row['age'],
                        'designation' => $row['designation']
                    );
                }
            }

            return $data;
        }

        public function getEmployeeId($id){
            $parameters = array(':id' => $id);
            $data = $this->select("SELECT * FROM employee WHERE id = :id", $parameters);
            $inf = array();
            if ($data != null && is_array($data)){
                foreach ($data as $row) {
                    $inf[] = array(
                        'id' => $row['id'],
                    );
                }
            }
            return $data;
        }

        public function insertEmployee() {
            // Construir la consulta SQL
            $query = "INSERT INTO employee (name, email, age, designation) VALUES (:name, :email, :age, :designation)";
            
            // Preparar los parámetros
            $parameters = array(
                ':name' => $this->name,
                ':email' => $this->email,
                ':age' => $this->age,
                ':designation' => $this->designation
            );
            
            // Llamar al método insert de la clase Generic
            $data =  $this->insert($query, $parameters);

            
            return $data;
        }
    }
