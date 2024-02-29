<?php
    require_once ("ConnectionG.php");


    class Employees_Api extends ConnectionG{

		private $connection;



		public function __construct(){
			$conn = new ConnectionG();
			$this->connection = $conn->getDb();
		}


		public function insert($query, $parameters){
			$resultado = null;
			
			try {
				$pdo = $this->connection;
				$stmt = $pdo->prepare($query);
				$stmt->execute($parameters);
				$resultado = $pdo->lastInsertId();		
			} catch (Exception $e) {
				echo "Ocurrió un error.<br/><br/>";
				echo $query;
				echo $e;
			}
			
			$pdo = null;
			return $resultado;
		}

	}
?>