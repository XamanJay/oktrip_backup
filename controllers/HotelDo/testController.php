<?php 

class testController extends soapClient{

	public $soapClient;
	function __construct($path = "https://oktrip.mx/doc/AffiliateService.wsdl",$options=array()){

		try {
			parent::__construct($path,$options);
		    $this->soapClient = new SoapClient($path,$options);
		    //var_dump($this->soapClient->__getFunctions());
		    //echo "<br>";
		} catch (SoapFault $fault) {
		    trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		    
		    if(!file_exists("error_api_hotelDo.txt")){
				$file = fopen("error_api_hotelDo.txt", "w");
				fwrite($file, "---- Inicio de log errores ---- \n\n" . PHP_EOL);
				fclose($file);
			}

			$filename = fopen("error_api_hotelDo.txt", "a");
			fwrite($filename, "Error del dia ".date("Y-m-d H:i:s")."\n\n".$fault . PHP_EOL);
			fclose($file);
		}
	}

	/*function __doRequest($request, $location, $action, $version, $one_way = 0) {
	    ob_start();
	    $this->soapClient->handle($request);
	    $response = ob_get_contents();
	    ob_end_clean();
	    return $response;
	}*/

	public function getHotels($parameters){
		$ObjectInfo = $this->soapClient->GetQuoteHotels($parameters);
		echo "<br><br><br>";
		echo "-----------------Seccion donde se depliegan los hoteles------------------------";
		echo "<br><br><br>";
		$listaHoteles = array();
		foreach ($ObjectInfo->GetQuoteHotelsResult->Hotels->Hotel as $hotel) {

			
			/*print_r($hotel);
			echo "<br><br>";
			echo "<br><br>";*/
			$checkRoom = is_array($hotel->Rooms->Room);
			$room = ($checkRoom) ? $hotel->Rooms->Room[0] : $hotel->Rooms->Room;
			$checkRoom = is_array($room->MealPlans->MealPlan);
			$path_room = ($checkRoom) ? $room->MealPlans->MealPlan[0] : $room->MealPlans->MealPlan;

			$reviews = (!empty($hotel->Reviews)) ? $hotel->Reviews : "Vacio";
			$reviews = (!empty($reviews->Review)) ? $reviews->Review : "Vacio";
			//echo "<br>";
			//print_r($reviews);
			//echo "<br>";
			$hotelSingle = array(
				"Id" => $hotel->Id, 
				"Nombre: " => $hotel->Name,
				"CityName:" => $hotel->CityName,
				"Hotel Categoria:" => $hotel->CategoryId,
				"Image:" => $hotel->Image,
				"Latitud:" => $hotel->Latitude,
				"Longitud:" => $hotel->Longitude,
				"Price_Agency:" => $path_room->AgencyPublic->AgencyPublic,
				"Price_Normal:" => $path_room->Normal,
				"Reviews:" => $reviews,
				"Cancelacion:" => $path_room->RateDetails->RateDetail->CancellationPolicy->Description
			);
			//print_r($hotelSingle);
			//echo "<br><br>";
			//echo "<br><br>";

			array_push($listaHoteles, $hotelSingle);
		}
		return $listaHoteles;
	}

	public function getDestinations($a = 'OKTRA', $l = 'esp', $ic = '' ){

		$ObjectInfo = $this->soapClient->GetDestinations(array("a" => $a, "l" => $l, "ic" => $ic));
		//return $ObjectInfo->GetDestinationsResult->Destination;
		$listaDestinos = array();
		//echo "<br><br><br>";
		//echo "-----------------Seccion donde se depliegan los destinos------------------------";
		//echo "<br><br><br>";
		//print_r($ObjectInfo->GetDestinationsResult->Destination);
		foreach ($ObjectInfo->GetDestinationsResult->Destination as $destino) {
			//echo "Id: ".$destino->Id." Name: ".$destino->Name." IdCountry: ".$destino->IdCountry." Country: ".$destino->Country." Path: ".$destino->Path;
			//print_r($destino);
			//echo "<br>";
			array_push($listaDestinos, $destino);
		}
		return $listaDestinos;
	}


	public function getIdS5($id_city){
		try {
			$newyork =[10143951,10109376,10135539,4413];  
			$cancun =[23,3349,2352,947];  
			if($id_city == 15580){
				/*$db = new db();
				$conn = $db->conn_local();
				$query ="SELECT IdHotel FROM hotels_city WHERE City_id = ? AND Category = 'S5' LIMIT 4;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$id_city);
				$stmt->execute();
				$count = $stmt->rowCount();
				if($count > 0){
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$lista_hotel = array();
					foreach ($rows as $row) {
						array_push($lista_hotel, $row['IdHotel']);
					}
					//print_r($lista_hotel);
				}*/
				return $cancun;
			}
			else
				return $newyork;
		} catch (Exception $e) {
			print_r($e);
		}
	}

	public function getParameters($id_,$lengua,$coin,$idCity =""){

		$to = new DateTime();
		$to->add(new DateInterval('P1D'));
		$from = new DateTime();
		$from->add(new DateInterval('P2D'));
		$ip = "187.191.10.59";
		$currency = $coin; //para dolares: us
		//$idCity = "";
		$lang = $lengua; // para ingles: ing
		$idHotel = $id_;
		$idRoom ="";
		$parameters = array(
			"a" => "OKTRA",
			"ip" => $ip,          
			"c" => $currency,
			"sd" => $to->format("Ymd"),
			"ed" => $from->format("Ymd"),
			"h" => $idHotel,
			"rt" =>$idRoom,
			"mp" =>"",

			"r" => 1,
			"r1a" => 1,
			"r1k" => 0,
			"r1k1a" => 0,
			"r1k2a" => 0,
			"r1k3a" => 0,

			"r2a" => 0,
			"r2k" => 0,
			"r2k1a" => 0,
			"r2k2a" => 0,
			"r2k3a" => 0,

			"r3a" => 0,
			"r3k" => 0,
			"r3k1a" => 0,
			"r3k2a" => 0,
			"r3k3a" => 0,

			"r4a" => 0,
			"r4k" => 0,
			"r4k1a" => 0,
			"r4k2a" => 0,
			"r4k3a" => 0,

			"r5a" => 0,
			"r5k" => 0,
			"r5k1a" => 0,
			"r5k2a" => 0,
			"r5k3a" => 0,
			"d" => $idCity,
			"l" => $lang,
			"hash" => "hd:true;hr:true"
			//"hash" => "ha:false;"
		);
	
		return $parameters;

	}

	public function HotelDestiny($parameters){

		$ObjectInfo = $this->soapClient->GetQuoteHotels($parameters);
//jvi		print_r ($ObjectInfo);
		/*echo "<br><br><br>";
		echo "-----------------Seccion donde se depliegan los hoteles de cierto destino------------------------";
		echo "<br><br><br>";*/
		$listaHoteles = array();
		//print_r($ObjectInfo->GetQuoteHotelsResult);

		foreach ($ObjectInfo->GetQuoteHotelsResult->Hotels as $hotel) {

			
			/*print_r($hotel);
			echo "<br><br>";
			echo "<br><br>";*/
			//echo $hotel->Id;
			$checkRoom = is_array($hotel->Rooms->Room);
			$room = ($checkRoom) ? $hotel->Rooms->Room[0] : $hotel->Rooms->Room;
			$checkRoom = is_array($room->MealPlans->MealPlan);
			$path_room = ($checkRoom) ? $room->MealPlans->MealPlan[0] : $room->MealPlans->MealPlan;

			$reviews = (!empty($hotel->Reviews)) ? $hotel->Reviews : "Vacio";
			$reviews = (!empty($reviews->Review)) ? $reviews->Review : "Vacio";
			//echo "<br>";
			//print_r($reviews);
			//echo "<br>";
			$hotelSingle = array(
				"Id" => $hotel->Id, 
				"Nombre" => $hotel->Name,
				"CityName" => $hotel->CityName,
				"Hotel Categoria" => $hotel->CategoryId,
				"Image" => $hotel->Image,
				"Latitud" => $hotel->Latitude,
				"Longitud" => $hotel->Longitude,
				"Price_Agency" => $path_room->AgencyPublic->AgencyPublic,
				"Price_Normal" => $path_room->Normal,
				"Reviews" => $reviews,
				"Category" => $hotel->CategoryId,
				"Cancelacion" => $path_room->RateDetails->RateDetail->CancellationPolicy->Description
			);
			/*print_r($hotelSingle);
			echo "<br><br>";
			echo "<br><br>";*/
			return  $hotelSingle;
			//array_push($listaHoteles, $hotelSingle);
		}
		//return $listaHoteles;

	}

	public function CustomH($id_Destino,$lang,$currency){
		$testSoap = new testController();
		$idhotels = $testSoap->getIdS5($id_Destino);
		$lista_hoteles = array();
		$lista_parametro = array();
		foreach ($idhotels as $id_) {
			$parametro = $testSoap->getParameters($id_,$lang,$currency);
			array_push($lista_parametro, $parametro);
			$hotel = $testSoap->HotelDestiny($parametro);
			array_push($lista_hoteles, $hotel);
		}
		return $lista_hoteles;
	}


}


?>