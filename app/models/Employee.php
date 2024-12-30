<?php
    require_once __DIR__ . '/../core/Generic.php';

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

        public function setName($name)
        {
            $this->name = $name;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function setAge($age)
        {
            $this->age = $age;
        }

        public function setDesignation($designation)
        {
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

        public function updateEmployee($id) {
            try {
                // Construir la consulta SQL
                $query = "UPDATE employee SET name = :name, email = :email, age = :age, designation = :designation WHERE id = :id";
        
                // Preparar los parámetros
                $parameters = array(
                    ':name' => $this->name,
                    ':email' => $this->email,
                    ':age' => $this->age,
                    ':designation' => $this->designation,
                    ':id' => $id
                );
        
                // Llamar al método update de la clase Generic
                $rowAffecteds = $this->update($query, $parameters);
        
                if ($rowAffecteds > 0) {
                    return $rowAffecteds; // Número de filas afectadas
                } else if ($rowAffecteds === 0) {
                    // Ninguna fila afectada, quizás no hubo cambios
                    return 0;
                } else if ($rowAffecteds === -1) { 
                    //There was an error to update a row.
                    return -1;
                }
                else {
                    // En caso de error, `update` debería devolver false
                    throw new Exception("Error al ejecutar la actualización en la base de datos.");
                }
            } catch (Exception $e) {
                // Registrar el error (puedes usar un logger)
                error_log($e->getMessage());
        
                // Retornar un valor o lanzar una excepción según tu lógica
                return false;
            }
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

        public function deleteEmployee($id) {
      
            $query = "DELETE FROM employee WHERE id = :id";
            
            $parameters = array(
                ':id' => $id
            );
            
            $data = $this->delete($query, $parameters);
            
            return $data;
        }
    }
