<?php

class adminPanelController
{
	
	function __construct(){}


	public function anyIndex(){
		session_start();
		/*if(isset($_SESSION["user"])){
		}
		else
		{
			header( "Location: /login");
		}*/
			include("views/Panel/index.php");
			
	}
	
	
	
	public function getLogon(){
		session_start();

		if(!isset($_SESSION["user"])){
			$token = hash("sha512",rand(-999,time()).":1kD^KuXg8m<maEAua<0~8[<~Zo;MhHk".rand(-999,time())); 
			unset($_SESSION["token"]);
			$_SESSION['token'] = $token;
			include("views/Panel/logon.php");
		}
		else
		{
			header( "Location: /panel");
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function getLogin(){
		session_start();

		if(!isset($_SESSION["user"])){
			$token = hash("sha512",rand(-999,time()).":1kD^KuXg8m<maEAua<0~8[<~Zo;MhHk".rand(-999,time())); // me mamé lo sé :v
			unset($_SESSION["token"]);
			$_SESSION['token'] = $token;
			include("views/Panel/login.php");
		}
		else
		{
			header( "Location: /panel");
		}
	}

	public function postLogin(){
		if(isset($_POST)){
			session_start();
			if(strcmp($_SESSION['token'], $_POST['gp_tk']) == 0){

				if(isset($_POST['username']) && isset($_POST['password'])){
					try {

						if(!file_exists("log.txt")){
							$file = fopen("log.txt", "w");
							fwrite($file, "---- Inicio de log ----" . PHP_EOL);
							fclose($file);
						}

						$db = new db();
						$conn = $db->conn_local();
						$query = "SELECT * FROM admins where Username = :username OR  Email = :username AND Password = AES_ENCRYPT(:password,'oktrip2017')";
						$stmt = $conn->prepare($query);
						$stmt->bindParam(":username",$_POST['username']);
						$stmt->bindParam(":password",$_POST['password']);
						$stmt->execute();
						$count = $stmt->rowcount();
						if($count > 0)
						{	

							$persona = new persona();
							$rows = $stmt->fetch(PDO::FETCH_ASSOC);
							$persona->setId($rows['Id']);
							$persona->setUsername($rows['Username']);
							$persona->setEmail($rows['Email']);
							$persona->setNombre($rows['Nombre']);

							$_SESSION["user"] = $persona;

							$conn == null;
							echo json_encode(array("type" => "success" , "message" => "" ));
							return false;
						}
						else{
							echo json_encode(array("type" => "error" , "message" => "La cuenta de usuario/correo electrónico o la contraseña son incorrectas." ));
						}

						/*$conn = $db->conn_local_clubestrella();
						$query = "SELECT * FROM users where Username = :username OR  Email = :username AND Password = AES_ENCRYPT(:password,'test') AND IsDeleted = 0;";
						$stmt = $conn->prepare($query);
						$stmt->bindParam(":username",$_POST['username']);
						$stmt->bindParam(":password",$_POST['password']);
						$stmt->execute();
						$count = $stmt->rowcount();
						if($count > 0)
						{	

							$persona = new persona();
							$rows = $stmt->fetch(PDO::FETCH_ASSOC);
							$persona->setId($rows['Id']);
							$persona->setUsername($rows['Username']);
							$persona->setEmail($rows['Email']);

							$query = "SELECT Id FROM rol_user WHERE User_id = ? AND Rol_id = '1' AND Plataforma_id = '3';";
							$stmt = $conn->prepare($query);
							$stmt->bindParam(1,$persona->getId());
							$stmt->execute();
							$count = $stmt->rowCount();
							if($count > 0)
							{

								$query = "SELECT * FROM personas WHERE id = ? ;";
								$stmt = $conn->prepare($query);
								$stmt->bindParam(1,$persona->getId());
								$stmt->execute();
								$count = $stmt->rowCount();
								if($count > 0)
								{
									$rows = $stmt->fetch(PDO::FETCH_ASSOC);
									$persona->setNombre($rows['Nombre']);
									$persona->setApellidoPaterno($rows['Apellido_paterno']);
									$persona->setApellidoMaterno($rows['Apellido_materno']);
									$_SESSION["user"] = $persona;

									$conn == null;
									echo json_encode(array("type" => "success" , "message" => "" ));
									return false;

								}
							}
							else
							{
								$file = fopen("log.txt", "a");
								fwrite($file, $persona->getUsername()."[".$persona->getId()."] intentó iniciar sesión a la plataforma 3 - Fecha: ".date("Y-m-d H:i:s", time()). PHP_EOL);
								fclose($file);
								echo json_encode(array("type" => "error" , "message" => "Esta cuenta no cuenta con los permisos para acceder a esta sección." ));
							}			

						}
						else{
							echo json_encode(array("type" => "error" , "message" => "La cuenta de usuario/correo electrónico o la contraseña son incorrectas." ));
						}*/
					} 
					catch (Exception $e) {
						$file = fopen("log.txt", "a");
						fwrite($file, "HomeController: ".$e." - Fecha: ".date("Y-m-d H:i:s", time()). PHP_EOL);
						fclose($file);
						echo json_encode(array("type" => "error" , "message" => "Ocurrió un problema al intentar iniciar sesión, favor de comunicarse con el programador encargado." ));
					}
				}
			}
			else{
				echo json_encode(array("type" => "error" , "message" => "Ocurrió un problema al intentar iniciar sesión, favor de comunicarse con el programador encargado." ));
			}
			return false;

		}
	}

	public function postLogoff(){
		session_start();
		unset($_SESSION["user"]);
		unset($_SESSION["token"]);
		session_destroy();
		header( "Location: /panel/login");
	}

	
}

?>