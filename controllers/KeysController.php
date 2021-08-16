

<?php

/**
* 
*/
class KeysController
{
	
	function __construct(){}

	public function anyIndex(){

		session_start();
		if(isset($_SESSION["user"])){
			include("views/keys/index.php");
		}
		else
		{
			header( "Location: /login");
		}
	}

	public function postCrear(){
		if($_POST)
		{
			try {

				$id_key = $this->setOktripKey();
				$name = $_POST["name"];
				$dependence = $_POST["dependence"];
				$password = $_POST["password"];

				$db = new db();		
				$conn = $db->conn_local();
				$query = "INSERT INTO keys_ (Id_Key, Name, Dependence, Password) VALUES (?,?,?, AES_ENCRYPT(?,'oktrip2017'))";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$id_key);
				$stmt->bindParam(2,$name);
				$stmt->bindParam(3,$dependence);
				$stmt->bindParam(4,$password);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0)
				{
					$conn == null;
					echo json_encode(
						array(
							"type" => "success" , 
							"title" => "Alta exitosa",  
							"message" => "El registro se ha guardado correctamente."
						)
					);
				}
			} 
			catch (Exception $e)
			{
				echo json_encode(
					array(
						"type" => "error" , 
						"title" => "Ocurrió un problema",  
						"message" => "Hubo un problema, favor de comunicarse con Dpto. de Desarrollo. <br>".$e
					)
				);
			}
			return false;
		}
	}

	public function setOktripKey(){
		$db = new db();     
		$conn = $db->connection();
		$sql = "SELECT Id_Key FROM keys_ ORDER BY Id DESC LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0)
		{
			$rows = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!empty($rows['Id_Key']))
			{
				$aux = explode("OktripKey_",$rows['Id_Key']);
				$nextId =  intval($aux[1]) + 1;
				$conn == null;
				return "OktripKey_".$nextId;
			}
		}
		return "OktripKey_1";
	}

}



?>