<?php

class clienteController
{
	
	function __construct(){}

	function create($cliente){
		try {
			$db = new db();		
			$conn = $db->conn_local_clubestrella();
			$query= "SELECT * FROM users WHERE Email = ? ;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$cliente->getEmail());
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0){
				$conn == null;
				echo json_encode(array("type" => "error" , "message" => "El correo ya se registro con anterioridad."));
			}else{

				$cliente->setId(uniqid("user_",true));
				$query = "INSERT INTO users(Id, Username, Email,Password) VALUES (?,?,?,AES_ENCRYPT('".$cliente->getPassword()."','test'));";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$cliente->getId());
				$stmt->bindParam(2,$cliente->getUsername());
				$stmt->bindParam(3,$cliente->getEmail());
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0)
				{
					$query = "INSERT INTO personas(Id, Nombre, Apellido_paterno,Apellido_materno) VALUES (?,?,?,?);";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1,$cliente->getId());
					$stmt->bindParam(2,$cliente->getNombre());
					$stmt->bindParam(3,$cliente->getApellidoPaterno());
					$stmt->bindParam(4,$cliente->getApellidoMaterno());
					$stmt->execute();
					$count = $stmt->rowCount();
					if($count > 0)
					{
						$query = "INSERT INTO clientes(Id, Puntos, NumeroSocio, Empresa, Telefono, Pais, Ciudad, Estado, CodigoPostal, Direccion, Fecha, isActive) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
						$stmt = $conn->prepare($query);
						$stmt->bindParam(1,$cliente->getId());
						$stmt->bindParam(2,$cliente->getPuntos());
						$stmt->bindParam(3,$cliente->getNumeroSocio());
						$stmt->bindParam(4,$cliente->getEmpresa());
						$stmt->bindParam(5,$cliente->getTelefono());
						$stmt->bindParam(6,$cliente->getPais());
						$stmt->bindParam(7,$cliente->getCiudad());
						$stmt->bindParam(8,$cliente->getEstado());
						$stmt->bindParam(9,$cliente->getCodigoPostal());
						$stmt->bindParam(10,$cliente->getDireccion());
						$stmt->bindParam(11,$cliente->getFecha());
						$stmt->bindParam(12,$cliente->getIsActive());
						$stmt->execute();
						$count = $stmt->rowCount();
						if($count > 0)
						{
							$conn == null;
							echo json_encode(array("type" => "success" , "message" => "El usuario ha sido registrado exitosamente." ));
						}
					}
				}
				$conn == null;
			}
		} catch (Exception $e) {
			$this->abort($cliente->getId());
			echo json_encode(array("type" => "error" , "message" => "Error: Sucedió algo inesperado comunicate con el encargado sobre este problema." ));
 			//Si hubo un problema con la base de datos, favor de descomentar la siguiente linea
			//print_r($e);
		}
		return false;

	}

	//Obtener el ID del usuario por Email o Username
	function getId($data){
		try {
			$db = new db();
			$conn = $db->conn_local_clubestrella();
			$query = "SELECT * FROM users WHERE Username = :data OR Email = :data ;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":data",$data);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{	
				$rows = $stmt->fetch(PDO::FETCH_ASSOC);
				$conn == null;
				return $rows["Id"];
			}
			else
			{
				echo "No se encontró usuario";
			}
			$conn == null;

		} catch (Exception $e) {
			print_r($e);
		}
		return false;
	}


	//Comprobar si existe un cliente

	function exist($data){
		try {
			$db = new db();		
			$conn = $db->connection2();
			$query = "SELECT * FROM users WHERE Username = :data OR Email = :data ;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$data);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{	
				return true;
			}

		} catch (Exception $e) {
			echo "Hubo un problema en la conexión a la base de datos.";
		}
		return false;
	}

	//Encontrar el cliente por ID
	function find($id){
		try {
			$db = new db();		
			$conn = $db->connection2();
			$query = "SELECT * FROM clientes WHERE Id = ? ;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{	
				$cliente = new cliente();
				$rows = $stmt->fetch(PDO::FETCH_ASSOC);
				$cliente->setNumeroSocio($rows['NumeroSocio']);
				$cliente->setPuntos($rows['Puntos']);
				$cliente->setEmpresa($rows['Empresa']);
				$cliente->setTelefono($rows['Telefono']);
				$cliente->setPais($rows['Pais']);
				$cliente->setCiudad($rows['Ciudad']);
				$cliente->setEstado($rows['Estado']);
				$cliente->setCodigoPostal($rows['CodigoPostal']);
				$cliente->setDireccion($rows['Direccion']);

				$query = "SELECT * FROM personas WHERE Id = ? ;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$id);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0)
				{	
					$rows = $stmt->fetch(PDO::FETCH_ASSOC);
					$cliente->setNombre($rows['Nombre']);
					$cliente->setApellidoPaterno($rows['Apellido_paterno']);
					$cliente->setApellidoMaterno($rows['Apellido_materno']);

					$query = "SELECT * FROM users WHERE Id = ? ;";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1,$id);
					$stmt->execute();
					$count = $stmt->rowCount();

					if($count > 0)
					{
						$rows = $stmt->fetch(PDO::FETCH_ASSOC);
						$cliente->setId($rows['Id']);
						$cliente->setUsername($rows['Username']);
						$cliente->setEmail($rows['Email']);
						$conn == null;
						return $cliente;
					}
					else
					{
						echo "No se encontró usuario";

					}
				}
				else
				{
					echo "No se encontró persona";

				}
			}
			else
			{
				echo "No se encontró cliente";

			}
			$conn == null;

		} catch (Exception $e) {
			print_r($e);
		}
		return false;
	}

	//Encontrar el usuario por cualquier dato que no sea el ID
	function getCliente($data){
		try {
			$db = new db();
			$conn = $db->connection2();
			$query = "SELECT * FROM users WHERE Username = :data OR Email = :data ;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":data",$data);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{	
				$cliente = new cliente();
				$rows = $stmt->fetch(PDO::FETCH_ASSOC);
				$cliente->setId($rows['Id']);
				$cliente->setUsername($rows['Username']);
				$cliente->setEmail($rows['Email']);

				$query = "SELECT * FROM personas WHERE id = ? ;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$cliente->getId());
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0)
				{
					$rows = $stmt->fetch(PDO::FETCH_ASSOC);
					$cliente->setNombre($rows['Nombre']);
					$cliente->setApellidoPaterno($rows['Apellido_paterno']);
					$cliente->setApellidoMaterno($rows['Apellido_materno']);

					$query = "SELECT * FROM clientes WHERE id = ? ;";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1,$cliente->getId());
					$stmt->execute();
					$count = $stmt->rowCount();
					if($count > 0)
					{
						$rows = $stmt->fetch(PDO::FETCH_ASSOC);
						$cliente->setNumeroSocio($rows['NumeroSocio']);
						$cliente->setPuntos($rows['Puntos']);
						$cliente->setEmpresa($rows['Empresa']);
						$cliente->setTelefono($rows['Telefono']);
						$cliente->setPais($rows['Pais']);
						$cliente->setCiudad($rows['Ciudad']);
						$cliente->setEstado($rows['Estado']);
						$cliente->setCodigoPostal($rows['CodigoPostal']);
						$cliente->setDireccion($rows['Direccion']);
						$conn == null;
						return $cliente;
					}
					else
					{
						echo "No se encontró cliente";
					}
				}
				else
				{
					echo "No se encontró persona";
				}
			}
			else
			{
				echo "No se encontró usuario";
			}
			$conn == null;
		} catch (Exception $e) {
			print_r($e);
		}
		return false;
	}

	function rol_user($user_id, $rol_id){
		try {
			
			$db = new db();		
			$conn = $db->connection2();
			$query = "INSERT INTO rol_user(User_id, Rol_id) VALUES (?,?)";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$user_id);
			$stmt->bindParam(2,$rol_id);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{
				$conn == null;
				return true;
			}
		} catch (Exception $e) {
			print_r($e);
		}
		return false;

	}

	function fecha($id){

		try {
			
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT fecha from clientes where Id= ?";
			$stmt =$conn->prepare($query);
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$count = $stmt->rowcount();
			if ($count > 0) {

				$row = $stmt->fetch(PDO:: FETCH_ASSOC);
				$datetime = $row['fecha'];
				$conn = null;
				$date = date("d/m/Y",strtotime($datetime));
				return $date;
			}

		} catch (Exception $e) {

			echo "Error al convertir la fecha";
			print_r($e);

		}
		return false;
	}

	function puntos($id){
		try {
			
			$db = new db();
			$conn = $db->connection2();
			$query = "SELECT Puntos from clientes where Id= ?";
			$stmt =$conn->prepare($query);
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$count = $stmt->rowcount();
			if ($count > 0) {
				$row = $stmt->fetch(PDO:: FETCH_ASSOC);
				$Puntos = $row['Puntos'];
				return $Puntos;
			}

		} catch (Exception $e) {

			echo "Error al obtener los puntos";
			print_r($e);

		}
		return false;
	}


	function abort($id){
		try {
			
			$db = new db();		
			$conn = $db->connection2();
			$query = "DELETE FROM users WHERE Id = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{
				$conn == null;
				return true;
			}
		} catch (Exception $e) {
			print_r($e);
		}
		return false;
	}


	/*  VIEJA BASE DE DATOS */
	
	function old_fecha($fecha){

		try {
			
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT fecha from adhara_clientes where idc= ?";
			$stmt =$conn->prepare($query);
			$stmt->bindParam(1,$fecha);
			$stmt->execute();
			$count = $stmt->rowcount();
			if ($count > 0) {

				$row = $stmt->fetch(PDO:: FETCH_ASSOC);
				$datetime = $row['fecha'];
				$conn = null;
				$date = date("d/m/Y",strtotime($datetime));
				return $date;
			}

		} catch (Exception $e) {

			echo "Error al convertir la fecha";
			print_r($e);

		}
		return false;
	}



}

?>