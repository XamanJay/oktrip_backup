<?php

class db
{

	function __construct(){}


	function connection(){

		try {

			$dsn = "mysql:dbname=oktravel;host=localhost;charset=UTF8";
			$conn = new PDO($dsn, "root", "");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
			
		} catch (Exception $e) {
			$message = "Hubo un problema con la conexión a la base de datos para mas información: ".$e->getMessage();
		}
	}

	function conn_local(){

		try {

			ini_set('max_execution_time', 0);
			//$dsn = "mysql:dbname=oktravel;host=localhost;charset=UTF8";
			//$conn = new PDO($dsn, "root", "");
			$dsn = "mysql:dbname=ooktrip_db;host=okcloud.arvixecloud.com;charset=UTF8";
			$conn = new PDO($dsn, "ooktrip_kike", "Jackass1,");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $conn;
			
		} catch (Exception $e) {
			$message = "Hubo un problema con la conexión a la base de datos para mas información: ".$e->getMessage();
		}
	}

		function conn_remote(){

		try {

			ini_set('max_execution_time', 0);
			$dsn = "mysql:dbname=adharaca_operadora;host=okcloud.arvixecloud.com;charset=UTF8";
			$conn = new PDO($dsn, "adharaca_pablo", "Harimakenji01@");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $conn;
			
		} catch (Exception $e) {
			$message = "Hubo un problema con la conexión a la base de datos para mas información: ".$e->getMessage();
		}
	}

	function conn_local_clubestrella(){

		try {

			$dsn = "mysql:dbname=clubestr_ella;host=okcloud.arvixecloud.com;charset=UTF8";
			$conn = new PDO($dsn, "clubestr_adhara", "Harimakenji01@");
			//$dsn = "mysql:dbname=clubestrella;host=localhost;charset=UTF8";
			//$conn = new PDO($dsn, "root", "");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
			
		} catch (Exception $e) {
			$message = "Hubo un problema con la conexión a la base de datos para mas información: ".$e->getMessage();
		}
	}

	//SELECT: Consultas a la base de datos
	//Consultas sólo un registro -> fetch
	function select($query){
		try {
			$conn =  $this->connection();
			$stmt = $conn->query($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			$conn = NULL;
			if($count > 0){
				$rows = $stmt->fetch(PDO::FETCH_ASSOC);
				return $rows;
			}
			return false;
		} catch (Exception $e) {
			return $e;			
		}

	}

	//Consultas todos los registros -> fetchAll
	function selectAll($query){
		try {
			$conn =  $this->connection();
			$stmt = $conn->query($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			$conn = NULL;
			if($count > 0){
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $rows;
			}
			return NULL;
		} catch (Exception $e) {
			return $e;			
		}

	}
}


?>