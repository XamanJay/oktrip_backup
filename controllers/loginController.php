<?php 
require(realpath($_SERVER['DOCUMENT_ROOT'])."/models/db.php");
require(realpath($_SERVER['DOCUMENT_ROOT'])."/models/User/cliente.php");
//echo realpath($_SERVER['DOCUMENT_ROOT']."/");


if ($_POST) {
	if (isset($_POST['correo']) && isset($_POST['security']) ) 
	{
		session_start();
		try {

			$db = new db();
			$conn = $db->conn_local_clubestrella();
			$query = "SELECT * FROM users where Username = :username OR  Email = :username AND Password = AES_ENCRYPT(:password,'test')  AND IsDeleted = 0;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(":username",$_POST['correo']);
			$stmt->bindParam(":password",$_POST['security']);
			$stmt->execute();
			$count = $stmt->rowcount();
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
						$cliente->setFecha($rows['Fecha']);
						$cliente->setCodigoPostal($rows['CodigoPostal']);
						$cliente->setDireccion($rows['Direccion']);
						$_SESSION["cliente"] = $cliente;
						$conn == null;
						echo "1";
					}
				}
			}
			else{
				unset($_SESSION["cliente"]);
				echo "2";;
			}
			$conn == null;
			return 0;

		} catch (Exception $e) {
			unset($_SESSION["cliente"]);
			echo "Surgió un problema...";
			print_r($e);
		}
	}
}
else{
	echo "ERROR 404: NOT FOUND";
}

?>
