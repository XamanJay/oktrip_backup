<?php

/**
* 
*/

class HotelsCityController
{
	
	function __construct(){}

	public function anyIndex(){
		session_start();
		if(isset($_SESSION["user"])){
			include("views/HotelCity/index.php");
		}
		else
		{
			header( "Location: /panel/login");
		}
	}

	public function getUpdate(){
		if(isset($_GET)){
			try {

				ini_set('max_execution_time', 300);
				ini_set('default_socket_timeout', 120);
				$db = new db();
				$soapController = new soapController();
				
				$conn = $db->conn_local();
				$query= "SELECT Id, IdCity FROM cities;";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();

				if($count > 0)
				{
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$contador = 0;
					foreach ($rows as $row) 
					{
						$results = $soapController->getHotelsCities($row["IdCity"]);

						if(!isset($results->Error))
						{
							$HotelsCity = array();

							//No siempre arroja un Arreglo como resultado, por eso es esta comprobación
							if(!is_array($results->Hotel))
								{ array_push($HotelsCity, $results->Hotel); }
							else
								{ $HotelsCity = $results->Hotel; }
								
							foreach ($HotelsCity as $hotel) {

								//Se comprueba que el ID no se repita en la Base de datos
								$query= "SELECT (Id) FROM hotels_city WHERE IdHotel = ?;";
								$stmt = $conn->prepare($query);
								$stmt->bindParam(1,$hotel->Id);
								$stmt->execute();
								$count = $stmt->rowCount();
								if($count <= 0)
								{
									$HotelCity = new HotelCity();
									$HotelCity->setIdHotel($hotel->Id);
									$HotelCity->setName($hotel->Name);
									$HotelCity->setZoneName($hotel->DestinationName);
									$HotelCity->setCategory($hotel->Category);
									$HotelCity->setAddress($hotel->Address);
									$HotelCity->setCity($row);

									if($this->createHotelCity($HotelCity, $conn))
									{
										$contador++;
									}
								}
							}
						}
					}
				}
				echo json_encode(
					array(
						"type" => "success" , 
						"title" => "Alta exitosa",  
						"message" => "Se realizaron ".$contador." registros nuevos con exito."
					)
				);
			} 
			catch (Exception $e) {

				echo json_encode(
					array(
						"type" => "error" , 
						"title" => "Ocurrió un problema",  
						"message" => "Hubo un problema, favor de comunicarse con Dpto. de Desarrollo. <br>".$e
					)
				);
				
			}
		}
		return false;
	}

	public function createHotelCity($HotelCity, $conn){

		$query = "INSERT INTO hotels_city (IdHotel, City_id, Name, ZoneName, Category, Address, LastUpdate) VALUES (?,?,?,?,?,?,?);";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1,$HotelCity->getIdHotel());
		$stmt->bindParam(2,$HotelCity->getCity()["Id"]);
		$stmt->bindParam(3,$HotelCity->getName());
		$stmt->bindParam(4,$HotelCity->getZoneName());
		$stmt->bindParam(5,$HotelCity->getCategory());
		$stmt->bindParam(6,$HotelCity->getAddress());
		$stmt->bindParam(7,date("Y-m-d H:i:s"));
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0)
		{
			$conn == null;
			return true;
		}

		$conn == null;
		return false;
	}

	public function postEliminar($id){
		try 
		{
			$db = new db();
			$conn = $db->conn_local();

			$query = "UPDATE hotels_city SET isDeleted = 1 WHERE Id = ? ;";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$id);
			$stmt->execute();

			$count = $stmt->rowcount();
			if($count > 0)
			{	
				echo json_encode(
					array(
						"type" => "success" , 
						"title" => "Eliminado",  
						"message" => "Se ha eliminado el registro con id: ".$id
					)
				);
			}
			else
			{
				echo json_encode(
					array(
						"type" => "error" , 
						"title" => "Hubo un error",  
						"message" => "No se pudo eliminar el registro. "
					)
				);
			}
			$conn = null;
		} 
		catch (Exception $e) 
		{
			echo json_encode(
				array(
					"type" => "error" , 
					"title" => "Hubo un error",  
					"message" => "No se pudo eliminar el registro. ".$e
				)
			);
		}
		return false;
	}



}


?>