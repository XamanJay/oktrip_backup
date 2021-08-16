<?php

class HotelsController
{

	public $to;
	public $from;
	public $city;
	public $rooms;

	public $adults;
	public $kids;
	public $ageKids;

	public $totalKids;
	public $totalAdults;

	public $message;
	public $ip;

	function __construct(){

		$this->ip = "187.191.10.59";
		$this->lang = "es";
	}

	public function anyIndex($lang = 'es'){

		$lang = new Language($lang);
		$to = new DateTime();
		$from = new DateTime();
		//$from->add(new DateInterval('P1D'));
		$city = "all";
		$rooms = "1";
		include("views/Hotels/index.php");
	} 


	public function getSearch($lang = 'es'){

		$lang = new Language($lang);
		if(isset($_GET['to']) && isset($_GET['from']) && isset($_GET['rooms']) && isset($_GET['destiny']) ){

			try{

				$destiny = (!empty($_GET['destiny'])) ? $_GET['destiny'] : "Cancun";
				$this->initDates();
				$this->initGuests();

				if($this->validationDates()){

					$db = new db();

					$conn = $db->conn_local();



					if(!empty($_GET['idHotel']))

					{



						$query = 

						"SELECT hotels_city.IdHotel, cities.IdCity

						FROM hotels_city 

						INNER JOIN cities 

						ON hotels_city.City_id = cities.Id   

						WHERE IdHotel = ".$_GET['idHotel'].";";



						$stmt = $conn->prepare($query);

						$stmt->execute();

						$count = $stmt->rowCount();	

						if($count > 0){

							$rows = $stmt->fetch(PDO::FETCH_ASSOC);



							$idCity = $rows["IdCity"];

							$idHotel = $rows["IdHotel"];



							$_url = "&from=".$this->from->format("d/m/Y")."&to=".$this->to->format("d/m/Y")."&rooms=".$this->rooms;



							for ($i=0; $i < $this->rooms ; $i++) { 



								$_url .= "&adults[".$i."]=".$this->adults[$i];

								$_url .= "&kids[".$i."]=".$this->kids[$i];



								if($this->kids[$i] > 0){

									for ($j=0; $j < 3; $j++) { 

										if(!empty($this->ageKids[$i][$j])){

											$_url .= "&ages[".$i."][".$j."]=".$this->ageKids[$i][$j];

										}

									}

								}

							}



							$host  = $_SERVER['HTTP_HOST'];

							$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

							$url = "hoteles/details/".$GLOBALS['lang']."?idDestiny=".$idCity."&idHotel=".$idHotel.$_url;



							header("Location: http://$host$uri/$url");

						}



					}

					else

					{



						$city = new City();

						$hotel = new HotelCity();

						$soapController = new soapController();



						if (!empty($_GET['idCity'])) 

						{

							$query = "SELECT IdCity,Name,Country,Path FROM cities WHERE IdCity = ".$_GET['idCity'].";";

							$stmt = $conn->prepare($query);

							$stmt->execute();

							$count = $stmt->rowCount();	

							if($count > 0){

								$rows = $stmt->fetch(PDO::FETCH_ASSOC);

								$city->setIdCity($rows["IdCity"]);

								$city->setName($rows["Name"]);

								$city->setCountry($rows["Country"]);

								$city->setPath($rows["Path"]);

							}

						}

						else

						{

							$cityName = explode(",", $destiny);

							$query = "SELECT IdCity,Name,Country,Path FROM cities WHERE Name LIKE '%".trim($cityName[0])."%';";

							$stmt = $conn->prepare($query);

							$stmt->execute();

							$count = $stmt->rowCount();	

							if($count > 0){

								$rows = $stmt->fetch(PDO::FETCH_ASSOC);

								$city->setIdCity($rows["IdCity"]);

								$city->setName($rows["Name"]);

								$city->setCountry($rows["Country"]);

								$city->setPath($rows["Path"]);

							}

							else{

								$message = "No se encontró resultados para '".$cityName[0]."'.";

							}

						}



						$parameters = $this->getParameters("" , $city->getIdCity(), "", $GLOBALS['Lang_HotelDo'] , $GLOBALS['Currency_HotelDo'] );

						$dateLargeFrom = strftime("%d %B %Y",strtotime($this->from->format("m/d/Y"))); 

						$dateLargeTo = strftime("%d %B %Y",strtotime($this->to->format("m/d/Y"))); 



						$guetsStr = $this->totalAdults.(($this->totalAdults > 1) ? $GLOBALS['Hoteles_lbl_adults'] : $GLOBALS['Hoteles_lbl_adult']).(($this->totalKids > 0) ? (($this->totalKids > 1) ? $GLOBALS['Hoteles_lbl_and'].$this->totalKids.$GLOBALS['Hoteles_lbl_kids'] : $GLOBALS['Hoteles_lbl_and'].$this->totalKids.$GLOBALS['Hoteles_lbl_kid']) : "");

						$roomsStr = $this->rooms.(($this->rooms > 1) ? $GLOBALS['Hoteles_lbl_rooms']: $GLOBALS['Hoteles_lbl_room']);



						$hoteles = $soapController->getAllHotels($parameters);

						include("views/Hotels/search.php");



					}



					return false;

				}



			} 

			catch (Exception $e) {

				$message = "El formato de las fechas no son válidas, verifica las fechas. Respetar el formato: <b>aaaa/mm/dd</b>";

			}



		}

		else

		{

			$message = "Los datos no están completos, favor de llenarlos de nuevo.";

		}

		///include("views/404.html");

		return false;

	}



	public function getDetails($lang = 'es'){



		$lang = new Language($lang);



		if(isset($_GET['to']) && isset($_GET['from']) && isset($_GET['rooms']) && isset($_GET['idDestiny']) && isset($_GET['idHotel']) && !empty($_GET['idHotel']) ){

			try{

				$idHotel = $_GET['idHotel'];



				$this->initDates();

				$this->initGuests();



				$urlReturn = "";



				if($this->validationDates()){

					$db = new db();

					$conn = $db->conn_local();

					$city = new City();

					$HotelCity = new HotelCity();

					if (!empty($_GET['idDestiny'])) {



						$query = 

						"SELECT 

						hotels_city.IdHotel,

						hotels_city.Name AS Name_Hotel,

						hotels_city.Category,

						cities.IdCity, 

						cities.Name AS Name_City, 

						cities.Country

						FROM hotels_city 

						INNER JOIN cities 

						ON hotels_city.City_id = cities.Id   

						WHERE IdHotel = ".$_GET['idHotel'].";";



						$stmt = $conn->prepare($query);

						$stmt->execute();

						$count = $stmt->rowCount();	

						if($count > 0){



							$rows = $stmt->fetch(PDO::FETCH_ASSOC);



							$city->setIdCity($rows["IdCity"]);

							$city->setName($rows["Name_City"]);

							$city->setCountry($rows["Country"]);



							$HotelCity->setIdHotel($rows["IdHotel"]);

							$HotelCity->setName($rows["Name_Hotel"]);

							$HotelCity->setCategory($rows["Category"]);



							$urlReturn .= "destiny=".$rows["Name_City"].", ".$rows["Country"]."&";

							$urlReturn .= "idDestiny=".$rows["IdCity"]."&";

						}



						$urlReturn .= "from=".$this->from->format("d/m/Y")."&";

						$urlReturn .= "to=".$this->to->format("d/m/Y")."&";

						$urlReturn .= "rooms=".$this->rooms."&";



						for ( $i = 0 ; $i < $this->rooms ; $i++) { 



							$urlReturn .= "adults[".$i."]=".$this->adults[$i]."&";

							$urlReturn .= "kids[".$i."]=".$this->kids[$i]."&";



							for ($j=0; $j < 3; $j++) { 



								if(!empty($this->ageKids[$i][$j])){

									$urlReturn .= "ages[".$i."][".$j."]=".$this->ageKids[$i][$j]."&";



								}

							}



						}

						//Variables para hacer la consulta de todos los hoteles del xml de HotelDo

						//Dejar en "" indica que buscará todos los hoteles de la ciudad

						$idCiudad = $city->getIdCity();



						$parameters = array(

							"a" => "OKTRA",

							"ip" => $this->ip,          

							"c" => $GLOBALS['Currency_HotelDo'],

							"h" => $idHotel,

							"l" => $GLOBALS['Lang_HotelDo'] ,

							"hash" => "ha:true"

						);



						//Parametro h dejar con un valor en getQuoteHotels -> Devuelve 1 hotel

						//Parametro h dejar sin un valor en getQuoteHotels -> Devuelve todos los hoteles

						$parameters2 = $this->getParameters($idHotel, $idCiudad, "", $GLOBALS['Lang_HotelDo'] , $GLOBALS['Currency_HotelDo'] );



						$soapController = new soapController();

						$dateLargeFrom = strftime("%d %B %Y",strtotime($this->from->format("m/d/Y"))); 

						$dateLargeTo = strftime("%d %B %Y",strtotime($this->to->format("m/d/Y")));



						$guetsStr = $this->totalAdults.(($this->totalAdults > 1) ? $GLOBALS['Hoteles_lbl_adults'] : $GLOBALS['Hoteles_lbl_adult']).(($this->totalKids > 0) ? (($this->totalKids > 1) ? $GLOBALS['Hoteles_lbl_and'].$this->totalKids.$GLOBALS['Hoteles_lbl_kids'] : $GLOBALS['Hoteles_lbl_and'].$this->totalKids.$GLOBALS['Hoteles_lbl_kid']) : "");

						$roomsStr = $this->rooms.(($this->rooms > 1) ? $GLOBALS['Hoteles_lbl_rooms']: $GLOBALS['Hoteles_lbl_room']);



						$hoteles = $soapController->getAllHotel($parameters, $parameters2);

						include("views/Hotels/details.php");

						return false;

					}

				}



			} 

			catch (Exception $e) {

				$message = "El formato de las fechas no son válidas, verifica las fechas. Respetar el formato: <b>aaaa/mm/dd</b>";

			}



		}

		else{

			$message = "Los datos no están completos, favor de llenarlos de nuevo.";

		}

		include("views/404.html");

		return false;

	}



	public function getReserve($lang = 'es'){

		unset($_COOKIE['urlReturn']);
		$lang = new Language($_COOKIE['Lang']);
		$_urlReturn  = urldecode($_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);
		setcookie('urlReturn', $_urlReturn, time() + (86400 * 30), "/");

		if(isset($_GET['to']) && isset($_GET['from']) && isset($_GET['rooms']) && isset($_GET['idRoom']) && isset($_GET['idDestiny']) && isset($_GET['idHotel']) && !empty($_GET['idHotel']) ){

			try{

				$idHotel = $_GET['idHotel'];

				$idRoom = $_GET['idRoom'];

				$roomSelected = array();



				$this->initDates();

				$this->initGuests();



				if($this->validationDates()){

					$db = new db();

					$conn = $db->conn_local();

					$city = new City();

					if (!empty($_GET['idDestiny'])) {



						$query = "SELECT IdCity,Name,Country FROM cities WHERE IdCity = ".$_GET['idDestiny'].";";

						$stmt = $conn->prepare($query);

						$stmt->execute();

						$count = $stmt->rowCount();	

						if($count > 0){

							$rows = $stmt->fetch(PDO::FETCH_ASSOC);

							$city->setIdCity($rows["IdCity"]);

							$city->setName($rows["Name"]);

							$city->setCountry($rows["Country"]);

						}



						$idCiudad = $city->getIdCity();



						$parameters = array(

							"a" => "OKTRA",

							"ip" => $this->ip,          

							"c" => $GLOBALS['Currency_HotelDo'],

							"h" => $idHotel,

							"l" => $GLOBALS['Lang_HotelDo'] ,

							"hash" => "ha:true"

						);



						$parameters2 = $this->getParameters($idHotel, $idCiudad, "", $GLOBALS['Lang_HotelDo'] , $GLOBALS['Currency_HotelDo'] );



						$soapController = new soapController();



						$dateLargeFrom = strftime("%d %B %Y",strtotime($this->from->format("m/d/Y"))); 

						$dateLargeTo = strftime("%d %B %Y",strtotime($this->to->format("m/d/Y"))); 



						$guetsStr = $this->totalAdults.(($this->totalAdults > 1) ? $GLOBALS['Hoteles_lbl_adults'] : $GLOBALS['Hoteles_lbl_adult']).(($this->totalKids > 0) ? (($this->totalKids > 1) ? $GLOBALS['Hoteles_lbl_and'].$this->totalKids.$GLOBALS['Hoteles_lbl_kids'] : $GLOBALS['Hoteles_lbl_and'].$this->totalKids.$GLOBALS['Hoteles_lbl_kid']) : "");

						$roomsStr = $this->rooms.(($this->rooms > 1) ? $GLOBALS['Hoteles_lbl_rooms']: $GLOBALS['Hoteles_lbl_room']);



						$hoteles = $soapController->getAllHotel($parameters, $parameters2);



						foreach ($hoteles->Rooms as $room) {

							if(strcmp($room->Id, $idRoom) == 0){

								$roomSelected = $room;

								break;

							}

						}



						include("views/Hotels/reserve.php");

						return false;

					}

				}

			} 

			catch (Exception $e) {

				$message = "El formato de las fechas no son válidas, verifica las fechas. Respetar el formato: <b>aaaa/mm/dd</b>";

			}



		}

		else{

			$message = "Los datos no están completos, favor de llenarlos de nuevo.";

		}

		include("views/404.html");

		return false;

	}



	public function getResponse(){



		

		$lang = new Language($_SESSION['Language']);

		$response = $_REQUEST;

		

		include("views/Hotels/response.php");

	}



	public function postReserve(){

		if(isset($_POST) && isset($_POST['accept_terms']) ){

			if(isset($_POST['to']) && isset($_POST['from']) && isset($_POST['rooms']) && isset($_POST['idRoom']) && isset($_POST['idDestiny']) && isset($_POST['idHotel']) && !empty($_POST['idHotel']) && isset($_POST['metodoPago'])){

				try 

				{
					$lang = (isset($_POST['lang'])) ? $_POST['lang'] : "es" ;
					$currency = "";
					$currency_2 = "";
					$lang_HotelDo = "";
					if(strcmp($lang, "es") == 0)
					{
						$currency = "pe";
						$currency_2 = "MXN";
						$lang_HotelDo = "esp";
						$type_currency = "CREPMX";
					}
					else if(strcmp($lang, "en") == 0)
					{
						$currency = "us";
						$currency_2 = "USD";
						$lang_HotelDo = "ing";
						$type_currency = "CREDMX";

					}
					else
					{
						$currency = "pe";
						$currency_2 = "MXN";
						$lang_HotelDo = "esp";
						$type_currency = "CREPMX";
					}

					/* Data Hotel */
					$this->to = DateTime::createFromFormat('d/m/Y', $_POST['to']);
					$this->from = DateTime::createFromFormat('d/m/Y', $_POST['from']);
					$idDestiny = $_POST["idDestiny"];
					$idHotel = $_POST["idHotel"];
					$idRoom = $_POST["idRoom"];
					$rooms = $_POST["rooms"];
					$adults = $_POST['adults'];
					$kids = (isset($_POST['kids'])) ? $_POST['kids'] : array() ;
					$ageKids = (isset($_POST['ages'])) ? $_POST['ages'] : array() ;
					$idCity = $_POST['idCity'];
					$people = 0;
					$NoAdults = 0;
					$NoKids = 0;

					foreach ($adults as $adult) {
						$NoAdults += $adult;
					}

					foreach ($kids as $kid) {
						$NoKids += $kid;
					}

					$people = $NoKids + $NoAdults;

					/* Data customer */
					$name = $_POST['nombre'];
					$lastName = $_POST['ape_pat'];
					$secondLastName = $_POST['ape_mat'];
					$phone = $_POST['telefono'];
					$email = $_POST['email'];
					$conf_email = $_POST['conf_email'];
					$country = $_POST['pais'];
					$state = $_POST['estado'];
					$city = $_POST['ciudad'];
					$postalCode = $_POST['codigo_postal'];
					$address = $_POST['direccion'];
					$comments = $_POST['comentarios'];
					/* Consulta para sacar el precio */

					$parameters = array(
						"a" => "OKTRA",
						"ip" => $this->ip,          
						"c" => $currency,
						"h" => $idHotel,
						"l" => $lang_HotelDo,
						"hash" => "ha:true");

					//$parameters2 = $this->getParameters($idHotel, $idCity, $idRoom, $lang_HotelDo , $currency );
					$parameters2 = array(
						"a" => "OKTRA",
						"ip" => $this->ip,          
						"c" => $currency,
						"sd" => $this->from->format("Ymd"),
						"ed" => $this->to->format("Ymd"),
						"h" => $idHotel,
						"rt" =>$idRoom,
						"mp" =>"",
						"r" => $rooms,
						"r1a" => $adults[0],
						"r1k" => $kids[0],
						"r1k1a" => (!empty($ageKids[0][0])) ? $ageKids[0][0] : 0,
						"r1k2a" => (!empty($ageKids[0][1])) ? $ageKids[0][1] : 0,
						"r1k3a" => (!empty($ageKids[0][2])) ? $ageKids[0][2] : 0,
						"r2a" => (!empty($adults[1])) ? $adults[1] : 0,
						"r2k" => (!empty($kids[1])) ? $kids[1] : 0,
						"r2k1a" => (!empty($ageKids[1][0])) ? $ageKids[1][0] : 0,
						"r2k2a" => (!empty($ageKids[1][1])) ? $ageKids[1][1] : 0,
						"r2k3a" => (!empty($ageKids[1][2])) ? $ageKids[1][2] : 0,
						"r3a" => (!empty($adults[2])) ? $adults[2] : 0,
						"r3k" => (!empty($kids[2])) ? $kids[2] : 0,
						"r3k1a" => (!empty($ageKids[2][0])) ? $ageKids[2][0] : 0,
						"r3k2a" => (!empty($ageKids[2][1])) ? $ageKids[2][1] : 0,
						"r3k3a" => (!empty($ageKids[2][2])) ? $ageKids[2][2] : 0,
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
						"l" => $lang_HotelDo,
						"hash" => "");

					$soapController = new soapController();
					$hoteles = $soapController->getAllHotel($parameters, $parameters2);
					$roomSelected = array();

					foreach ($hoteles->Rooms as $room) {

						if(strcmp($room->Id, $idRoom) == 0){
							$roomSelected = $room;
							break;
						}
					}


					$price = $roomSelected->MealPlans[0]->AgencyPublic->AgencyPublic;
					$neto = $roomSelected->MealPlans[0]->Total;
					//$price = 1;
					$db = new db();
					$conn = $db->conn_local();
					$query = "SELECT Key_ FROM sales ORDER BY Key_ DESC LIMIT 1";
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowCount();

					if($count > 0)

					{

						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$aes = new AESEncriptacion();
						$today = new DateTime();
						$sale = new sale();

						$nextKey = $row['Key_'] + 1;

						session_start();

						$idsession = session_id();

						//print_r($roomSelected);
						//Construcción de XML
						$xml_data  ='<Request Type="Reservation" Version="1.0">';
						$xml_data .='<affiliateid>OKTRA</affiliateid>';
						$xml_data .='<language>'.$lang_HotelDo.'</language>';
						$xml_data .='<currency>'.$currency.'</currency>';
						$xml_data .='<uid>'.$idsession.'</uid>';
						$xml_data .='<ip>'.$_SERVER['REMOTE_ADDR'].'</ip>';
						$xml_data .='<firstname>'.$name.'</firstname>';
						$xml_data .='<lastname>'.$lastName." ".$secondLastName.'</lastname>';
						$xml_data .='<emailaddress>'.$email.'</emailaddress>';
						$xml_data .='<country>'.$country.'</country>';
						$xml_data .='<clientcountry>'.$country.'</clientcountry>';
						$xml_data .='<address>'.$address.'</address>';
						$xml_data .='<city>'.$city.'</city>';
						$xml_data .='<state>'.$state.'</state>';
						$xml_data .='<zip>'.$postalCode.'</zip>';
						$xml_data .='<total>'.$roomSelected->MealPlans[0]->Total.'</total>';
						$xml_data .='<phones>';
						$xml_data .='<phone>';
						$xml_data .='<type>1</type>';
						$xml_data .='<number>'.$phone.'</number>';
						$xml_data .='</phone>';
						$xml_data .='</phones>';
						$xml_data .='<hotels>';
						$xml_data .='<hotel>';
						$xml_data .='<hotelid>'.$idHotel.'</hotelid>';
						$xml_data .='<roomtype>'.$idRoom.'</roomtype>';
						$xml_data .='<mealplan>'.$roomSelected->MealPlans[0]->Id.'</mealplan>';
						$xml_data .='<datearrival>'.$this->from->format("Ymd").'</datearrival>';
						$xml_data .='<datedeparture>'.$this->to->format("Ymd").'</datedeparture>';
						$xml_data .='<marketid>'.$roomSelected->MealPlans[0]->MarketId.'</marketid>';
						$xml_data .='<contractid>'.$roomSelected->MealPlans[0]->Contract.'</contractid>';
						$xml_data .='<dutypercent>0</dutypercent>';
						$xml_data .='<rooms>';
						for ($i=0; $i < $rooms ; $i++)
						{
							$xml_data .= "<room>
							<amount>".$roomSelected->MealPlans[0]->Total."</amount>
							<status>AV</status>
							<ratekey>".$roomSelected->MealPlans[0]->RateDetails->RateDetail->RateKey."</ratekey>
							<adults>".((!empty($adults[$i])) ? $adults[$i] : 1)."</adults>
							<kids>".((!empty($kids[$i])) ? $kids[$i] : 0)."</kids>
							<infants>0</infants>
							<k1a>".((!empty($ageKids[$i][0])) ? $ageKids[$i][0] : 0)."</k1a>
							<k2a>".((!empty($ageKids[$i][1])) ? $ageKids[$i][1] : 0)."</k2a>
							<k3a>".((!empty($ageKids[$i][2])) ? $ageKids[$i][2] : 0)."</k3a>
							</room>";
						}
						$xml_data .='</rooms>';
						$xml_data .='</hotel>';  	 	 
						$xml_data .='</hotels>';
						$xml_data .='<payments>';
						$xml_data .='<agencycreditpayment>';
						$xml_data .='<type>'.$type_currency.'</type>';
						$xml_data .='<currency>'.$currency.'</currency>';
						$xml_data .='<amount>'.$roomSelected->MealPlans[0]->Total.'</amount>';
						$xml_data .='</agencycreditpayment>';
						$xml_data .='</payments>';
						$xml_data .='</Request>';

						$sale->setKey($nextKey);
						$sale->setDate($today->format("Y-m-d H:i:s"));
						$sale->setXml($xml_data);
						$sale->setProvider("HotelDo");
						$sale->setIsDeleted(0);

						$customer = new customer();
						$customer->setName($name);
						$customer->setLastName($lastName);
						$customer->setSecondLastName($secondLastName);
						$customer->setPhone($phone);
						$customer->setEmail($email);
						$customer->setCountry($country);
						$customer->setState($state);
						$customer->setCity($city);
						$customer->setPostalCode($postalCode);
						$customer->setAddress($address);
						$customer->setComments($comments);


						$payment = new payment();
						$payment->setReference("N/A");
						$payment->setTotal($price);
						$payment->setSubtotal($neto);
						$payment->setDiscount(0);
						$payment->setPaymentMethod("credit card");
						$payment->setStatus(2);
						$payment->setCurrency($currency_2);
						$payment->setExchangeRate("N/A");


						$hotel = new hotel_();
						$hotel->setIdHotelDo($hoteles->Id);
						$hotel->setName($hoteles->Name);
						$hotel->setTypeService("Hotel");
						$hotel->setComments($comments);
						$hotel->setDateTo($this->to->format("Y-m-d H:i:s"));
						$hotel->setDateFrom($this->from->format("Y-m-d H:i:s"));
						$hotel->setNoPeople($people);
						$hotel->setKey_("N/A");
						$hotel->setCity($hoteles->CityName);
						$hotel->setCountry($hoteles->Address->Country->Name);
						$hotel->setNoRooms($rooms);
						$hotel->setMealPlan($roomSelected->MealPlans[0]->Name);
						$hotel->setCategoryRoom($roomSelected->Name);


						$arrayRoom = array();
						for ($i=0; $i < $rooms ; $i++) 
						{ 
							array_push($arrayRoom, array('adults' => $adults[$i] , 'kids' => $kids[$i] ));
						}

						$hotel->setRooms(json_encode($arrayRoom));
						$saleController = new salesController();
						$agent = $saleController->searchAgent("Machine");

						$commission = new commission();
						$commission->setAgent_Id($agent);
						$commission->setCommission(0);

						$sale->setCommission($commission);
						$sale->setService($hotel);
						$sale->setPayment($payment);
						$sale->setCustomer($customer);

						$salesController = new SalesController();

						$response = $salesController->saveSale($sale);

							//Se comprueba la respuesta de la inserción

						if($response[2]){ 

								//Se recupera la última id de la inserción

							$lastId = $response[1];
							$keys = $this->getKeys();
							$invoice = "OKTRIP".$lastId;
							$xml = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
							<P>
							<business>
							<id_company>".$keys[0]['Password']."</id_company>
							<id_branch>".$keys[1]['Password']."</id_branch>
							<user>".$keys[2]['Password']."</user>
							<pwd>".$keys[3]['Password']."</pwd>
							</business>
							<url>
							<reference>".$invoice."</reference>
							<amount>".$price."</amount>
							<moneda>".$currency_2."</moneda>
							<canal>W</canal>
							<omitir_notif_default>1</omitir_notif_default>
							<st_correo>1</st_correo>
							<mail_cliente>".$email."</mail_cliente>
							<datos_adicionales>
							<data id='1' display='true'>
							<label>Nombre</label>
							<value>".$name." ".$lastName." ".$secondLastName."</value>
							</data>
							</datos_adicionales>
							</url>
							</P>";
							
							$key= $keys[4]['Password']; 
							$key_commerce = $keys[5]['Password'];
							$encrypted_xml = $aes->encriptar($xml, $key);
							$xml = "<pgs><data0>".$key_commerce."</data0><data>".$encrypted_xml."</data></pgs>";
							$encode = urlencode($xml);
							$post_str = "xml=".$encode;

							/* POST a URL de pruebas */

							$URL = "https://qa5.mitec.com.mx/p/gen";

							$curl = curl_init();

							curl_setopt_array($curl, array(
								CURLOPT_URL => "https://bc.mitec.com.mx/p/gen",
								CURLOPT_RETURNTRANSFER => true,
								CURLOPT_ENCODING => "",
								CURLOPT_MAXREDIRS => 10,
								CURLOPT_TIMEOUT => 30,
								CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
								CURLOPT_CUSTOMREQUEST => "POST",
								CURLOPT_POSTFIELDS => $post_str,
								CURLOPT_HTTPHEADER => array(
									"Cache-Control: no-cache",
									"Content-Type: application/x-www-form-urlencoded",
								),
							));

							$output = curl_exec($curl);
							$err = curl_error($curl);
							curl_close($curl);
							if ($err) 
							{
								echo "cURL Error #:" . $err;
							}
							else
							{

								$descrypted_xml = $aes->desencriptar($output, $key);
								print_r($descrypted_xml);
								$sxe = new SimpleXMLElement($descrypted_xml);
								print_r($sxe);

								if( strcmp( $sxe->cd_response, "success") == 0 )
								{
									header("Location: ".$sxe->nb_url);
								}
							}
						}

					} 

					else

					{

						$response = array("No se encontró registro en la base de datos nueva. Tampoco hubo inserción", 1, false);
						print_r($response);
					}
				} 
				catch (Exception $e) 
				{
					print_r($e);

				}
			}
		}
	}

	public function postResponse(){

		try

		{
			if(!file_exists("log.txt")){
				$file = fopen("log.txt", "w");
				fwrite($file, "---- Inicio de log ----" . PHP_EOL);
				fclose($file);
			}

			if(!file_exists("test.txt")){
				$file2 = fopen("test.txt", "w");
				fwrite($file2, "---- Inicio de log ----" . PHP_EOL);
				fclose($file2);
			}

			$encrypted_xml = $_POST["strResponse"];

				$key="5503EB12E415210A8B1D8E7C74EB576E"; //Semilla
				$aes = new AESEncriptacion();
				$descrypted_xml = $aes->desencriptar($encrypted_xml, $key);
				$response = new SimpleXMLElement($descrypted_xml);

				$file2 = fopen("test.txt", "a");
				fwrite($file2, $descrypted_xml. PHP_EOL);
				fclose($file2);

				if(isset($response)){

					$response2 = json_encode($descrypted_xml)." - Fecha: ".date("Y-m-d H:i:s")."\n";
					$file = fopen("log.txt", "a");
					fwrite($file, $response2. PHP_EOL);
					fclose($file);

					

					include_once("class.phpmailer.php");
					$aux = explode("OKTRIP",$response->reference);
					$id = $aux[1];
					$file2 = fopen("test.txt", "a");
					fwrite($file2, $id. PHP_EOL);
					fclose($file2);
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

						$query = "UPDATE payments SET Reference = '".$response->reference."' WHERE Id = '".$payment_id."';";
						$stmt = $conn->prepare($query);
						$stmt->execute();

						$query = "UPDATE payments SET Xml = '".urlencode(json_encode($descrypted_xml))."' WHERE Id = '".$payment_id."';";
						$stmt = $conn->prepare($query);
						$stmt->execute();

						if(strcmp( $response->response, "approved") == 0 ) 
						{

							$query = "UPDATE payments SET Status='3', AuthorizationNo = '".$response->auth."' WHERE Id = '".$payment_id."';";
							$stmt = $conn->prepare($query);
							$stmt->execute();

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
							$mail->SetLanguage('en');
							$mail->IsSMTP();
							$mail->Host     = $Host;
							$mail->SMTPAuth = true;
							$mail->Username = $Username;
							$mail->Password = $Password;
							$mail->From     = $From;
							$mail->FromName = $FromName;
							$mail->AddAddress($To);
							$mail->addBcc("info@oktravel.mx");
							$mail->WordWrap = 50; 
							$mail->IsHTML(true);  
							$mail->Subject = $Subject;
							$mail->Body = $Message;
							$mail->CharSet = 'UTF-8';
							$mail->Send();

							$query = "SELECT Xml, isConfirmed FROM sales WHERE Id = '".$id."';";
							$stmt = $conn->prepare($query);
							$stmt->bindParam(1,$statusAutorizado);
							$stmt->execute();
							$count = $stmt->rowCount();
							if($count > 0) 
							{

								$rowXml = $stmt->fetch(PDO::FETCH_ASSOC);
								$xml = $rowXml["Xml"];
								$isConfirmed = $rowXml["isConfirmed"];
								$encode = urlencode($xml);
								$post_str = "xml=".$encode;

								if($isConfirmed == 0){

									$query = "UPDATE sales SET isConfirmed='1' WHERE Id  = '".$id."' ;";
									$stmt = $conn->prepare($query);
									$stmt->execute();

									$URL = "http://xml.e-tsw.com/AffiliateService/v1.0/AffiliateService.svc/restful/Book";
									/*$curl = curl_init();
									curl_setopt_array($curl, array(
										CURLOPT_URL => $URL,
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => "",
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 30,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => "POST",
										CURLOPT_POSTFIELDS => $post_str,
										CURLOPT_HTTPHEADER => array(
											"Content-Type: text/xml",
											"charset=utf-8",
										),
									));

									$output = curl_exec($curl);
									$error = curl_error($curl);
									curl_close($curl);*/
									$ch = curl_init($URL);
									curl_setopt($ch, CURLOPT_MUTE, 1);
									curl_setopt($ch, CURLOPT_POST, 1);
									curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=utf-8'));
									curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									$output = curl_exec($ch);
									$error = curl_error($ch);
									curl_close($ch);

									$file2 = fopen("test.txt", "a");
									fwrite($file2, $output. PHP_EOL);
									fclose($file2);

									if ($error) 
									{
										$msgError = "\ncURL Error #:" . $error." - Fecha: ".date("Y-m-d H:i:s")."\n";;
										$file = fopen("log.txt", "a");
										fwrite($file, $msgError . PHP_EOL);
										fclose($file);
									}
									else
									{

										$msg = json_encode($output)." - Fecha: ".date("Y-m-d H:i:s")."\n";
										$file = fopen("log.txt", "a");
										fwrite($file, $msg . PHP_EOL);
										fclose($file);
									}

									$output = stripslashes($output);

									$sxe = new SimpleXMLElement($output);
									$confirmation_id = $sxe->confirmationid;
									
									$query = "UPDATE sales SET Confirmation_id='".$confirmation_id."' WHERE Id  = '".$id."' ;";
									$stmt = $conn->prepare($query);
									$stmt->execute();

									$query = "UPDATE sales SET XMLResponse_HotelDo='".$output."' WHERE Id  = '".$id."' ;";
									$stmt = $conn->prepare($query);
									$stmt->execute();

								}
							}
							else 
							{
								$msg = "No se obtuvo el XML - Fecha: ".date("Y-m-d H:i:s")."\n";
								$file = fopen("log.txt", "a");
								fwrite($file, $msg . PHP_EOL);
								fclose($file);
							}


						}
						else if(strcmp( $response->response, "denied") == 0)
						{
							$query = "UPDATE payments SET Status='4', AuthorizationNo = '".$response->auth."' WHERE Id = '".$payment_id."';";
							$stmt = $conn->prepare($query);
							$stmt->execute();
						}


					}
				}

				$response = json_encode($descrypted_xml)." - Fecha: ".date("Y-m-d H:i:s")."\n";
				$file = fopen("log.txt", "a");
				fwrite($file, $response. PHP_EOL);
				fclose($file);
			}
			catch (Exception $e) 
			{
				$msg = json_encode($e)." - Fecha: ".date("Y-m-d H:i:s")."\n";
				$file = fopen("log.txt", "a");
				fwrite($file, $msg . PHP_EOL);
				fclose($file);
			}
		}



		public function initDates(){

		//Validar los datos, si no pasan se inician con los valores por default

			if(!empty($_GET['to']))

			{

				$this->to = DateTime::createFromFormat('d/m/Y', $_GET['to']);

			}

			else

			{

				$this->to = new DateTime();

				$this->to->add(new DateInterval('P2D'));

			}



			if(!empty($_GET['from']))

			{

				$this->from = DateTime::createFromFormat('d/m/Y', $_GET['from']);

			}

			else

			{

				$this->from = new DateTime();

				$this->from->add(new DateInterval('P1D'));

			}

		}





		/*$this->adults = array();



		$this->kids = array();



		$this->ageKids = array();



		$this->rooms = (!empty($_GET['rooms'])) ? urldecode($_GET['rooms']) : 1;



		for ($i=0; $i < $this->rooms; $i++) { 



			array_push($this->adults, $_GET[urldecode('adults['.$i.']')] );

			array_push($this->kids, $_GET[urldecode('kids['.$i.']')] );



			for ($j=0; $j < $this->kids[$i]; $j++) { 



				array_push($this->ageKids, $_GET[urldecode('ages['.$i.']['.$j.']')]);



			}





		}*/



		public function initGuests(){



			$this->rooms = (!empty($_GET['rooms'])) ? $_GET['rooms'] : 1;

			$this->adults = (!empty($_GET['adults'])) ? $_GET['adults'] : array();

			$this->kids = (!empty($_GET['kids'])) ? $_GET['kids'] : array();



			$this->ageKids = (!empty($_GET['ages'])) ? $_GET['ages'] : array();



			$this->totalAdults = 0;

			$this->totalKids = 0;



		//Validar número de rooms

			if($this->rooms > 3){

				$this->rooms = 3;

			}



		//Validar variables Adults y Kids

			if(count($this->adults) != $this->rooms || count($this->kids) != $this->rooms || count($this->ageKids) != $this->rooms ){



				$aux_adults = array();

				$aux_kids = array();

				$aux_age_kids = array();



				for ($i=0; $i < $this->rooms; $i++){



					if(isset($this->adults[$i]))

					{

						array_push($aux_adults,$this->adults[$i]);

					}

					else

					{

						array_push($aux_adults,1);

					}



					if(isset($this->kids[$i]))

					{



						array_push($aux_kids, $this->kids[$i]);



						if(isset($this->ageKids[$i]))

						{

							array_push($aux_age_kids, $this->ageKids[$i]);

						}

						else

						{

							array_push($aux_age_kids, array());



						}



					}

					else

					{

						array_push($aux_kids,0);

						array_push($aux_age_kids,array());



					}



				}

				$this->adults = $aux_adults;

				$this->kids = $aux_kids;

				$this->ageKids = $aux_age_kids;



			}



			for ($i=0; $i < $this->rooms; $i++) { 

				if($this->adults[$i] > 3 ) $this->adults[$i] = 3;

				if($this->kids[$i] > 3) $this->kids[$i] = 3;



				if($this->adults[$i] <= 0 ) $this->adults[$i] = 1;

				if($this->kids[$i] <= 0) $this->kids[$i] = 0;



				$this->totalAdults += $this->adults[$i];

				$this->totalKids += $this->kids[$i];

			}

		}



		public function validationDates(){

		//Validar las fechas

			$now = new DateTime();

			$now->setTime(0,0,0);



		//diferencia

			$diffTo = $now->diff($this->to);

			$diffFrom = $now->diff($this->from);



			if($diffTo->format('%R%a') <= 365){

				if($diffFrom->format('%R%a') <= 366){

					if($this->to > $this->from)

					{

						if($diffFrom->format('%R%d') > 0 && $diffTo->format('%R%d') > 0) return true;

						else $this->message = "Las fechas seleccionadas no pueden ser menores o igual a la fecha actual.";

					}

					else

					{

						$this->message = "La fecha de entrada no puede ser mayor o igual a la fecha de salida.";

					}

				}

				else

				{

					$this->message = "La fecha de salida debe ser menor o igual a un año de diferencia máxima.";

				}

			}

			else

			{

				$this->message = "La fecha de entrada debe ser menor o igual a un año de diferencia máxima.";

			}

			return false;

		}



		public function getParameters($idHotel = "", $idCity = "", $idRoom = "", $lang = "" , $currency = ""){



			return array(

				"a" => "OKTRA",

				"ip" => $this->ip,          

				"c" => $currency,

				"sd" => $this->from->format("Ymd"),

				"ed" => $this->to->format("Ymd"),

				"h" => $idHotel,

				"rt" =>$idRoom,

				"mp" =>"",



				"r" => $this->rooms,

				"r1a" => $this->adults[0],

				"r1k" => $this->kids[0],

				"r1k1a" => (!empty($this->ageKids[0][0])) ? $this->ageKids[0][0] : 0,

				"r1k2a" => (!empty($this->ageKids[0][1])) ? $this->ageKids[0][1] : 0,

				"r1k3a" => (!empty($this->ageKids[0][2])) ? $this->ageKids[0][2] : 0,



				"r2a" => (!empty($this->adults[1])) ? $this->adults[1] : 0,

				"r2k" => (!empty($this->kids[1])) ? $this->kids[1] : 0,

				"r2k1a" => (!empty($this->ageKids[1][0])) ? $this->ageKids[1][0] : 0,

				"r2k2a" => (!empty($this->ageKids[1][1])) ? $this->ageKids[1][1] : 0,

				"r2k3a" => (!empty($this->ageKids[1][2])) ? $this->ageKids[1][2] : 0,



				"r3a" => (!empty($this->adults[2])) ? $this->adults[2] : 0,

				"r3k" => (!empty($this->kids[2])) ? $this->kids[2] : 0,

				"r3k1a" => (!empty($this->ageKids[2][0])) ? $this->ageKids[2][0] : 0,

				"r3k2a" => (!empty($this->ageKids[2][1])) ? $this->ageKids[2][1] : 0,

				"r3k3a" => (!empty($this->ageKids[2][2])) ? $this->ageKids[2][2] : 0,



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

				"hash" => ""

			);

		}



		public function postPaypalresponse(){



			require("../class.phpmailer.php");

		// read the post from PayPal system and add 'cmd'

			$req = 'cmd=_notify-validate';



			foreach($_POST as $key => $value) {

				$value = urlencode(stripslashes($value));

				$req .= "&$key=$value";

			}

		//echo $req ;

		// post back to PayPal system to validate

			$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";

			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";

			$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";



			$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

		// assign posted variables to local variables

			$item_name		  = $_POST['item_name'];

			$item_number 	  = $_POST['item_number'];

			$payment_status   = $_POST['payment_status'];

			$payment_amount   = $_POST['mc_gross'];

			$payment_currency = $_POST['mc_currency'];

			$txn_id 		  = $_POST['txn_id'];

			$receiver_email   = $_POST['receiver_email'];

			$payer_email 	  = $_POST['payer_email'];

			$idaff 			  = $_POST['custom'];



			if (!$fp) {

			// HTTP ERROR

			}else{

				fputs ($fp, $header . $req);

				while( !feof($fp) ){

					$res = fgets ($fp, 1024);

					if (strcmp ($res, "VERIFIED") == 0){

						$exitoso=1;

					// check the payment_status is Completed

					// check that txn_id has not been previously processed

					// check that receiver_email is your Primary PayPal email

					// check that payment_amount/payment_currency are correct

					// process payment

					}elseif( strcmp ($res, "INVALID") == 0 ){

					// log for manual investigation

					}

				}

				fclose ($fp);

			}

			$numr = 0;

			if($txn_id != ""){



				$messageConsult = "";

				try {

					$db = new db();

					$conn = $db->connection3();

					$query = "INSERT INTO paypalpagos (item_name, item_number, payment_status, payment_amount, payment_currency, txn_id, receiver_email, payer_email,fecha,fullresponse,idaff) VALUES (?,?,?,?,?,?,?,?,now(),?,?);";

					$stmt = $conn->prepare($query);

					$stmt->bindParam(1,$item_name);

					$stmt->bindParam(2,$item_number);

					$stmt->bindParam(3,$payment_status);

					$stmt->bindParam(4,$payment_amount);

					$stmt->bindParam(5,$payment_currency);

					$stmt->bindParam(6,$txn_id);

					$stmt->bindParam(7,$receiver_email);

					$stmt->bindParam(8,$payer_email);

					$stmt->bindParam(9,$req);

					$stmt->bindParam(10,$idaff);

					$stmt->execute();

					$count = $stmt->rowCount();

					if ($count > 0) {

						$messageConsult = "exito";

						if ($payment_status == "Completed") {

							$query = "UPDATE reservations set estatus=? WHERE  idres = ?;";

							$stmt = $conn->prepare($query);

							$stmt->bindParam(1,3);

							$stmt->bindParam(2,$item_number);

							$stmt->execute();

							$count = $stmt->rowCount();

							if ($count > 0) {

								$query = "SELECT * from reservations WHERE idres = ?";

								$stmt = $conn->prepare($query);

								$stmt->bindParam(1,$item_number);

								$stmt->execute();

								$count = $stmt->rowCount();

								if ($count > 0) {

									$row = $stmt->fetch(PDO::FETCH_ASSOC);



									$cliente	 = $row['firstname']." ".$row['lastname'];

									$hotel		 = $row['hotel'];

									$email		 = $row['email'];

									$total		 = $row['total'];

									$pais		 = $row['country'];

									$ciudad		 = $row['city'];

									$fechatranza = date("M j,y",strtotime($row["datetransaction"]));

									$datetranx	 = date("md",strtotime($row["datetransaction"]));

									$comments	 = $row['comments'];

									$mensaje = "

									<HTML>

									<BODY>

									<img src='http://adharacancun.com/dev/_assets/img/Logotipo-Adhara.png' /><br>

									<font face='Arial, Helvetica, sans-serif'>

									<p><strong>RESERVACION EN PROCESO</strong></p>

									<p><strong>ID: ".$idres."</strong></p>

									<p><strong>Cliente: </strong>".$cliente."<br>

									<strong>Ciudad:</strong> ".$ciudad."<br>

									<strong>Pais:</strong> ".$pais."<br>

									<strong>Email:</strong> ".$email."<br>

									<br>";

									$mensaje=$mensaje.$row["bddescription"]."<br><br>";

									if($comments != ""){

										$mensaje=$mensaje."<strong>Comentarios:</strong><br> ".$comments."<br><br>";

									}

									$mensaje=$mensaje."</p><hr>";

									$mensaje=$mensaje."</font></BODY></HTML>";

								$mailHost="mail.oktravel.mx"; //cambiar host

								$mailFromcuenta ="info@oktravel.mx"; //cambiar remitente

								$mailUsername = "info@oktravel.mx";  	// SMTP username

								$mailPassword = "oktravel1118"; 		// SMTP password

								$mailSubject  =  "Reservacion - ".$orderInfo;  // mensaje Subject

								$mailFromName = "Adhara Reservaciones"; // Nombre del remitente

								

								$emailinterno="reservaciones@adharacancun.com";

								$mimail="programacionweb@gphoteles.com";

								$mail1="reservaciones@gphoteles.com ";

								$mail2="asistente1.reservaciones@gphoteles.com "; 

								$mail3="gerenteenturno@gphoteles.com";

								$mail = new PHPMailer();

								$mail->SetLanguage('en');

								$mail->IsSMTP(); // send via SMTP

								$mail->Host     = $mailHost; 	// SMTP servers

								$mail->SMTPAuth = true;    	// turn on SMTP authentication

								$mail->Username = $mailUsername;  	// SMTP username

								$mail->Password = $mailPassword;  // SMTP password

								$mail->From     = $mailFromcuenta;

								$mail->FromName = $mailFromName;

								

								$mail->AddAddress($emailinterno); 

								$mail->AddAddress($mimail); 

								$mail->AddAddress($mail1); 

								$mail->AddAddress($mail2); 

								$mail->AddAddress($mail3); 

								

								$mail->WordWrap = 50;     // set word wrap

								$mail->IsHTML(true);                               // send as HTML

								$mail->Subject  =  $mailSubject;

								$mail->Body    =  $mensaje;

								if(!$mail->Send()){

									echo "Message was not sent <p>";

									echo "Mailer Error: " . $mail->ErrorInfo;

								}else{

									$mailenviado=1;

								}



								$conn = null;

							}

						}

					}

				}

			} catch (Exception $e) {

				echo "Error <br>";

				print_r($e);

			}



		} // fin if txn_id != ""



		error_reporting(0);

		$fecha=date("Y-m-d");



		// read the post from PayPal system and add 'cmd'

		$req = 'cmd=_notify-validate';

		foreach ($_POST as $key => $value) {

			$value = urlencode(stripslashes($value));

			$req .= "&$key=$value";

		}

		//echo $req ;

		// post back to PayPal system to validate

		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";

		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";

		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

		$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

		// assign posted variables to local variables

		$item_name		  = $_POST['item_name'];

		$item_number 	  = $_POST['item_number'];

		$payment_status   = $_POST['payment_status'];

		$payment_amount   = $_POST['mc_gross'];

		$payment_currency = $_POST['mc_currency'];

		$txn_id 		  = $_POST['txn_id'];

		$receiver_email   = $_POST['receiver_email'];

		$payer_email 	  = $_POST['payer_email'];

		$idaff 			  = $_POST['custom'];



		if(!$fp){

			// HTTP ERROR

		}else{

			fputs($fp, $header . $req);

			while (!feof($fp)) {

				$res = fgets ($fp, 1024);

				if(strcmp ($res, "VERIFIED") == 0){

					$exitoso=1;

					// check the payment_status is Completed

					// check that txn_id has not been previously processed

					// check that receiver_email is your Primary PayPal email

					// check that payment_amount/payment_currency are correct

					// process payment

				}

				elseif(strcmp ($res, "INVALID") == 0){

					// log for manual investigation

				}

			}

			fclose ($fp);

		}

		$numr = 0;

		if($txn_id!=""){



			$messageConsult = "";

			try {

				$db = new db();

				$conn = $db->connection3();

				$query = "INSERT INTO paypalpagos (item_name, item_number, payment_status, payment_amount, payment_currency, txn_id, receiver_email, payer_email,fecha,fullresponse,idaff) VALUES (?,?,?,?,?,?,?,?,now(),?,?);";

				$stmt = $conn->prepare($query);

				$stmt->bindParam(1,$item_name);

				$stmt->bindParam(2,$item_number);

				$stmt->bindParam(3,$payment_status);

				$stmt->bindParam(4,$payment_amount);

				$stmt->bindParam(5,$payment_currency);

				$stmt->bindParam(6,$txn_id);

				$stmt->bindParam(7,$receiver_email);

				$stmt->bindParam(8,$payer_email);

				$stmt->bindParam(9,$req);

				$stmt->bindParam(10,$idaff);

				$stmt->execute();

				$count = $stmt->rowCount();

				if ($count > 0) {

					$messageConsult = "exito";

					if ($payment_status == "Completed") {

						$query = "UPDATE reservations set estatus=? WHERE  idres = ?;";

						$stmt = $conn->prepare($query);

						$stmt->bindParam(1,3);

						$stmt->bindParam(2,$item_number);

						$stmt->execute();

						$count = $stmt->rowCount();

						if ($count > 0) {

							$query = "SELECT * from reservations WHERE idres = ?";

							$stmt = $conn->prepare($query);

							$stmt->bindParam(1,$item_number);

							$stmt->execute();

							$count = $stmt->rowCount();

							if ($count > 0) {

								$row = $stmt->fetch(PDO::FETCH_ASSOC);



								$cliente=$row['firstname']." ".$row['lastname'];

								$hotel=$row['hotel'];

								$email=$row['email'];

								$total=$row['total'];

								$pais=$row['country'];

								$ciudad=$row['city'];

								$fechatranza=date("M j,y",strtotime($row["datetransaction"]));

								$datetranx=date("md",strtotime($row["datetransaction"]));

								$comments=$row['comments'];	

								$xmldata=$row["xmldata"];

								$mensaje="<HTML>

								<BODY>

								<img src='http://adharacancun.com/_assets/img/Logotipo-Adhara.png' /><br>

								<font face='Arial, Helvetica, sans-serif'>";

								$mensaje=$mensaje."<p><strong>RESERVACION EN PROCESO</strong></p>

								<p><strong>ID: ".$idres."</strong></p>";

								$mensaje=$mensaje."<p>";

								$mensaje=$mensaje."<strong>Cliente: </strong>".$cliente."<br>

								<strong>Ciudad:</strong> ".$ciudad."<br>

								<strong>Pais:</strong> ".$pais."<br>

								<strong>Email:</strong> ".$email."<br>

								<br>";

								

								$mensaje=$mensaje.$row["bddescription"]."<br><br>";

								if ($comments!=""){

									$mensaje=$mensaje."<strong>Comentarios:</strong><br> ".$comments."<br><br>";

								}

								$mensaje=$mensaje."</p><hr>";

								$mensaje=$mensaje."</font></BODY></HTML>";

								

								$mailHost="mail.oktravel.mx"; //cambiar host

								$mailFromcuenta ="info@oktravel.mx"; //cambiar remitente

								$mailUsername = "info@oktravel.mx";  	// SMTP username

								$mailPassword = "oktravel1118"; 		// SMTP password

								$mailSubject  =  "Reservacion PAYPAL - ".$orderInfo;  // mensaje Subject

								$mailFromName = "Adhara Reservaciones"; // Nombre del remitente

								

								$emailinterno="reservaciones@adharacancun.com";

								$mimail="programacionweb@gphoteles.com";

								$mail1="reservaciones@gphoteles.com ";

								$mail2="asistente1.reservaciones@gphoteles.com "; 

								$mail3="gerenteenturno@gphoteles.com";

								$mail = new PHPMailer();

								$mail->SetLanguage('en');

								$mail->IsSMTP(); // send via SMTP

								$mail->Host     = $mailHost; 	// SMTP servers

								$mail->SMTPAuth = true;    	// turn on SMTP authentication

								$mail->Username = $mailUsername;  	// SMTP username

								$mail->Password = $mailPassword;  // SMTP password

								$mail->From     = $mailFromcuenta;

								$mail->FromName = $mailFromName;

								

								$mail->AddAddress($emailinterno); 

								$mail->AddAddress($mimail); 

								$mail->AddAddress($mail1); 

								$mail->AddAddress($mail2); 

								$mail->AddAddress($mail3); 

								

								$mail->WordWrap = 50;     // set word wrap

								$mail->IsHTML(true);      // send as HTML

								$mail->Subject  =  $mailSubject;

								$mail->Body    =  $mensaje;

								if(!$mail->Send()){

									echo "Message was not sent <p>";

									echo "Mailer Error: " . $mail->ErrorInfo;

								}else{

									$mailenviado=1;

								}

								$conn = null;

							}

						}

					}

				}

			} catch (Exception $e) {

				echo "Error <br>";

				print_r($e);

			}

		}

	}// fin de la funcion Paypalresponse



	public function Paypalsuccess(){



		include("views/Hotels/responsePaypal.php");

	}



	public function postOld(){



		if(isset($_POST) && isset($_POST['accept_terms']) ){

			if(isset($_POST['to']) && isset($_POST['from']) && isset($_POST['rooms']) && isset($_POST['idRoom']) && isset($_POST['idDestiny']) && isset($_POST['idHotel']) && !empty($_POST['idHotel']) && isset($_POST['metodoPago'])){

				try 

				{



					/*$secret = "6Ldoai8UAAAAAG3eXGX307-IYlR9XFdW7TCz6QVn";

					$recaptcha = new \ReCaptcha\ReCaptcha($secret, new \ReCaptcha\RequestMethod\CurlPost());

					$resp = $recaptcha->verify($_REQUEST['g-recaptcha-response'], $_SERVER["REMOTE_ADDR"]);

					if ($resp->isSuccess()) {*/



						/* Data Hotel */



						$this->to = DateTime::createFromFormat('d/m/Y', $_POST['to']);

						$this->from = DateTime::createFromFormat('d/m/Y', $_POST['from']);

						$idDestiny = $_POST["idDestiny"];

						$idHotel = $_POST["idHotel"];

						$idRoom = $_POST["idRoom"];

						$rooms = $_POST["rooms"];

						$adults = $_POST['adults'];

						$kids = (isset($_POST['kids'])) ? $_POST['kids'] : array() ;

						$ageKids = (isset($_POST['ages'])) ? $_POST['ages'] : array() ;

						$idCity = $_POST['idCity'];

						$people = 0;

						$NoAdults = 0;

						$NoKids = 0;



						foreach ($adults as $adult) {

							$NoAdults += $adult;

						}



						foreach ($kids as $kid) {

							$NoKids += $kid;

						}



						$people = $NoKids + $NoAdults;



						/* Data customer */



						$name = $_POST['nombre'];

						$lastName = $_POST['ape_pat'];

						$secondLastName = $_POST['ape_mat'];

						$phone = $_POST['telefono'];

						$email = $_POST['email'];

						$conf_email = $_POST['conf_email'];

						$country = $_POST['pais'];

						$state = $_POST['estado'];

						$city = $_POST['ciudad'];

						$postalCode = $_POST['codigo_postal'];

						$address = $_POST['direccion'];

						$comments = $_POST['comentarios'];



						/* Consulta para sacar el precio */



						$parameters = array(

							"a" => "OKTRA",

							"ip" => $this->ip,          

							"c" => "pe",

							"h" => $idHotel,

							"l" => "esp",

							"hash" => "ha:true");



						$parameters2 = array(



							"a" => "OKTRA",

							"ip" => $this->ip,          

							"c" => "pe",

							"sd" => $this->from->format("Ymd"),

							"ed" => $this->to->format("Ymd"),

							"h" => $idHotel,

							"rt" =>$idRoom,

							"mp" =>"",



							"r" => $rooms,

							"r1a" => $adults[0],

							"r1k" => $kids[0],



							"r1k1a" => (!empty($ageKids[0][0])) ? $ageKids[0][0] : 0,

							"r1k2a" => (!empty($ageKids[0][1])) ? $ageKids[0][1] : 0,

							"r1k3a" => (!empty($ageKids[0][2])) ? $ageKids[0][2] : 0,



							"r2a" => (!empty($adults[1])) ? $adults[1] : 0,

							"r2k" => (!empty($kids[1])) ? $kids[1] : 0,

							"r2k1a" => (!empty($ageKids[1][0])) ? $ageKids[1][0] : 0,

							"r2k2a" => (!empty($ageKids[1][1])) ? $ageKids[1][1] : 0,

							"r2k3a" => (!empty($ageKids[1][2])) ? $ageKids[1][2] : 0,



							"r3a" => (!empty($adults[2])) ? $adults[2] : 0,

							"r3k" => (!empty($kids[2])) ? $kids[2] : 0,

							"r3k1a" => (!empty($ageKids[2][0])) ? $ageKids[2][0] : 0,

							"r3k2a" => (!empty($ageKids[2][1])) ? $ageKids[2][1] : 0,

							"r3k3a" => (!empty($ageKids[2][2])) ? $ageKids[2][2] : 0,



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

							"l" => "esp",

							"hash" => "");



						$soapController = new soapController();

						$hoteles = $soapController->getAllHotel($parameters, $parameters2);

						$roomSelected = array();



						foreach ($hoteles->Rooms as $room) {



							if(strcmp($room->Id, $idRoom) == 0){

								$roomSelected = $room;

								break;

							}

						}



						$price = $roomSelected->MealPlans[0]->AgencyPublic->AgencyPublic;



						$response  = array();



						/* Inserción de datos (bd viejo y nuevo) */



						//session_start();

						$idsession = session_id();

						//print_r($roomSelected);

						//Construcción de XML

						$xml_data  ='<Request Type="Reservation" Version="1.0">';

						$xml_data .='<affiliateid>OKTRA</affiliateid>';

						$xml_data .='<language>esp</language>';

						$xml_data .='<currency>PE</currency>';

						$xml_data .='<uid>'.$idsession.'</uid>';

						$xml_data .='<ip>'.$_SERVER['REMOTE_ADDR'].'</ip>';

						$xml_data .='<firstname>'.$name.'</firstname>';

						$xml_data .='<lastname>'.$lastName." ".$secondLastName.'</lastname>';

						$xml_data .='<emailaddress>'.$email.'</emailaddress>';

						$xml_data .='<country>'.$country.'</country>';

						$xml_data .='<clientcountry>'.$country.'</clientcountry>';

						$xml_data .='<address>'.$address.'</address>';

						$xml_data .='<city>'.$city.'</city>';

						$xml_data .='<state>'.$state.'</state>';

						$xml_data .='<zip>'.$postalCode.'</zip>';



						$xml_data .='<total>'.$roomSelected->MealPlans[0]->Total.'</total>';

						$xml_data .='<phones>';

						$xml_data .='<phone>';

						$xml_data .='<type>1</type>';

						$xml_data .='<number>'.$phone.'</number>';

						$xml_data .='</phone>';

						$xml_data .='</phones>';



						$xml_data .='<hotels>';

						$xml_data .='<hotel>';

						$xml_data .='<hotelid>'.$idHotel.'</hotelid>';

						$xml_data .='<roomtype>'.$idRoom.'</roomtype>';



						$xml_data .='<mealplan>'.$roomSelected->MealPlans[0]->Id.'</mealplan>';

						$xml_data .='<datearrival>'.$this->from->format("Ymd").'</datearrival>';

						$xml_data .='<datedeparture>'.$this->to->format("Ymd").'</datedeparture>';



						$xml_data .='<marketid>'.$roomSelected->MealPlans[0]->MarketId.'</marketid>';

						$xml_data .='<contractid>'.$roomSelected->MealPlans[0]->Contract.'</contractid>';

						$xml_data .='<dutypercent>0</dutypercent>';



						$xml_data .='<rooms>';





						for ($i=0; $i < $rooms ; $i++)

						{

							$xml_data .= "<room>

							<amount>".$roomSelected->MealPlans[0]->Total."</amount>

							<status>AV</status>

							<ratekey>".$roomSelected->MealPlans[0]->RateDetails->RateDetail->RateKey."</ratekey>

							<adults>".((!empty($adults[$i])) ? $adults[$i] : 1)."</adults>

							<kids>".((!empty($kids[$i])) ? $kids[$i] : 0)."</kids>

							<infants>0</infants>

							<k1a>".((!empty($ageKids[$i][0])) ? $ageKids[$i][0] : 0)."</k1a>

							<k2a>".((!empty($ageKids[$i][1])) ? $ageKids[$i][1] : 0)."</k2a>

							<k3a>".((!empty($ageKids[$i][2])) ? $ageKids[$i][2] : 0)."</k3a>

							</room>";

						}



						$xml_data .='</rooms>';

						$xml_data .='</hotel>';  	 	 

						$xml_data .='</hotels>';



						$xml_data .='<payments>';

						$xml_data .='<agencycreditpayment>';

						$xml_data .='<type>CREPMX</type>';

						$xml_data .='<currency>PE</currency>';

						$xml_data .='<amount>'.$roomSelected->MealPlans[0]->Total.'</amount>';

						$xml_data .='</agencycreditpayment>';

						$xml_data .='</payments>';

						$xml_data .='</Request>';

						//echo $xml_data;





						$db = new db();

						$conn = $db->conn_local();

						$query = "SELECT Key_ FROM sales ORDER BY Key_ DESC LIMIT 1";

						$stmt = $conn->prepare($query);

						$stmt->execute();

						$count = $stmt->rowCount();



						//echo "<br>Base de datos nueva: <br>";

						if($count > 0)

						{



							$row = $stmt->fetch(PDO::FETCH_ASSOC);

							$nextKey = $row['Key_'] + 1;

							$today = new DateTime();

							$sale = new sale();



							$sale->setKey($nextKey);

							$sale->setDate($today->format("Y-m-d H:i:s"));

							$sale->setXml($xml_data);

							$sale->setProvider("");

							$sale->setIsDeleted(0);



							$customer = new customer();

							$customer->setName($name);

							$customer->setLastName($lastName);

							$customer->setSecondLastName($secondLastName);

							$customer->setPhone($phone);

							$customer->setEmail($email);

							$customer->setCountry($country);

							$customer->setState($state);

							$customer->setCity($city);

							$customer->setPostalCode($postalCode);

							$customer->setAddress($address);

							$customer->setComments($comments);



							$payment = new payment();



							$payment->setReference("N/A");

							$payment->setTotal($price);

							$payment->setSubtotal($price);

							$payment->setDiscount(0);

							$payment->setPaymentMethod("credit card");

							$payment->setStatus(2);

							$payment->setCurrency("MXN");

							$payment->setExchangeRate("N/A");



							$hotel = new hotel_();

							$hotel->setIdHotelDo($hoteles->Id);

							$hotel->setName($hoteles->Name);

							$hotel->setTypeService("Hotel");

							$hotel->setComments($comments);

							$hotel->setDateTo($this->to->format("Y-m-d H:i:s"));

							$hotel->setDateFrom($this->from->format("Y-m-d H:i:s"));

							$hotel->setNoPeople($people);

							$hotel->setKey("N/A");

							$hotel->setCity($hoteles->CityName);

							$hotel->setCountry($hoteles->Address->Country->Name);

							$hotel->setNoRooms($rooms);

							$hotel->setMealPlan($roomSelected->MealPlans[0]->Name);

							$hotel->setCategoryRoom($roomSelected->Name);



							$arrayRoom = array();



							for ($i=0; $i < $rooms ; $i++) 

							{ 

								array_push($arrayRoom, array('adults' => $adults[$i] , 'kids' => $kids[$i] ));

							}



							$hotel->setRooms(json_encode($arrayRoom));

							$saleController = new salesController();

							$agent = $saleController->searchAgent("Machine"); //respuesta generica



							$commission = new commission();

							$commission->setAgent($agent);

							$commission->setCommission(0);



							$sale->setCommission($commission);

							$sale->setService($hotel);

							$sale->setPayment($payment);

							$sale->setCustomer($customer);

							$response = $saleController->saveSale($sale);



							//print_r($response);

						}

						else

						{

							$response = array("No se encontró registro en la base de datos nueva. Tampoco hubo inserción", 1, false);

							//print_r($response);

						}





						/* Inserción bd vieja */



						$query = "INSERT INTO reservations (datetransaction, firstname, lastname, country,phone, email, hotel, total, neta, currency,city,comments, estatus, gateway, estate,bddescription, bdservicio, bdproveedor, llegada, salida, xmldata,referal) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);" ;



						$lastIdReservations = 0;

						$lastname_ = $lastName." ".$secondLastName;

						$currency = "MXP";

						$status = 2;

						$method = $_POST['metodoPago'];

						$provider = "";

						$typeService = "Hotel";

						$referal = "Oktrip";



						$bddescription = 

						"<br><strong>Hotel:</strong>".$hoteles->Name."<br>

						<strong>Hab. 1:</strong> ".$NoAdults." Adultos, ".$NoKids." Menores<br>

						<strong>Tipo de habitaci&oacute;n: </strong>".$roomSelected->Name."<br>

						<strong>Plan de alimentos: </strong>".$roomSelected->MealPlans[0]->Name."<br>

						<strong>Fecha de llegada: </strong>".$this->to->format("Y-m-d")."<br>

						<strong>Fecha de salida: </strong>".$this->to->format("Y-m-d")."<br>";



						$conn = $db->conn_local();

						$stmt = $conn->prepare($query);



						$stmt->bindParam(1,date("Y-m-d H:i:s"));

						$stmt->bindParam(2,$name);

						$stmt->bindParam(3,$lastname_);

						$stmt->bindParam(4,$country);

						$stmt->bindParam(5,$phone);

						$stmt->bindParam(6,$email);

						$stmt->bindParam(7,$hoteles->Name);

						$stmt->bindParam(8,$price);

						$stmt->bindParam(9,$price);

						$stmt->bindParam(10,$currency);

						$stmt->bindParam(11,$city);

						$stmt->bindParam(12,$comments);

						$stmt->bindParam(13,$status);

						$stmt->bindParam(14,$method);

						$stmt->bindParam(15,$state);

						$stmt->bindParam(16,$bddescription);

						$stmt->bindParam(17,$typeService);

						$stmt->bindParam(18,$provider);

						$stmt->bindParam(19,$this->to->format("Y-m-d H:i:s"));

						$stmt->bindParam(20,$this->from->format("Y-m-d H:i:s"));

						$stmt->bindParam(21,$xml_data);

						$stmt->bindParam(22,$referal);

						$stmt->execute();



						$count = $stmt->rowCount();



						//echo "<br>Base de datos vieja: <br>";

						if($count > 0)

						{

							//echo "<br>Exito<br>";

							$lastIdReservations = $conn->lastInsertId();



							/* después de la inserción consulta ID */

							//$Reserva_id = $response[1];	-> Cambiar a la base de datos nueva

							$Reserva_id = $lastIdReservations; //->Id base vieja

							switch ($_POST['metodoPago']) {



								case 'credit_card':



								$title = "PHP VPC 3 Party Super Transacion";

								$virtualPaymentClientURL = "https://banamex.dialectpayments.com/vpcpay";

								$vpc_Version = 1;

								$vpc_Command = "pay";

								$vpc_AccessCode = "7A3598AB";

								$vpc_MerchTxnRef = "REF".$Reserva_id;

								$vpc_Merchant = 1021053;

								$vpc_OrderInfo = $Reserva_id; 

								$vpc_Amount = round($price * 100);

								$vpc_ReturnURL = "https://newsite.oktravel.mx/hoteles/pasarela";

								$vpc_Locale = "es_MX";

								$vpc_Currency = "MXN";

								$vpc_CustomPaymentPlanPlanId = "";



								echo '<form name="forma" id="forma" action="../lib/banamex/PHP_VPC_3Party_Super_Order_DO.php" method="post" accept-charset="UTF-8">

								<input type="hidden" name="Title" value = "PHP VPC 3 Party Super Transacion">

								<input name="virtualPaymentClientURL" value="https://banamex.dialectpayments.com/vpcpay"  type="hidden" />

								<input name="vpc_Version" value="1" type="hidden" maxlength="8"/>

								<input name="vpc_Command" value="pay" type="hidden" maxlength="16"/>

								<input name="vpc_AccessCode" value="7A3598AB" type="hidden" maxlength="8"/>

								<input name="vpc_MerchTxnRef" value="'.$vpc_MerchTxnRef.'" type="hidden" maxlength="40"/>

								<input name="vpc_Merchant" value="1021053" type="hidden" maxlength="16"/>

								<input name="vpc_OrderInfo" value="'.$vpc_OrderInfo.'" type="hidden"  maxlength="34"/>

								<input name="vpc_Amount" value="'.$vpc_Amount.'" type="hidden" maxlength="10"/>

								<input name="vpc_ReturnURL" type="hidden" value="'.$vpc_ReturnURL.'" maxlength="250"/>

								<input name="vpc_Locale" type="hidden" value="es_MX" />

								<input name="vpc_Currency" type="hidden" value="MXN" />

								<input type="hidden"  name="vpc_CustomPaymentPlanPlanId" value="" maxlength="16" />

								</form>

								<script type="text/javascript">

								document.getElementById("forma").submit();

								</script>'; 

								break;



								case 'paypal':

								$paypalchain = $hotel->getName()." - ";

								$paypalchain = $paypalchain."Hab. 1: ".$adults[0]." Ad,".$kids[0]." Ni";

								if($rooms == 2){ 

									$paypalchain = $paypalchain." - Hab. 2: ".$adults[1]." Ad,".$kids[1]." Ni";

								}   

								if($rooms == 3){ 

									$paypalchain = $paypalchain." - Hab. 3: ".$adults[2]." Ad,".$kids[2]." Ni";

								}  

								$paypalchain = $paypalchain." Desde: ". $this->to->format("Y-m-d");

								$paypalchain = $paypalchain." Hasta: ". $this->from->format("Y-m-d");

								echo '

								<form name="forma" id="forma" action="https://www.paypal.com/mx/cgi-bin/webscr" method="post" accept-charset="UTF-8">

								<input type="hidden" name="cmd" value="_xclick" />

								<input type="hidden" name="business" value="joseluis@oktravel.mx" />

								<input type="hidden" name="item_name" value="'.$paypalchain.'" />

								<input type="hidden" name="item_number" value="'.$Reserva_id.'" />

								<input type="hidden" name="amount" value="'.$price.'" />

								<input type="hidden" name="currency_code" value="MXN" />

								<input type="hidden" name="return" value="http://newsite.oktravel.mx/hoteles/paypalsuccess" />

								<input type="hidden" name="cancel_return" value="http://newsite.oktravel.mx" />

								<input type="hidden" name="undefined_quantity" value="0" />

								<input type="hidden" name="receiver_email" value="fabiola@oktravel.mx" />

								<input type="hidden" name="no_shipping" value="1" />

								<input type="hidden" name="no_note" value="1" />

								<input type="hidden" name="notify_url" value="https://newsite.oktravel.mx/hoteles/paypalresponse">

								</form>

								<script type="text/javascript">

								document.getElementById("forma").submit();

								</script>';

								break;



								default:

								break;

							}



						}

						else

						{

							echo "OCURRIÓ UN ERROR AL PROCESAR TU PETICIÓN";

						}



					/*}

					else

					{

						switch ($resp->getErrorCodes()[0]) {

							case 'timeout-or-duplicate':

							echo json_encode(array("type" => "error" , "message" => "El tiempo de espera se ha expirado o el ReCaptcha se ha duplicado, intente recargando la página."));

							break;

							case 'missing-input-response':

							echo json_encode(array("type" => "error" , "message" => "Captcha inválido. Comprueba que no eres un robot."));

							break;

							default:

							echo json_encode(array("type" => "error" , "message" => "Hubo un problema inesperado, intente recargando la página y si el problema persiste comuníquese con el técnico acerca de este problema: ".$resp->getErrorCodes()[0]));

							break;

						}

					}*/		

				} 

				catch (Exception $e) 

				{

					print_r($e);

				}

			}

			else

			{



			}



		}

	}



	public function getOldPasarela($en = false){



		//require("../class.phpmailer.php");

		// Initialisation

		include('lib/banamex/VPCPaymentConnection.php');

		$conn = new VPCPaymentConnection();



		// This is secret for encoding the SHA256 hash

		// This secret will vary from merchant to merchant

		$secureSecret = "0B5058B8D639F3A30D60E4DF1981CBF1";



		// Set the Secure Hash Secret used by the VPC connection object

		$conn->setSecureSecret($secureSecret);



		// Set the error flag to false

		$errorExists = false;



		// *******************************************

		// START OF MAIN PROGRAM

		// *******************************************



		// This is the title for display

		$title  = $_GET["Title"];



		// Add VPC post data to the Digital Order

		foreach($_GET as $key => $value) {

			if (($key!="vpc_SecureHash") && ($key != "vpc_SecureHashType") && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {

				$conn->addDigitalOrderField($key, $value);

			}

		}



		// Obtain a one-way hash of the Digital Order data and

		// check this against what was received.

		$serverSecureHash	= array_key_exists("vpc_SecureHash", $_GET)	? $_GET["vpc_SecureHash"] : "";

		$secureHash = $conn->hashAllFields();

		if ($secureHash==$serverSecureHash) {

			$hashValidated = "<font color='#00AA00'><strong>CORRECT</strong></font>";

		} else {

			$hashValidated = "<font color='#FF0066'><strong>INVALID HASH</strong></font>";

			$errorsExist = true;

		}



		/*  If there has been a merchant secret set then sort and loop through all the

		    data in the Virtual Payment Client response. while we have the data, we can

		    append all the fields that contain values (except the secure hash) so that

		    we can create a hash and validate it against the secure hash in the Virtual

		    Payment Client response.



		    NOTE: If the vpc_TxnResponseCode in not a single character then

		    there was a Virtual Payment Client error and we cannot accurately validate

		    the incoming data from the secure hash. 



		    // remove the vpc_TxnResponseCode code from the response fields as we do not 

		    // want to include this field in the hash calculation

		    

		    if (secureSecret != null && secureSecret.length() > 0 && 

		        (fields.get("vpc_TxnResponseCode") != null || fields.get("vpc_TxnResponseCode") != "No Value Returned")) {

		        

		        // create secure hash and append it to the hash map if it was created

		        // remember if secureSecret = "" it wil not be created

		        String secureHash = vpc3conn.hashAllFields(fields);

		    

		        // Validate the Secure Hash (remember MD5 hashes are not case sensitive)

		        if (vpc_Txn_Secure_Hash.equalsIgnoreCase(secureHash)) {

		            // Secure Hash validation succeeded, add a data field to be 

		            // displayed later.

		            hashValidated = "<font color='#00AA00'><strong>CORRECT</strong></font>";

		        } else {

		            // Secure Hash validation failed, add a data field to be

		            // displayed later.

		            errorExists = true;

		            hashValidated = "<font color='#FF0066'><strong>INVALID HASH</strong></font>";

		        }

		    } else {

		        // Secure Hash was not validated, 

		        hashValidated = "<font color='orange'><strong>Not Calculated - No 'SECURE_SECRET' present.</strong></font>";

		    }

		*/

	    // Extract the available receipt fields from the VPC Response

	    // If not present then let the value be equal to 'Unknown'

	    // Standard Receipt Data



		    $Title 				= array_key_exists("Title", $_GET) 						? $_GET["Title"] 				: "";

		    $againLink 			= array_key_exists("AgainLink", $_GET) 					? $_GET["AgainLink"] 			: "";

		    $amount 			= array_key_exists("vpc_Amount", $_GET) 				? $_GET["vpc_Amount"] 			: "";

		    $locale 			= array_key_exists("vpc_Locale", $_GET) 				? $_GET["vpc_Locale"] 			: "";

		    $batchNo 			= array_key_exists("vpc_BatchNo", $_GET) 				? $_GET["vpc_BatchNo"] 			: "";

		    $command 			= array_key_exists("vpc_Command", $_GET) 				? $_GET["vpc_Command"] 			: "";

		    $message 			= array_key_exists("vpc_Message", $_GET) 				? $_GET["vpc_Message"]			: "";

		    $version  			= array_key_exists("vpc_Version", $_GET) 				? $_GET["vpc_Version"] 			: "";

		    $cardType   		= array_key_exists("vpc_Card", $_GET) 					? $_GET["vpc_Card"] 			: "";

		    $orderInfo 			= array_key_exists("vpc_OrderInfo", $_GET) 				? $_GET["vpc_OrderInfo"] 		: "";

		    $receiptNo 			= array_key_exists("vpc_ReceiptNo", $_GET) 				? $_GET["vpc_ReceiptNo"] 		: "";

		    $merchantID  		= array_key_exists("vpc_Merchant", $_GET) 				? $_GET["vpc_Merchant"] 		: "";

		    $merchTxnRef 		= array_key_exists("vpc_MerchTxnRef", $_GET) 			? $_GET["vpc_MerchTxnRef"]		: "";

		    $authorizeID 		= array_key_exists("vpc_AuthorizeId", $_GET) 			? $_GET["vpc_AuthorizeId"] 		: "";

		    $transactionNo  	= array_key_exists("vpc_TransactionNo", $_GET) 			? $_GET["vpc_TransactionNo"] 	: "";

		    $acqResponseCode 	= array_key_exists("vpc_AcqResponseCode", $_GET) 		? $_GET["vpc_AcqResponseCode"] 	: "";

		    $txnResponseCode 	= array_key_exists("vpc_TxnResponseCode", $_GET) 		? $_GET["vpc_TxnResponseCode"] 	: "";

		    $riskOverallResult	= array_key_exists("vpc_RiskOverallResult", $_GET) 		? $_GET["vpc_RiskOverallResult"]: "";

		// Obtain the 3DS response

		    $vpc_3DSECI				= array_key_exists("vpc_3DSECI", $_GET) 			? $_GET["vpc_3DSECI"] : "";

		    $vpc_3DSXID				= array_key_exists("vpc_3DSXID", $_GET) 			? $_GET["vpc_3DSXID"] : "";

		    $vpc_3DSenrolled 		= array_key_exists("vpc_3DSenrolled", $_GET) 		? $_GET["vpc_3DSenrolled"] : "";

		    $vpc_3DSstatus 			= array_key_exists("vpc_3DSstatus", $_GET) 			? $_GET["vpc_3DSstatus"] : "";

		    $vpc_VerToken 			= array_key_exists("vpc_VerToken", $_GET) 			? $_GET["vpc_VerToken"] : "";

		    $vpc_VerType 			= array_key_exists("vpc_VerType", $_GET) 			? $_GET["vpc_VerType"] : "";

		    $vpc_VerStatus			= array_key_exists("vpc_VerStatus", $_GET) 			? $_GET["vpc_VerStatus"] : "";

		    $vpc_VerSecurityLevel	= array_key_exists("vpc_VerSecurityLevel", $_GET) 	? $_GET["vpc_VerSecurityLevel"] : "";



		// CSC Receipt Data

		    $cscResultCode 	= array_key_exists("vpc_CSCResultCode", $_GET)  			? $_GET["vpc_CSCResultCode"] : "";

		    $ACQCSCRespCode = array_key_exists("vpc_AcqCSCRespCode", $_GET) 			? $_GET["vpc_AcqCSCRespCode"] : "";



		// Get the descriptions behind the QSI, CSC and AVS Response Codes

		// Only get the descriptions if the string returned is not equal to "No Value Returned".

		    $txnResponseCodeDesc = "";

		    $cscResultCodeDesc = "";

		    $avsResultCodeDesc = "";



		    if ($txnResponseCode != "No Value Returned") {

		    	$txnResponseCodeDesc = getResultDescription($txnResponseCode);

		    }



		    if ($cscResultCode != "No Value Returned") {

		    	$cscResultCodeDesc = getCSCResultDescription($cscResultCode);

		    }



		    $error = "";

	    // Show this page as an error page if error condition

		    if ($txnResponseCode=="7" || $txnResponseCode=="No Value Returned" || $errorExists) {

		    	$error = "Error ";

		    }

	    // FINISH TRANSACTION - Process the VPC Response Data

	    // =====================================================

	    // For the purposes of demonstration, we simply display the Result fields on a

	    // web page.

	    /*

		$fecha=date("Y-m-d");

		if ($txnResponseCode<>""){ 

				$sqlPago = "insert into pagosamex (merchTxnRef, merchantID, orderInfo, amount, receiptNo, acqResponseCode, authorizeID, batchNo, transactionNo, cardType, cscResultCode, fecha) values ('$merchTxnRef', '$merchantID', '$orderInfo', '$amount', '$receiptNo', '$acqResponseCode', '$authorizeID', '$batchNo', '$transactionNo', '$cardType', '$cscResultCode', '$fecha')";

				$rsPago  = mysql_query($sqlPago) or die ("Error en la consulta: <b>$sqlPago</b>");





				if ($authorizeID != "" &&  $authorizeID != "000000"){ //actualizo reserva aceptada



			    $sqlUpdateReservation = "update reservations set estatus=3 where idres='".$orderInfo."'";

			    $rsUpdateReservation  = mysql_query($sqlUpdateReservation) or die ("Error en la consulta: <b>$sqlUpdateReservation</b>");

			    $sqlReservation = "select * from reservations where idres=".$orderInfo;

			    $rsReservation  = mysql_query($sqlReservation) or die ("Error en la consulta: <b>$sqlReservation</b>");



					while($rowReservation = mysql_fetch_array($rsReservation)){

						$cliente     = $rowReservation['firstname']." ".$rowReservation['lastname'];

						$hotel       = $rowReservation['hotel'];

						$email       = $rowReservation['email'];

						$total       = $rowReservation['total'];

						$pais        = $rowReservation['country'];

						$ciudad      = $rowReservation['city'];

						$fechatranza = date("M j,y",strtotime($rowReservation["datetransaction"]));

						$datetranx   = date("md",strtotime($rowReservation["datetransaction"]));

						$comments    = $rowReservation['comments'];	

						$xmldata     = $rowReservation["xmldata"];

						$mensaje     = "<HTML>

						<BODY>

						<img src='http://www.adharacancun.com/images/Logotipo-Adhara.png' /><br>

						<font face='Arial, Helvetica, sans-serif'>";

						$mensaje = $mensaje."<p><strong>RESERVACION EN PROCESO</strong></p>

						<p><strong>ID: ".$idres."</strong></p>";

						$mensaje = $mensaje."<p>";

						$mensaje = $mensaje."<strong>Cliente: </strong>".$cliente."<br>

						<strong>Ciudad:</strong> ".$ciudad."<br>

						<strong>Pais:</strong> ".$pais."<br>

						<strong>Email:</strong> ".$email."<br>

						<br>";

  						$mensaje = $mensaje.$row["bddescription"]."<br><br>";

						if ($comments!=""){

							$mensaje = $mensaje."<strong>Comentarios:</strong><br> ".$comments."<br><br>";

						}

						$mensaje = $mensaje."</p><hr>";

						$mensaje = $mensaje."</font></BODY></HTML>";



						$mailHost = "mail.oktravel.mx"; //cambiar host

						$mailFromcuenta = "info@oktravel.mx"; //cambiar remitente

						$mailUsername = "info@oktravel.mx";  	// SMTP username

						$mailPassword = "oktravel1118"; 		// SMTP password

						$mailSubject  =  "Reservacion - ".$orderInfo;  // mensaje Subject

						$mailFromName = "Adhara Reservaciones"; // Nombre del remitente



						$emailinterno="reservaciones@adharacancun.com";

						$mimail="programacionweb@gphoteles.com";

						$mail1="reservaciones@gphoteles.com ";

						$mail2="asistente1.reservaciones@gphoteles.com "; 

						$mail3="gerenteenturno@gphoteles.com";

						$mail = new PHPMailer();

						$mail->SetLanguage('en');

						$mail->IsSMTP(); // send via SMTP

						$mail->Host     = $mailHost; 	// SMTP servers

						$mail->SMTPAuth = true;    	// turn on SMTP authentication

						$mail->Username = $mailUsername;  	// SMTP username

						$mail->Password = $mailPassword;  // SMTP password

						$mail->From     = $mailFromcuenta;

						$mail->FromName = $mailFromName;



						$mail->AddAddress($emailinterno); 

						$mail->AddAddress($mimail); 

						$mail->AddAddress($mail1); 

						$mail->AddAddress($mail2); 

						$mail->AddAddress($mail3); 



						$mail->WordWrap = 50;     // set word wrap

						$mail->IsHTML(true);                               // send as HTML

						$mail->Subject  =  $mailSubject;

						$mail->Body    =  $mensaje;

						if(!$mail->Send()){

							echo "Message was not sent <p>";

							echo "Mailer Error: " . $mail->ErrorInfo;

						}else{

							$mailenviado=1;

						}

					}// fin while

			}// fin del if cuando se acepta el pago

		}

		*/

		include("views/Hotels/response.php");

	}



	public function getKeys(){



		try {

			$db = new db();

			$conn = $db->conn_local();

			$query = "SELECT Id_Key, AES_DECRYPT(Password,'oktrip2017') AS 'Password' FROM keys_ WHERE Id_Key LIKE 'OktripKeyProc_%';";

			$stmt = $conn->prepare($query);

			$stmt->execute();

			$keys=$stmt->fetchAll(PDO::FETCH_ASSOC);

			return $keys;

		} catch (Exception $e) {

			echo "Error al obtener las claves de acceso<br>";

			print_r($e);

			return NULL;

		}

	}



	public function postLogin(){



		if ($_POST) {

			if (isset($_POST['correo']) && isset($_POST['security']) ) 

			{

				session_start();

				try {

					require_once("/models/cliente.php");

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



	}



}



?>