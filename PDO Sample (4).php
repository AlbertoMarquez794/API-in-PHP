<?php
	$dsn_db = 'mysql:dbname=Track_posgrados;host=localhost';
	$user_db = 'Track_posgrados';
	$psw_db = '';

	//metodo generico para hacer un insert
	function insert($query, $parametros){
		global $dsn_db;
		global $user_db;
		global $psw_db;
		$resultado = null;
		
		try {
			$pdo = new PDO($dsn_db, $user_db, $psw_db, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$stmt = $pdo->prepare($query);
			$stmt->execute($parametros);
			$resultado = $pdo->lastInsertId();		
		} catch (Exception $e) {
			echo "Ocurrió un error.<br/><br/>";
			echo $query;
			echo $e;
		}
		
		$pdo = null;
		return $resultado;
	}

	//metodo generico para hacer un select
	function select($query, $parametros){
		global $dsn_db;
		global $user_db;
		global $psw_db;
		$resultado = null;
		
		try {
			$pdo = new PDO($dsn_db, $user_db, $psw_db, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$stmt = $pdo->prepare($query);
			$stmt->execute($parametros);
			$resultado = $stmt->fetchAll();
		} catch (Exception $e) {
			echo "Ocurrió un error.<br/><br/>";
			echo $query;
			echo $e;
		}
		
		$pdo = null;
		return $resultado;
	}

	//metodo generico para hacer un update
	function update($query,$parametros){
		global $dsn_db;
		global $user_db;
		global $psw_db;
		$resultado = null;
		
		try {
			$pdo = new PDO($dsn_db, $user_db, $psw_db, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$stmt = $pdo->prepare($query);
			$stmt->execute($parametros);
			$resultado = $stmt->rowCount();		
		} catch (Exception $e) {
			echo "Ocurrió un error.<br/><br/>";
			echo $query;
			echo $e;
		}
		
		$pdo = null;
		return $resultado;
	}

	function encuentraPersona($par_aspirante_email){
		if($par_aspirante_email == null or $par_aspirante_email == ""){
			return null;
		}

		$query = "SELECT id_aspirante FROM aspirantes WHERE aspirante_email = :par_aspirante_email ORDER BY id_aspirante DESC LIMIT 1";
		$parametros = array(':par_aspirante_email' => $par_aspirante_email);
		
		return select($query, $parametros);
	}

	function actualizaPaterno($par_id_aspirante, $par_paterno){
		if($par_id_aspirante == "" or intval($par_id_aspirante) < 1 or $par_paterno == ""){
			return;
		}

		$query = "UPDATE aspirantes SET aspirante_appaterno = :par_paterno WHERE id_aspirante = :par_id_aspirante";
		$parametros = array(':par_id_aspirante' => intval($par_id_aspirante), ':par_paterno' => $par_paterno);
		
		return update($query, $parametros);
	}

	function insertaAspirante($par_email, $par_nombre, $par_paterno, $par_materno, $par_telefono, $par_codigo_postal, $par_id_univ){
		if($par_email == ""){
			return;
		}

		$query = "INSERT INTO aspirantes(aspirante_email, aspirante_nombre, aspirante_appaterno, aspirante_apmaterno, aspirante_tel, aspirante_cp, id_univ, fechainscripcion) VALUES (:par_email, :par_nombre, :par_paterno, :par_materno, :par_telefono, :par_codigo_postal, :par_id_univ, NOW())";
		$parametros = array(':par_email' => $par_email, ':par_nombre' => $par_nombre, ':par_paterno' => $par_paterno, ':par_materno' => $par_materno, ':par_telefono' => $par_telefono, ':par_codigo_postal' => $par_codigo_postal, ':par_id_univ' => $par_id_univ);

		return insert($query, $parametros);
	}
?>