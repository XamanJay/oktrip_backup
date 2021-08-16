<?php

/**
* 
*/

class HomeController
{
	
	function __construct(){}

	public function getIndex($lang = 'es'){

		$lang = new Language($lang);
		$to = new DateTime();
		$to->add(new DateInterval('P2D'));
		$dateTo = $to->format("d/m/Y");
		$from = new DateTime();
		$from->add(new DateInterval('P1D'));
		$datefrom = $from->format("d/m/Y");

		$testSoap = new testController();
		$cancun = 15580;
		$lista_cancun = $testSoap->CustomH($cancun,$GLOBALS['Lang_HotelDo'],$GLOBALS['Currency_HotelDo']);

		$orlando = 15337;
		$lista_orlando = $testSoap->CustomH($orlando,$GLOBALS['Lang_HotelDo'],$GLOBALS['Currency_HotelDo']);

		include("views/Home/index.php");
	}
	public function getHome($lang = 'es'){
		
		$lang = new Language($lang);
		$to = new DateTime();
		$to->add(new DateInterval('P2D'));
		$dateTo = $to->format("d/m/Y");
		$from = new DateTime();
		$from->add(new DateInterval('P1D'));
		$datefrom = $from->format("d/m/Y");

		$testSoap = new testController();
		$cancun = 15580;
		$lista_cancun = $testSoap->CustomH($cancun,$GLOBALS['Lang_HotelDo'],$GLOBALS['Currency_HotelDo']);

		$orlando = 15337;
		$lista_orlando = $testSoap->CustomH($orlando,$GLOBALS['Lang_HotelDo'],$GLOBALS['Currency_HotelDo']);
		
		include("views/Home/index.php");
	}
	/*public function getPanel($lang = 'es'){
		session_start();
		if(isset($_SESSION["user"])){
			include("views/Panel/index.php");
		}
		else
		{
			header( "Location: /login/es");
		}
	}*/

	public function getContacto($lang = 'es'){
		$lang = new Language($lang);
		
		include("views/Home/contacto.php");
	}

	public function getTours($lang = 'es'){
		include("views/Home/tours.php");
	}

	public function getTraslados($lang = 'es'){
		include("views/Home/traslados.php");
	}

	public function getRenta($lang = 'es'){
		include("views/Home/autos.php");
	}

	public function getGrupos($lang = 'es'){
		include("views/Home/grupos.php");
	}

	public function getOfertas($lang = 'es'){
		include("views/Home/ofertas.php");
	}

	/*public function getLogin($lang = 'es'){
		session_start();

		if(!isset($_SESSION["user"])){
			$token = hash("sha512",rand(-999,time()).":1kD^KuXg8m<maEAua<0~8[<~Zo;MhHk".rand(-999,time())); // me mamé lo sé :v
			unset($_SESSION["token"]);
			$_SESSION['token'] = $token;
			include("views/Panel/login.php");
		}
		else
		{
			header( "Location: /panel/es");
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

							$_SESSION["user"] = $persona;

							$conn == null;
							echo json_encode(array("type" => "success" , "message" => "" ));
							return false;
						}
						else{
							echo json_encode(array("type" => "error" , "message" => "La cuenta de usuario/correo electrónico o la contraseña son incorrectas." ));
						}
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
		header( "Location: /login/es");
	}

	public function postLogoffclient(){
		session_start();
		unset($_SESSION["cliente"]);
		session_destroy();
		header( "Location: /home/es");
	}*/

	public function postDestiny(){

		$value = (!empty($_POST['value'])) ? "%".$_POST['value']."%" : '';
		$arrayDestinies = array();

		$db = new db();
		$conn = $db->conn_local();
		$query = "SELECT IdCity,Name,Country FROM cities WHERE Name LIKE '%".$value."%' ORDER BY IdCity ASC LIMIT 5;";

		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowCount();

		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {

				$destiny = array(
					"IdCity" => $row["IdCity"],
					"IdHotel" => "",
					"Name" => $row["Name"],
					"Country" => $row["Country"],
					"ZoneName" => "",
					"Category" => (strcmp($_COOKIE["Lang"], "es") ==0 )? "Ciudad" : "City"
				);

				array_push($arrayDestinies, $destiny);
			}
			
		}
		$query = "SELECT cities.IdCity, cities.Country, hotels_city.IdHotel, hotels_city.Name, hotels_city.ZoneName
		FROM hotels_city 
		INNER JOIN cities 
		ON hotels_city.City_id = cities.Id 
		WHERE hotels_city.Name 
		LIKE :value
		ORDER BY cities.IdCity ASC 
		LIMIT 5;";

		$stmt = $conn->prepare($query);
		$stmt->bindParam(":value",$value);
		$stmt->execute();
		$count = $stmt->rowCount();	

		if($count > 0){
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($rows as $row) {

				$destiny = array(
					"IdCity" => $row["IdCity"],
					"IdHotel" => $row["IdHotel"],
					"Name" => $row["Name"],
					"Country" => $row["Country"],
					"ZoneName" => $row["ZoneName"],
					"Category" => "Hotel"
				);

				array_push($arrayDestinies, $destiny);
			}
		}
		echo json_encode($arrayDestinies);
		return false;
	}

	public function getEmailtest($lang = 'es'){
		try 
		{
			include_once("class.phpmailer.php");

			$lang = new Language($lang);

			$xml_denied = 
			"<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?>
			<CENTEROFPAYMENTS>
			<reference>OKTRIP170393</reference>
			<response>denied</response>
			<foliocpagos>508096866</foliocpagos>
			<auth/>
			<cd_response>62</cd_response>
			<cd_error/>
			<nb_error/>
			<nb_company/>
			<nb_merchant/>
			<cc_type/>
			<tp_operation/>
			<cc_name/>
			<cc_number>2199</cc_number>
			<cc_expmonth>06</cc_expmonth>
			<cc_expyear>21</cc_expyear>
			<amount/>
			<emv_key_date/>
			<id_url>C8L77EUX</id_url>
			<email>marelvy777@hotmail.com</email>
			<datos_adicionales>
			<data id='1'>
			<label>Nombre</label>
			<value>marelvy hernandez N</value>
			</data>
			</datos_adicionales>
			</CENTEROFPAYMENTS>";

			$xml = 
			"<?xml version='1.0' encoding='ISO-8859-1' standalone='yes'?>
			<CENTEROFPAYMENTS>
			<reference>OKTRIP170391</reference>
			<response>approved</response>
			<foliocpagos>507038218</foliocpagos>
			<auth>270172</auth>
			<cd_response>00</cd_response>
			<cd_error/>
			<nb_error/>
			<time>19:11:52</time>
			<date>19/01/2018</date>
			<nb_company>OK TRAVEL</nb_company>
			<nb_merchant>7566696 OK TRAVEL WEB MXN 2</nb_merchant>
			<cc_type>CREDITO/BANAMEX/MasterCard</cc_type>
			<tp_operation>VENTA</tp_operation>
			<cc_name/>
			<cc_number>7236</cc_number>
			<cc_expmonth>01</cc_expmonth>
			<cc_expyear>19</cc_expyear>
			<amount>1596.00</amount>
			<emv_key_date/>
			<id_url>OP0S2RQE</id_url>
			<email>kikecastro6d@gmail.com</email>
			<datos_adicionales>
			<data id='1'>
			<label>Nombre</label>
			<value>Jaime  Garcia  N</value>
			</data>
			</datos_adicionales>
			</CENTEROFPAYMENTS>";

			$response = new SimpleXMLElement($xml);
			if(strcmp($response->response, "approved") == 0){
				$aux = explode("OKTRIP",$response->reference);
				$id = $aux[1];
				$query = "SELECT Service_id, Payment_id FROM sales WHERE Id = '".$id."';";
				$db = new db();
				$conn = $db->conn_local();
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0)
				{
					$row_ids = $stmt->fetch(PDO::FETCH_ASSOC);
					$payment_id = $row_ids["Payment_id"];
					$service_id = $row_ids["Service_id"];
					$row_ids = null;

					$query = 
					"SELECT services.Id, services.Name, services.DateTo, services.DateFrom, services.Comments, services.NoPeople,
					hotels.City, hotels.Country, hotels.NoRooms, hotels.MealPlan, hotels.CategoryRoom, hotels.Rooms,
					payments.Currency
					FROM services 
					INNER JOIN hotels 
					ON services.Id = hotels.Id
					INNER JOIN payments 
					ON payments.Id = ".$payment_id."
					WHERE services.Id = ".$service_id.";";

					$stmt = $conn->prepare($query);
					$stmt->execute();
					$data = $stmt->fetch(PDO::FETCH_ASSOC);

					$Host = "mail.oktravel.mx";
					$From = "info@oktravel.mx";
					$Username = "info@oktravel.mx";
					$Password = "q4t?)TyGX0y!";
					$Subject  =  "Reservación Oktrip";
					$FromName = "Oktrip";
					$To = $response->email;

					$dateFrom = date("d/m/y", strtotime($data["DateFrom"]));
					$dateTo = date("d/m/y", strtotime($data["DateTo"]));

					$Message = "<!DOCTYPE html>
					<html>
					<head>
					<title>Confirmación de reserva</title>
					<meta charset='UTF-8'>
					<style>
					th,td {
						border: 2px solid #dee2e6;
						color: #666a6d;
					}
					th, td {
						padding: .75rem;
						vertical-align: top;
					}
					table {
						border-collapse: collapse;
					}
					</style>
					</head>
					<body style='font-family: sans-serif;'>
					<div style='width: 481px;'>
						<table>
						<thead>
						<tr>
						<th colspan='2'>
							<img src='https://oktrip.mx/img/logos/oktrip.png' style='width: 150px; text-align: center;'>
							<div style='font-size: 24px;'>Datos de reservación</div>
						</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td>
						<b>Hotel</b>
						</td>
						<td>".$data["Name"]."</td>
						</tr>
						<tr>
						<td>
						<b>No. personas</b>
						</td>
						<td>".$data["NoPeople"]."</td>
						</tr>
						<tr>
						<td>
						<b>Lugar</b>
						</td>
						<td>".$data["City"].", ".$data["Country"]."</td>
						</tr>
						<tr>
						<td>
						<b>Fecha de llegada</b>
						</td>
						<td>".$dateFrom."</td>
						</tr>
						<tr>
						<td>
						<b>Fecha de salida</b>
						</td>
						<td>".$dateTo."</td>
						</tr>
						<tr>
						<td>
						<b>Habitaciones</b>
						</td>
						<td>".$data["NoRooms"]."</td>
						</tr>
						<tr>
						<td>
						<b>Plan de alimentos</b>
						</td>
						<td>".$data["MealPlan"]."</td>
						</tr>
						<tr>
						<td>
						<b>Categoria de cuarto</b>
						</td>
						<td>".$data["CategoryRoom"]."</td>
						</tr>
						<tr>
						<th colspan='2'>
						Datos de pago
						</th>
						</tr>
						<tr>
						<td>
						<b>Referencia</b>
						</td>
						<td>".$response->reference."</td>
						</tr>
						<tr>
						<td>
						<b>Número de autorización</b>
						</td>
						<td>".$response->auth."</td>
						</tr>
						<tr>
						<td>
						<b>Tipo de pago</b>
						</td>
						<td>".$response->cc_type."</td>
						</tr>
						<tr>
						<td>
						<b>Importe</b>
						</td>
						<td>".$response->amount." ".$data["Currency"]."</td>
						</tr>
						</tbody>
					</div>
					</table>
					</body>
					</html>";

					$mail = new PHPMailer();
					$mail->SetLanguage($GLOBALS["lang"]);
					$mail->IsSMTP();
					$mail->Host     = $Host;
					$mail->SMTPAuth = true;
					$mail->Username = $Username;
					$mail->Password = $Password;
					$mail->From     = $From;
					$mail->FromName = $FromName;
					$mail->AddAddress($To);
					$mail->WordWrap = 50; 
					$mail->IsHTML(true);  
					$mail->Subject = $Subject;
					$mail->Body = $Message;
					$mail->CharSet = 'UTF-8';
					$mail->Send();
					print_r($Message);
				}
			}


		} 
		catch (Exception $e)
		{
			print_r($e);
		}
	}
}
?>