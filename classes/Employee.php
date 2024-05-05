<?php
    require_once('../include/Generic.php');

    class Employee extends Generic{

        private $name;
        private $email;
        private $age;
        private $desgination;


        public function __construct($name = null, $email = null, $age = null, $desgination = null){
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->desgination = $desgination;
        }


        public function getEmployees(){
            $this->select("SELECT * FROM employee",  null);
        }

              
        public function insertEmployee(){
            $query = "INSERT INTO employee (name, email, age, designation) VALUES (:name, :email, :age,:designation)";
            $parameters = array(':name'=>$this->name, ':email'=>$this->email, ':age'=>$this->age, ':designation'=>$this->desgination);
            $this->insert($query, $parameters);
        }

        public function deleteEmployee($id){
            $query = "DELETE FROM employee WHERE id = :id";
            $parameters = array(':id'=>$id);
            $this->delete($query, $parameters);
        }
    }