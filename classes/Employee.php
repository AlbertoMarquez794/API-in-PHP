<?php
require_once('../include/Generic.php');

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
        $this->select("SELECT * FROM employee", null);
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
        $this->insert($query, $parameters);
    }
    
    public function deleteEmployee($id) {
        $query = "DELETE FROM employee WHERE id = :id";
        $parameters = array(':id' => $id);
        return $this->delete($query, $parameters);
    }
}

