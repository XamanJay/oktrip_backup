<?php

/**
* 
*/

class CitiesController
{
	
	function __construct(){}

	public function anyIndex(){
		session_start();
		if(isset($_SESSION["user"])){
			include("views/Cities/index.php");
		}
		else
		{
			header( "Location: /login");
		}
	}

	public function postUpdate(){
		if(isset($_POST)){
			try {
				$soapController = new soapController();
				$arrayCities = $soapController->getDestinations();
				$db = new db();
				$conn = $db->conn_local();
				$contador = 0;
				foreach ($arrayCities as $aux) {

					//Se comprueba que el ID no se repita en la Base de datos
					$query= "SELECT (Id) FROM cities WHERE IdCity = ?;";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1,$aux->Id);
					$stmt->execute();
					$count = $stmt->rowCount();
					if($count <= 0)
					{

						$city = new City();
						$city->setIdCity($aux->Id);
						$city->setName($aux->Name);
						$city->setIdCountry($aux->IdCountry);
						$city->setCountry($aux->Country);
						$city->setPath($aux->Path);

						//API KEY JUANPITOMSON: AIzaSyBFWlA8W2jx51jbdNGby-6DcjSBZOdrQdQ
						//API KEY KIKE MASTER : AIzaSyCuPcjJM0GlcPgfN-woHfY2FnU_vRq8av4
						$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($city->getName()." ".$city->getCountry())."&key=AIzaSyBFWlA8W2jx51jbdNGby-6DcjSBZOdrQdQ";
						$json = $this->getJsonGeocode($url);
						
						/*while (strcmp($json['status'], "OVER_QUERY_LIMIT") == 0) 
						{
							echo "Durmiendo 2 segundos: ".$city->getName();
							sleep(2);
							$json = $this->getJsonGeocode($url);
						}*/

						if(strcmp($json['status'], "ZERO_RESULTS") == 0)
						{
							$city->setLongitude(0);
							$city->setLatitude(0);
						}
						else
						{
							$lat = $json['results'][0]['geometry']['location']['lat'];
							$lng = $json['results'][0]['geometry']['location']['lng'];

							$city->setLongitude($lng);
							$city->setLatitude($lat);
						}

						if($this->createCity($city, $conn))
						{
							$contador++;
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

	public function createCity($city, $conn){


		$query = "INSERT INTO cities (IdCity, Name, IdCountry, Country, Path, Latitude, Longitude, LastUpdate) VALUES (?,?,?,?,?,?,?,?);";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1,$city->getIdCity());
		$stmt->bindParam(2,$city->getName());
		$stmt->bindParam(3,$city->getIdCountry());
		$stmt->bindParam(4,$city->getCountry());
		$stmt->bindParam(5,$city->getPath());
		$stmt->bindParam(6,$city->getLatitude());
		$stmt->bindParam(7,$city->getLongitude());
		$stmt->bindParam(8,date("Y-m-d H:i:s"));
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

	public function getJsonGeocode($url){

		$arrContextOptions=array(
		    "ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
		    ),
		);  

		$response = file_get_contents($url, false, stream_context_create($arrContextOptions));
		//$response = file_get_contents($url);
		return json_decode($response,true);
	}

	public function getLocations(){

		try {
			$db = new db();
			$conn = $db->conn_local();
			$query = "SELECT IdCity, Name, Country, Longitude, Latitude FROM cities WHERE isDeleted = 0 ORDER BY IdCity ASC ";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0){

				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$lista = array();
				foreach ($rows as $row) {

					$mapa = new mapa();
					$mapa->setId($row['IdCity']);
					$mapa->setNombre($row['Name']);
					$mapa->setPais($row['Country']);
					$mapa->setLatitud($row['Latitude']);
					$mapa->setLongitud($row['Longitude']);

					array_push($lista, $mapa);

				}
				
				return $lista;
			}
		} catch (Exception $e) {
			echo "Error al obtener coordenadas de las ciudades <br>";
			print_r($e);
		}
	}

	public function postEliminar($id){
		try 
		{
			$db = new db();
			$conn = $db->conn_local();

			$query = "UPDATE cities SET isDeleted = 1 WHERE Id = ? ;";

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