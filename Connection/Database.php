<?php

    class Database{
        private $host = "localhost";
        private $user = "root";
        private $pss = "";
        private $database = "employee";

        public function getConnection(){
            $hostDB = "mysql:host=".$this->host.";dbname=".$this->database.";";

            try{
                $connection = new PDO($hostDB, $this->user, $this->pss);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            } catch (PDOException $e){
                die("ERROR: ".$e->getMessage());
            }
        }


    }
    