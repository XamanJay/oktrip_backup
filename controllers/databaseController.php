<?php

/**
*  Incluir las tablas que tengas en la base de datos en este archivo tables.php
*/
include("tables.php");

class databaseController extends tables
{
	
	private $conn;
	private $table;
	private $query; //private

	public $lastId;
	public $message;
	public $error;

	function __construct($table = null)
	{
		$this->conn = $this->conn();
		$this->table = $table;
		$this->query = "";
		$this->message = array();
	}

	/*Instrucciones de conexión a la base de datos*/
	
	private function conn(){

		try 
		{
			ini_set('max_execution_time', 0);
			//$dsn = "mysql:dbname=ooktrip_db;host=localhost;charset=UTF8";
			//$conn = new PDO($dsn, "root", "");
			$dsn = "mysql:dbname=ooktrip_db;host=okcloud.arvixecloud.com;charset=UTF8";
			$conn = new PDO($dsn, "ooktrip_kike", "Jackass1,");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		} 
		catch (Exception $e)
		{
			$message = "Función: <b><i>conn()</i></b>. Hubo un problema con la conexión a la base de datos para mas información: ".$e->getMessage();
		}

	}

	public function setTable($table)
	{
		$this->table = $table;
		//print_r($this->table);
	}

	public function Select($fields, $Id)
	{
		try
		{

			if(empty($Id))
			{
				throw new Exception("El ID: ".$object->Id." del objeto no puede ser nulo.");
			}

			if(!$this->isId($Id))
			{
				throw new Exception("El ID: ".$object->Id." del objeto no existe en la tabla: ".$this->table);
			}

			$aux = "";
			$query = "";

			foreach ($fields as $field) {
				$aux .= $field.",";
			}

			$query = "SELECT ".rtrim($aux, ",")." FROM ".$this->table." WHERE Id = ".$Id.";";

			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();

			if($count > 0)
			{
				return $stmt->fetch(PDO::FETCH_ASSOC);
			}
			else
			{
				throw new Exception("No se encontraron resultados de la petición. Id: '".$Id."', Campos: '".rtrim($aux, ",")."', Tabla: '".$this->table."'");
			}

		}
		catch(Exception $e)
		{
			$this->error = "Función: <b><i>Select()</i></b>. Ocurrió un problema al procesar la petición. Exception: ".$e->getMessage();
		}
		return NULL;

	}

	public function SelectMany($fields)
	{
		try
		{

			$aux = "";
			$query = "";

			foreach ($fields as $field) {
				$aux .= $field.",";
			}

			$query = "SELECT ".rtrim($aux, ",")." FROM ".$this->table.";";

			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();

			if($count > 0)
			{
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
				throw new Exception("No se encontraron resultados de la petición. Id: '".$Id."', Campos: '".rtrim($aux, ",")."', Tabla: '".$this->table."'");
			}

		}
		catch(Exception $e)
		{
			$this->error = "Función: <b><i>SelectMany()</i></b>. Ocurrió un problema al procesar la petición. Exception: ".$e->getMessage();
		}
		return NULL;

	}

	public function Find($Id)
	{
		try 
		{
			if(empty($Id))
			{
				throw new Exception("El ID: ".$object->Id." del objeto no puede ser nulo.");
			}

			if(!$this->isId($Id))
			{
				throw new Exception("El ID: ".$object->Id." del objeto no existe en la tabla: ".$this->table);
			}

			$query = "SELECT * FROM ".$this->table." WHERE Id = ".$Id.";";
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0)
			{
				return $this->getModel($stmt->fetch(PDO::FETCH_ASSOC));
			}
			else
			{
				throw new Exception("No se encontraron resultados de la petición. Id: '".$Id."', Tabla: '".$this->table."'");
			}
		}
		catch (Exception $e)
		{
			$this->error = "Función: <b><i>Find()</i></b>. Ocurrió un problema al procesar la petición. Exception: ".$e->getMessage();
		}
		return NULL;
	}

	/*
	° Where -> array(
		array(
			"field" => $field,
			"value" => $value,
			"optMat" => "=",
			"optLog" => "AND"
		),
		array(
			"field" => $field,
			"value" => $value,
			"optMat" => "=",
			"optLog" => NULL -> El último debe estar en NULL (importante)
		),
		...
	);
	
	Operations mathematics values -> "=", ">", "<", "<=", 
	Operations logics values -> "AND", "OR", "NOT" 


	° Orderby -> array($field, $value, $opts)
		$field -> "field"
		$value -> "", 0, NULL,
		$opts -> DESC, ASC, NULL


	array(
		array(
			"field" => $field,
			"value" => $value,
			"opts" => "DESC"
		),
		array(
			"field" => $field,
			"value" => $value,
			"opts" => "ASC"
		)
	);

	° Select -> array(
					$field_1,
					$field_2,
					array(
						"field" => $field_3, 
						"as" => $as, 
						"from" => $fromTable || null || ""
					),
					array(
						"field" => $field_4, 
						"as" => $as, 
						"from" => $fromTable || null || ""
					),
					$field_5
					...
				)

	° Join -> array($innerJoin, $on)
		$innerJoin -> "table_2",
		$on -> array("Id", "3"), array("Id", "Id")


	array(
		array(
			"innerJoin" => $table,
			"on" => array(
				"fieldId" => $field_id, 
				"value" => $value, (valor o campo)
			)
		),
		...
	);
	
	Example

	array(
		array(
			"innerJoin" => "products",
			"on" => array("Id", "Id") --> El segundo parametro puede ser un valor o bien el nombre del campo a igualar
		)
	);


	*/
	public function Where($where, $select = null, $orderby = null, $join = null)
	{
		try 
		{
			$strOrderby = "";
			$strJoin = "";
			$strSelect = "*";

			$this->query = "";

			foreach ($where as $aux) {

				$this->query .= "(".$this->table.".".$aux["field"]." ".$aux["optMat"]." '".$aux["value"]."')";

				if(!empty($aux["optLog"]))
				{
					$this->query .= $aux["optLog"];
				}

			}

			if(!empty($orderby))
			{
				$strOrderby .= "ORDER BY ";
				foreach ($orderby as $aux) {

					$strOrderby .= $this->table.".".$aux["field"];

					if(!empty($aux["value"]))
					{
						$strOrderby .= "='".$aux["value"]."'";
					}

					if(!empty($aux["opts"]))
					{
						$strOrderby .= " ".$aux["opts"];
					}

					$strOrderby .= ",";

				}
			}

			if(!empty($select))
			{
				$strSelect = "";

				foreach ($select as $aux)
				{
					if(is_array($aux)) 
					{
						$strSelect .= ((empty($aux["from"])) ? $this->table : $aux["from"]).".".$aux["field"]." AS '".$aux["as"]."',";
					}
					else
					{
						$strSelect .= $this->table.".".$aux.",";
					}
				}

				$strSelect = rtrim($strSelect,",");
			}

			if(!empty($join))
			{
				$strJoin = "INNER JOIN ";
				foreach ($join as $aux) {
					$strJoin .= $aux["innerJoin"];
					$strJoin .= " ON ".$aux["innerJoin"].".".$aux["on"]["fieldId"]." = ".$aux["on"]["value"];
				}
			}

			$this->query = "SELECT ".$strSelect." FROM ".$this->table." ".$strJoin." WHERE ".$this->query." ".rtrim($strOrderby,",").";";
			//print_r($this->query);
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute();
			$count = $stmt->rowcount();

			if($count > 0)
			{
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			else
			{
				throw new Exception("No se encontraron resultados de la petición. Query: ".$this->query.", Tabla: '".$this->table."'");
			}

		}
		catch (Exception $e) {
			$this->error = "Función: <b><i>Where()</i></b>. Ocurrió un problema al procesar la petición. Exception: ".$e->getMessage();
			
		}
		return false;

	}


	public function Add($object)
	{
		$array = (array) $object;
		$query = "";
		$values = "";

		foreach ($array as $aux => $value) {
			if(!empty($array[$aux]))
			{
				$query .= $aux.",";
				$values .= "'".$array[$aux]."',";
			}
		}

		$this->query = "INSERT INTO ".$this->table." (".rtrim($query, ",").") VALUES (".rtrim($values, ",").");";
		//print_r($this->query);
		$this->Save();
	}

	public function Edit($object)
	{
		try
		{

			if(empty($object->Id))
			{
				throw new Exception("El ID: ".$object->Id." del objeto no puede ser nulo.");
			}

			if(!$this->isId($object->Id))
			{
				throw new Exception("El ID: ".$object->Id." del objeto no existe en la tabla: ".$this->table);
			}

			$array = (array) $object;
			$query = "";

			foreach ($array as $aux => $value) {
				if(!empty($array[$aux]))
				{
					$query .= $aux."='".$array[$aux]."',";
				}
			}

			$this->query = "UPDATE ".$this->table." SET ".rtrim($query, ",")." WHERE Id = ".$object->Id.";";
			$this->Save();
		}
		catch(Exception $e)
		{
			$this->error = "Función: <b><i>Edit()</i></b>. Ocurrió un problema al procesar la petición. Exception: ".$e->getMessage();
		}

	}

	public function Save()
	{
		try
		{
			//foreach ($this->queries as $aux) {
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0)
			{

				$this->lastId = $this->conn->lastInsertId();
				$this->message = array(
					"Table" => $this->table, 
					"Message" => "La petición se ha realizado con éxito. Id: '".$this->lastId."', Tabla: '".$this->table."'"
				);
			}
			else
			{

				$this->lastId = NULL;
				$this->message = array(
					"Table" => $this->table, 
					"Message" => "No se pudo realizar la petición: ".$this->query
				);
			}

			//}
			return true;
		}
		catch (Exception $e) 
		{
			$this->error = "Función: <b><i>Save()</i></b>. Ocurrió un problema al procesar la petición. Exception: ".$e->getMessage();
		}
		return false;

	}

	private function isId($id)
	{
		$stmt = $this->conn->prepare("SELECT * FROM ".$this->table." WHERE Id = ".$id);
		$stmt->execute();
		$count = $stmt->rowcount();
		if($count > 0) return true;
		else return false;

	}

	private function getModel($array)
	{
		switch ($this->table) {
			case "admins":

			$admin = new Admin();
			$admin->Id = $array["Id"];
			$admin->Username = $array["Username"];
			$admin->Email = $array["Email"];

			return $admin;

			break;
			case "cities":

			$city = new City();
			$city->Id = $array["Id"];
			$city->IdCity = $array["IdCity"];
			$city->Name = $array["Name"];
			$city->IdCountry = $array["IdCountry"];
			$city->Country = $array["Country"];
			$city->Path = $array["Path"];
			$city->Latitude = $array["Latitude"];
			$city->Longitude = $array["Longitude"];
			$city->lastUpdate = $array["lastUpdate"];
			$city->isDeleted = $array["isDeleted"];

			return $city;

			break;
			default:
			break;
		}
	}

}

?>