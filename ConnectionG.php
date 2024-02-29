<?php
class ConnectionG {
    private $connect;

    public function __construct(){
        try {
            $this->connect = new PDO("mysql:host=localhost;dbname=sgl_information2;charset=utf8", "root", "");
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Succesfull Connection";
        } catch (PDOException $e) {
            // Manejo específico de errores de PDO
            $this->connect = 'Error de conexión de PDO';
            error_log("PDOException: " . $e->getMessage());
        } catch (Exception $e) {
            // Manejo de otros tipos de excepciones
            $this->connect = 'Error de conexión general';
            error_log("Exception: " . $e->getMessage());
        }
    }

    public function getDb(){
        return $this->connect;
    }

}
