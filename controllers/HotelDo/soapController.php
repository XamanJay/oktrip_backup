<?php


class soapController extends SoapClient
{

	public $sopaClient;

	function __construct($path = "https://oktrip.mx/doc/AffiliateService.wsdl",$options=array()){
		
		try {
			parent::__construct($path,$options);
		    $this->soapClient = new SoapClient($path,$options);
		    /*var_dump($this->soapClient->__getFunctions());
		    echo "<br>";*/
		} catch (SoapFault $fault) {
		    
			
			if(!file_exists("error_api_hotelDo.txt")){
				$file = fopen("error_api_hotelDo.txt", "w");
				fwrite($file, "---- Inicio de log errores ---- \n\n" . PHP_EOL);
				fclose($file);
			}

			$filename = fopen("error_api_hotelDo.txt", "a");
			fwrite($filename, "Error del dia ".date("Y-m-d H:i:s")."\n\n".$fault . PHP_EOL);
			fclose($filename);

			trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
		}
	}

	/*function __doRequest($request, $location, $action, $version, $one_way = 0) {
	    ob_start();
	    $this->soapClient->handle($request);
	    $response = ob_get_contents();
	    ob_end_clean();
	    return $response;
	}
*/
	//Parameters 1
	//Obtener información detallada de un hotel
	public function getHotelInformation($parameters){

		$ObjectInfo = $this->soapClient->GetHotelInformation($parameters);
		$filename = "getAllHotels.txt";
		$textInicio = "\n\n--------------- Respuesta de HotelDo ".date("Y/m/d")."--------------\n\n";
		file_put_contents ($filename,$textInicio ,FILE_APPEND);
		file_put_contents ($filename,$ObjectInfo ,FILE_APPEND);
		$HotelInfo = $ObjectInfo->GetHotelInformationResult->Hotel;

		$Hotel = new Hotel();

		$Hotel->Id 			 = $HotelInfo->Id;
		$Hotel->Name 		 = $HotelInfo->Name;
		$Hotel->Description  = $HotelInfo->Description;
		//$Hotel->CityName 	 = $HotelInfo->CityName;
		$Hotel->Category 	 = $HotelInfo->Category;
		//$Hotel->CategoryId = $HotelInfo->CategoryId;
		$Hotel->AllInclusive = new AllInclusive($HotelInfo->AllInclusive);
		$Hotel->CheckIn 	 = $HotelInfo->CheckIn;
		$Hotel->CheckOut 	 = $HotelInfo->CheckOut;
		$Hotel->Address 	 = new Address($HotelInfo->Address);
		$Hotel->Latitude 	 = $HotelInfo->Address->GeoLocation->Latitude;
		$Hotel->Longitude 	 = $HotelInfo->Address->GeoLocation->Longitude;
		$Hotel->AirportReference = $HotelInfo->AirportReference->MinutesTo;
		$Hotel->ThumbnailUrl = $HotelInfo->ThumbnailUrl;
		$Hotel->Review = new Review($HotelInfo->Reviews->Review);

		$Hotel->Gallery = array();
		$Hotel->Themes = array();
		$Hotel->Services = array();
		//$Hotel->Rooms = array();
		$Hotel->Facilities = array();
		$Hotel->Restaurants = array();
		$Hotel->Bars = array();

		foreach ($HotelInfo->Galleries->Image as $image)
		{
			array_push($Hotel->Gallery, new Photo($image));
		}
		foreach ($HotelInfo->Themes->Theme as $theme)
		{
			array_push($Hotel->Themes, new Theme($theme));
		}
		foreach ($HotelInfo->Services->Service as $service)
		{
			array_push($Hotel->Services, new Service($service));
		}
		foreach ($HotelInfo->Facilities->Comfort as $comfort)
		{
			array_push($Hotel->Facilities, new Comfort($comfort));
		}
		foreach ($HotelInfo->Restaurants->Restaurant as $restaurant)
		{
			array_push($Hotel->Restaurants, new Restaurant($restaurant));
		}
		foreach ($HotelInfo->Bars->Bar as $bar)
		{
			array_push($Hotel->Bars, new Bar($bar));
		}
		return $Hotel;
	}

	//Parameters 2
	//Obtener información seleccionada de un hotel
	public function getQuoteHotels($parameters){
		$ObjectInfo = $this->soapClient->GetQuoteHotels($parameters);
		//print_r($ObjectInfo);
		$HotelInfo = $ObjectInfo->GetQuoteHotelsResult->Hotels->Hotel;

		$Hotel = new Hotel();

		$Hotel->Id 			 = $HotelInfo->Id;
		$Hotel->Name 		 = $HotelInfo->Name;
		$Hotel->Description  = $HotelInfo->Description;
		$Hotel->CityName 	 = $HotelInfo->CityName;
		$Hotel->CategoryId = $HotelInfo->CategoryId;
		$Hotel->Address 	 = new Address((object) 
			array( 
				"City" => $HotelInfo->CityName,
				"Country" => $HotelInfo->CountryName,
				"Neighborhood" => "",
				"State" => "",
				"Street" => $HotelInfo->Street,
				"ZipCode" => $HotelInfo->ZipCode
			)
		);

		$Hotel->Latitude 	 = $HotelInfo->Latitude;
		$Hotel->Longitude 	 = $HotelInfo->Longitude;
		$Hotel->ThumbnailUrl = $HotelInfo->Image;
		$Hotel->Review = new Review($HotelInfo->Reviews->Review);
		$Hotel->Themes = array();
		$Hotel->Services = array();
		$Hotel->Rooms = array();

		foreach ($HotelInfo->Themes->Theme as $theme)
		{
			array_push($Hotel->Themes, new Theme($theme));
		}
		foreach ($HotelInfo->Services->Service as $service)
		{
			array_push($Hotel->Services, new Service($service));
		}
		foreach ($HotelInfo->Rooms->Room as $room)
		{
			array_push($Hotel->Rooms, new Room($room));
		}
		return $Hotel;
	}

	//Obtener información completa de un hotel
	public function getAllHotel($parameters, $parameters2){
		
		$Hotel = new Hotel();
		$ObjectInfo = $this->soapClient->GetHotelInformation($parameters);
		$HotelInfo = $ObjectInfo->GetHotelInformationResult->Hotel;
		$ObjectInfo = $this->soapClient->GetQuoteHotels($parameters2);

		if(isset($ObjectInfo->GetQuoteHotelsResult->Error))
		{
			$Hotel->setError($ObjectInfo->GetQuoteHotelsResult->Error);
		}
		else
		{
			$QuoteHotels = $ObjectInfo->GetQuoteHotelsResult->Hotels->Hotel;

			$Hotel->CityName 	 = $QuoteHotels->CityName;
			$Hotel->CategoryId	 = $QuoteHotels->CategoryId;
			$Hotel->Rooms = array();
			
			//print_r($QuoteHotels->Rooms);

			if(!empty($QuoteHotels->Rooms)){
				if(is_array($QuoteHotels->Rooms->Room)){
					foreach ($QuoteHotels->Rooms->Room as $room)
					{
						array_push($Hotel->Rooms, new Room($room));
					}
				}
				else
				{
					array_push($Hotel->Rooms, new Room($QuoteHotels->Rooms->Room));
				}
			}
		}

		$Hotel->Id 			 = $HotelInfo->Id;
		$Hotel->Name 		 = $HotelInfo->Name;
		$Hotel->Description  = $HotelInfo->Description;
		$Hotel->Category 	 = $HotelInfo->Category;
		$Hotel->AllInclusive = new AllInclusive($HotelInfo->AllInclusive);
		$Hotel->CheckIn 	 = $HotelInfo->CheckIn;
		$Hotel->CheckOut 	 = $HotelInfo->CheckOut;
		$Hotel->Address 	 = new Address($HotelInfo->Address);
		
		$Hotel->Latitude 	 = $HotelInfo->Address->GeoLocation->Latitude;
		$Hotel->Longitude 	 = $HotelInfo->Address->GeoLocation->Longitude;
		$Hotel->AirportReference = $HotelInfo->AirportReference->MinutesTo;
		$Hotel->ThumbnailUrl = $HotelInfo->ThumbnailUrl;

		//$Hotel->Review = new Review($HotelInfo->Reviews->Review);

		$Hotel->Gallery = array();
		$Hotel->Themes = array();
		$Hotel->Services = array();
		$Hotel->Facilities = array();
		$Hotel->Restaurants = array();
		$Hotel->Bars = array();

		//print_r($HotelInfo->Restaurants);

		/*if(!empty($HotelInfo->Rooms))
		{
			if (is_array($HotelInfo->Rooms->Room)) 
			{
				foreach ($HotelInfo->Rooms->Room as $room)
				{
					array_push($Hotel->Rooms, new Room($room));
				}
			}
			else
			{
				array_push($Hotel->Rooms, new Room($HotelInfo->Rooms->Room));
			}
		}*/
		if(!empty($HotelInfo->Galleries)){
			if(is_array($HotelInfo->Galleries->Image)){
				foreach ($HotelInfo->Galleries->Image as $image)
				{
					array_push($Hotel->Gallery, new Photo($image));
				}
			}
			else
			{
				array_push($Hotel->Gallery, new Photo($HotelInfo->Galleries->Image));
			}
		}
		if(!empty($HotelInfo->Themes)){
			if(is_array($HotelInfo->Themes->Theme)){
				foreach ($HotelInfo->Themes->Theme as $theme)
				{
					array_push($Hotel->Themes, new Theme($theme));
				}
			}
			else
			{
				array_push($Hotel->Themes, new Theme($HotelInfo->Themes->Theme));
			}
		}
		if(!empty($HotelInfo->Services)){
			if(is_array($HotelInfo->Services->Service)){
				foreach ($HotelInfo->Services->Service as $service)
				{
					array_push($Hotel->Services, new Service($service));
				}
			}
			else
			{
				array_push($Hotel->Services, new Service($HotelInfo->Services->Service));
			}
		}
		if(!empty($HotelInfo->Restaurants)){
			if(is_array($HotelInfo->Restaurants->Restaurant)){
				foreach ($HotelInfo->Restaurants->Restaurant as $restaurant)
				{
					array_push($Hotel->Restaurants, new Restaurant($restaurant));
				} 
			}
			else
			{
				array_push($Hotel->Restaurants, new Restaurant($HotelInfo->Restaurants->Restaurant));

			}
		}
		if(!empty($HotelInfo->Facilities)){
			if(is_array($HotelInfo->Facilities->Comfort)){
				foreach ($HotelInfo->Facilities->Comfort as $comfort)
				{
					array_push($Hotel->Facilities, new Comfort($comfort));
				}
			}
			else
			{
				array_push($Hotel->Facilities, new Comfort($HotelInfo->Facilities->Comfort));
			}
		}
		if(!empty($HotelInfo->Bars)){
			if(is_array($HotelInfo->Bars->Bar))
			{
				foreach ($HotelInfo->Bars->Bar as $bar)
				{
					array_push($Hotel->Bars, new Bar($bar));
				}
			}
			else
			{
				array_push($Hotel->Bars, new Bar($HotelInfo->Bars->Bar));
			}
		}
		return $Hotel;
	}

	//Obtener información seleccionada en una lista de todos los hoteles de una ciudad en específica
	//En una ciudad puede traer un arreglo de ciudades o un objecto de una ciudad
	public function getAllHotels($parameters2){
		try {

			$ObjectInfo = $this->soapClient->GetQuoteHotels($parameters2);
			$filename = "getAllHotels.txt";
			$textInicio = "\n\n--------------- Respuesta de HotelDo ".date("Y/m/d")."--------------\n\n";
			file_put_contents ($filename,$textInicio ,FILE_APPEND);
			file_put_contents ($filename,$ObjectInfo ,FILE_APPEND);
			//print_r($ObjectInfo);
			if(!isset($ObjectInfo->GetQuoteHotelsResult->Error)){

				$QuoteHotels = $ObjectInfo->GetQuoteHotelsResult->Hotels->Hotel;
				$ListaHoteles =  array(); 
				//print_r($QuoteHotels);
				//Se comprueba si el resultado de Hotel es un arreglo, se entiende que tienen varios hoteles
				//Si no arroja un objecto con un sólo hotel, el procedimiento es el mismo.
				if(is_array($QuoteHotels)){
					foreach ($QuoteHotels as $HotelInfo) {
						$Hotel = new Hotel();
						$Hotel->Id 			 = $HotelInfo->Id;
						$Hotel->Name 		 = $HotelInfo->Name;
						$Hotel->Description  = $HotelInfo->Description;
						$Hotel->CityName 	 = $HotelInfo->CityName;
						$Hotel->CategoryId = $HotelInfo->CategoryId;

						if(strcmp($HotelInfo->CategoryId, "S2") == 0) $Hotel->Stars = 2;
						else if(strcmp($HotelInfo->CategoryId, "S25") == 0) $Hotel->Stars = 2.5;
						else if(strcmp($HotelInfo->CategoryId, "S3") == 0) $Hotel->Stars = 3;
						else if(strcmp($HotelInfo->CategoryId, "S35") == 0) $Hotel->Stars = 3.5;
						else if(strcmp($HotelInfo->CategoryId, "S4") == 0) $Hotel->Stars = 4;
						else if(strcmp($HotelInfo->CategoryId, "S45") == 0) $Hotel->Stars = 4.5;
						else if(strcmp($HotelInfo->CategoryId, "S5") == 0) $Hotel->Stars = 5;
						else if(strcmp($HotelInfo->CategoryId, "S55") == 0) $Hotel->Stars = 5.5;
						else if(strcmp($HotelInfo->CategoryId, "S6") == 0) $Hotel->Stars = 6;

						$Hotel->Address 	 = new Address((object) 
							array( 
								"City" => $HotelInfo->CityName,
								"Country" => $HotelInfo->CountryName,
								"Neighborhood" => "",
								"State" => "",
								"Street" => $HotelInfo->Street,
								"ZipCode" => $HotelInfo->ZipCode
							)
						);

						$Hotel->Latitude 	 = $HotelInfo->Latitude;
						$Hotel->Longitude 	 = $HotelInfo->Longitude;

						$Hotel->ThumbnailUrl = (strpos($HotelInfo->Image, 'expedia')) ? str_replace("_t.", "_b.",$HotelInfo->Image) : str_replace("_t.", ".",$HotelInfo->Image);

						if(!empty($HotelInfo->Reviews->Review))
						{
							$Hotel->Review = new Review($HotelInfo->Reviews->Review);
						}
						else
						{

							$aux = (object) array('Rating' => 0 , 'Source' => 'TripAdvisor', 'Count' => 0);
							$Hotel->Review = new Review($aux);
						}

						$Hotel->Gallery = array();
						$Hotel->Themes = array();
						$Hotel->Services = array();
						$Hotel->Rooms = array();

						if(!empty($HotelInfo->Galleries))
						{
							if(is_array($HotelInfo->Galleries->Image))
							{
								foreach ($HotelInfo->Galleries->Image as $image)
								{
									array_push($Hotel->Gallery, new Photo($image));
								}
							}
							else
							{
								array_push($Hotel->Gallery, new Photo($HotelInfo->Galleries->Image));

							}
						}
						if(!empty($HotelInfo->Themes))
						{
							if(is_array($HotelInfo->Themes->Theme))
							{
								foreach ($HotelInfo->Themes->Theme as $theme)
								{
									array_push($Hotel->Themes, new Theme($theme));
								}
							}
							else
							{
								array_push($Hotel->Themes, new Theme($HotelInfo->Themes->Theme));
							}
						}
						if(!empty($HotelInfo->Services))
						{
							if(is_array($HotelInfo->Services->Service))
							{
								foreach ($HotelInfo->Services->Service as $service)
								{
									array_push($Hotel->Services, new Service($service));
								}
							}
							else
							{
								array_push($Hotel->Services, new Service($HotelInfo->Services->Service));
							}
						}
						if(!empty($HotelInfo->Rooms))
						{
							if (is_array($HotelInfo->Rooms->Room)) 
							{
								foreach ($HotelInfo->Rooms->Room as $room)
								{
									array_push($Hotel->Rooms, new Room($room));
								}
							}
							else
							{
								array_push($Hotel->Rooms, new Room($HotelInfo->Rooms->Room));
							}
						}
						array_push($ListaHoteles, $Hotel);
					}
					return $ListaHoteles;
				}
				else
				{
					$Hotel = new Hotel();
					$Hotel->Id 			 = $QuoteHotels->Id;
					$Hotel->Name 		 = $QuoteHotels->Name;
					$Hotel->Description  = $QuoteHotels->Description;
					$Hotel->CityName 	 = $QuoteHotels->CityName;
					$Hotel->CategoryId = $QuoteHotels->CategoryId;


					if(strcmp($QuoteHotels->CategoryId, "S2") == 0) $Hotel->Stars = 2;
					else if(strcmp($QuoteHotels->CategoryId, "S25") == 0) $Hotel->Stars = 2.5;
					else if(strcmp($QuoteHotels->CategoryId, "S3") == 0) $Hotel->Stars = 3;
					else if(strcmp($QuoteHotels->CategoryId, "S35") == 0) $Hotel->Stars = 3.5;
					else if(strcmp($QuoteHotels->CategoryId, "S4") == 0) $Hotel->Stars = 4;
					else if(strcmp($QuoteHotels->CategoryId, "S45") == 0) $Hotel->Stars = 4.5;
					else if(strcmp($QuoteHotels->CategoryId, "S5") == 0) $Hotel->Stars = 5;
					else if(strcmp($QuoteHotels->CategoryId, "S55") == 0) $Hotel->Stars = 5.5;
					else if(strcmp($QuoteHotels->CategoryId, "S6") == 0) $Hotel->Stars = 6;

					$Hotel->Address 	 = new Address((object) 
						array( 
							"City" => $QuoteHotels->CityName,
							"Country" => $QuoteHotels->CountryName,
							"Neighborhood" => "",
							"State" => "",
							"Street" => $QuoteHotels->Street,
							"ZipCode" => $QuoteHotels->ZipCode
						)
					);



					$Hotel->Latitude 	 = $QuoteHotels->Latitude;
					$Hotel->Longitude 	 = $QuoteHotels->Longitude;
					$Hotel->ThumbnailUrl = $QuoteHotels->Image;

					if(!empty($QuoteHotels->Reviews->Review))
					{
						$Hotel->Review = new Review($QuoteHotels->Reviews->Review);
					}
					else
					{
						$aux = (object) array('Rating' => 0 , 'Source' => 'TripAdvisor', 'Count' => 0);
						$Hotel->Review = new Review($aux);
					}


					$Hotel->Themes = array();
					$Hotel->Services = array();
					$Hotel->Rooms = array();

					if(!empty($QuoteHotels->Themes))
					{
						if(is_array($QuoteHotels->Themes->Theme))
						{
							foreach ($QuoteHotels->Themes->Theme as $theme)
							{
								array_push($Hotel->Themes, new Theme($theme));
							}
						}
						else
						{
							array_push($Hotel->Themes, new Theme($QuoteHotels->Themes->Theme));
						}
					}

					if(!empty($QuoteHotels->Services))
					{
						if(is_array($QuoteHotels->Services->Service))
						{
							foreach ($QuoteHotels->Services->Service as $service)
							{
								array_push($Hotel->Services, new Service($service));
							}
						}
						else
						{
							array_push($Hotel->Services, new Service($QuoteHotels->Services->Service));
						}
					}

					if(!empty($QuoteHotels->Rooms))
					{
						if (is_array($QuoteHotels->Rooms->Room)) 
						{
							foreach ($QuoteHotels->Rooms->Room as $room)
							{
								array_push($Hotel->Rooms, new Room($room));
							}
						}
						else
						{
							array_push($Hotel->Rooms, new Room($QuoteHotels->Rooms->Room));
						}
					}
					array_push($ListaHoteles, $Hotel);
					return $ListaHoteles;
				}
			}
			else{
				$Hotel = new Hotel();
				$Hotel->setError($ObjectInfo->GetQuoteHotelsResult->Error);
				return $Hotel;
			}
		} 
		catch (Exception $e) {
			//print_r($e);
		}
	}


	public function getDestinations($a = 'OKTRA', $l = 'esp', $ic = '' ){
		$ObjectInfo = $this->soapClient->GetDestinations(array("a" => $a, "l" => $l, "ic" => $ic));
		$filename = "getAllHotels.txt";
		$textInicio = "\n\n--------------- Respuesta de HotelDo ".date("Y/m/d")."--------------\n\n";
		file_put_contents ($filename,$textInicio ,FILE_APPEND);
		file_put_contents ($filename,$ObjectInfo ,FILE_APPEND);
		return $ObjectInfo->GetDestinationsResult->Destination;
	}

	public function getHotelsCities($d = ''){
		$ObjectInfo = $this->soapClient->GetHotelsComplete(array("a" => 'OKTRA', "d" => $d));
		$filename = "getAllHotels.txt";
		$textInicio = "\n\n--------------- Respuesta de HotelDo ".date("Y/m/d")."--------------\n\n";
		file_put_contents ($filename,$textInicio ,FILE_APPEND);
		file_put_contents ($filename,$ObjectInfo ,FILE_APPEND);
		return $ObjectInfo->GetHotelsCompleteResult;
	}
}

?>