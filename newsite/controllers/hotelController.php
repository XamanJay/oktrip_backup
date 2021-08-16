<?php 


class hotelController{


	function create($fechaEntrada,$idHotel){

		try {

			//cambiar el formato una fecha de DD-MM-AAAA a AAAA-MM-DD y se obtiene el numero de noches 
			$dateI = explode('-', $fechaEntrada);
			$date1 = $dateI[2]."-".$dateI[1]."-".$dateI[0];

			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM rooms AS r, seasons AS s WHERE r.id_hot = ? and  r.active=1 AND (r.id_room = s.id_room) AND s.borrado = 0 AND '$date1' BETWEEN s.startdate AND s.enddate GROUP BY r.categoria ORDER BY r.orden ASC ";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$rows = $stmt->fetchAll(PDO:: FETCH_ASSOC);
				$categorias = array();

				foreach ($rows as $row) {
					$categoria = $row['categoria'];
					array_push($categorias, $categoria);
					}
					return $categorias;
			}

			$conn = null;
			
		} catch (Exception $e) {
			
			echo "error al obtener las cagtegorias de los cuartos";
			print_r($e);
		}

		return false;

	}

	function getSeason($fechaEntrada,$fechaSalida,$idHotel){
		try {
			
			$dateI = explode('-', $fechaEntrada);
			$dateII = explode('-', $fechaSalida);
			$date1 = $dateI[0]."-".$dateI[1]."-".$dateI[2];
			$date2 = $dateII[0]."-".$dateII[1]."-".$dateII[2];
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM  seasons  WHERE isDeleted = 0 AND '$date2' BETWEEN startDate AND endDate AND idHotel=? ORDER BY idRoom DESC;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$query2 = "SELECT * FROM  seasons  WHERE isDeleted = 0 AND '$date1' BETWEEN startDate AND endDate AND idHotel=? ORDER BY idRoom DESC;";
				$stmt2 = $conn->prepare($query2);
				$stmt2->bindParam(1,$idHotel);
				$stmt2->execute();
				$count2 = $stmt2->rowCount();
				if($count2 > 0){

					$rows = $stmt2->fetchAll(PDO:: FETCH_ASSOC);
					$lista = array();
					foreach ($rows as $row) {

						$season = new season();
						$season->setIdRoom($row['idRoom']);
						array_push($lista, $season);
					}

					return $lista;
				}
				else{
					return 0;
				}
				
			}
			else{
				return 0;
			}

		} catch (Exception $e) {
			echo "error al obterner la temporada <br>";
			print_r($e);
		}
	}
	function getSingleSeason($fechaEntrada,$idHotel,$idRoom){
		try {
			
			$dateI = explode('-', $fechaEntrada);
			$date1 = $dateI[0]."-".$dateI[1]."-".$dateI[2];
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM  seasons  WHERE isDeleted = 0 AND '$date1' BETWEEN startDate AND endDate AND idHotel=? AND idRoom=?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->bindParam(2,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$row = $stmt->fetch(PDO:: FETCH_ASSOC);
				$season = new season();
				$season->setIdRoom($row['idRoom']);

				return $season;
			}

		} catch (Exception $e) {
			echo "error al obterner la temporada <br>";
			print_r($e);
		}
	}

	function getPromoSeason($fechaEntrada,$idHotel){

		try {

			$dateI = explode('-', $fechaEntrada);
			$date1 = $dateI[0]."-".$dateI[1]."-".$dateI[2];
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM  seasonspromo  WHERE isDeleted = 0 AND '$date1' BETWEEN startDate AND endDate AND idHotel=? ORDER BY idRoom DESC;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$rows = $stmt->fetchAll(PDO:: FETCH_ASSOC);
				$lista = array();
				foreach ($rows as $row) {

					$season = new season();
					$season->setIdRoom($row['idRoom']);
					array_push($lista, $season);
				}

				return $lista;
			}

		} catch (Exception $e) {

			echo "error al obterner la temporada <br>";
			print_r($e);
		}
	}

	function getPromoSeasonSingle($fechaEntrada,$idHotel,$idRoom){

		try {

			$dateI = explode('-', $fechaEntrada);
			$date1 = $dateI[0]."-".$dateI[1]."-".$dateI[2];
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM  seasonspromo  WHERE isDeleted = 0 AND '$date1' BETWEEN startDate AND endDate AND idHotel=? AND idRoom=?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->bindParam(2,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$row = $stmt->fetch(PDO:: FETCH_ASSOC);

				$season = new season();
				$season->setIdRoom($row['idRoom']);

				return $season;
			}

		} catch (Exception $e) {

			echo "error al obterner la temporada <br>";
			print_r($e);
		}
	}

	function getRooms($seasons,$fechaEntrada,$fechaSalida,$idHotel,$rooms,$arrayAdults,$arrayKids){

		try {

			$dateI = explode('-', $fechaEntrada);
			$dateF = explode('-', $fechaSalida);
			$date1 = $dateI[0]."-".$dateI[1]."-".$dateI[2];
			$date2 = $dateF[0]."-".$dateF[1]."-".$dateF[2];
			$startDate = date_create($date1);
			$endDate = date_create($date2);
			$diff = date_diff($startDate,$endDate);
		 	$noches = $diff->format("%a");
			$lista = array();
			$db = new db();
			$conn = $db->connection();
			foreach ($seasons as $season) {
				$idRoom = $season->getIdRoom();
				$query = "SELECT * FROM rooms WHERE isDeleted=0 and idHotel = ? AND id = ? ORDER BY priority DESC";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$idHotel);
				$stmt->bindParam(2,$idRoom);
				$stmt->execute();
				$count = $stmt->rowCount();
				if ($count > 0) {

					$rows2 = $stmt->fetchAll(PDO:: FETCH_ASSOC);
					foreach ($rows2 as $filas) {
						$cuarto = new cuarto();
						$cuarto->setIdr($filas['id']);
						$cuarto->setIdh($filas['idHotel']);
						$cuarto->setNombre($filas['nombre']);
						$cuarto->setName($filas['nombre_en']);
						$cuarto->setCapacidad($filas['capMax']);
						$cuarto->setTipo($filas['type']);
						$cuarto->setCategoria($filas['category']);
						$cuarto->setPrioridad($filas['priority']);
						$cuarto->setAlotment($filas['quantity']);
						$cuarto->setKidsAllow($filas['kidsAllow']);
						$cuarto->setFechaEntrada($date1);
						$cuarto->setFechaSalida($date2);
						$cuarto->setNoches($noches);

						$n_rooms = 0;
						$total = 0;
						$price = 0;
						$promo = 0;
						$pricePromo = 0;
						$listAllotment = array();
						$listCapacidad = array();
						$listKidsAllow = array();
						$adults = 0;
						$kids = 0;

						while ($n_rooms < $rooms) {

							$adults += $arrayAdults[$n_rooms];
							$kids += $arrayKids[$n_rooms];

							$allotment = Allotment($cuarto);
							$capacidad= Capacity($cuarto,$arrayAdults[$n_rooms],$arrayKids[$n_rooms]);
							$kidsAllow = KidsAllow($cuarto,$arrayKids[$n_rooms]);
							array_push($listAllotment,$allotment);
							array_push($listCapacidad, $capacidad);
							array_push($listKidsAllow, $kidsAllow);

							$tarifas = Tarifas($cuarto,$arrayAdults[$n_rooms],$arrayKids[$n_rooms]);
							$tarifasPromo = TarifasPromo($cuarto,$arrayAdults[$n_rooms],$arrayKids[$n_rooms]);
							foreach ($tarifas as $tarifa) {
								$total = $total+$tarifa;
							}
							if ($tarifasPromo==0) {
								$promo = 0;
							}else{

								foreach ($tarifasPromo as $tarifaPromo) {
									$promo = $promo +$tarifaPromo;
								}
							}
							

							$n_rooms++;
						}

						if($_COOKIE['lang'] == "en"){
							$price = $total;
							$pricePromo = $promo;
							$clubestrella = PrecioClubestrella($price);
						}
						else{

							//$mexicanPesos = $hotelController->getPesos($total);
							$price = Pesos($total);
							$pricePromo = Pesos($promo);
							$clubestrella = PrecioClubestrella($price);
						}

						foreach ($listCapacidad as $capacidad) {
							if ($capacidad == 1) {
								break;
							}
						}
						foreach ($listAllotment as $allotment) {
							if ($allotment==1) {
								break;
							}
						}
						foreach ($listKidsAllow as $kidsAllow) {
							if ($kidsAllow==1) {
								break;
							}
						}

						$cuarto->setAdults($adults);
						$cuarto->setKids($kids);
						$cuarto->setAlotVerify($allotment);
						$cuarto->setCapacidadVerify($capacidad);
						$cuarto->setKidsVerify($kidsAllow);

						//checar si las fechas aceptan pago en destino
						$cuarto->setPagoDestino(PagoEnDestino($cuarto));
						//Checar si el cuarto tiene stopSales
						$cuarto->getStopSale(stop_sale($cuarto));
						//poner los precios en dolares
						$cuarto->setPromo($pricePromo);
						$cuarto->setPrice($price);
						$cuarto->setClubEstrella($clubestrella);

						array_push($lista, $cuarto);
					}
						
				}


			}

			return $lista;
			
		} catch (Exception $e) {

			echo "error al obtner los cuartos";
			print_r($e);
			
		}
	}

	function getRoom($idRoom,$fechaEntrada,$fechaSalida,$rooms,$arrayAdults,$arrayKids){

		try {

			$dateI = explode('-', $fechaEntrada);
			$dateF = explode('-', $fechaSalida);
			$date1 = $dateI[0]."-".$dateI[1]."-".$dateI[2];
			$date2 = $dateF[0]."-".$dateF[1]."-".$dateF[2];
			$startDate = date_create($date1);
			$endDate = date_create($date2);
			$diff = date_diff($startDate,$endDate);
		 	$noches = $diff->format("%a");
			$lista = array();
			$idHotel = 1;
			$db = new db();
			$conn = $db->connection();
				
			$query = "SELECT * FROM rooms WHERE isDeleted=0 and idHotel = ? AND id = ? ORDER BY priority DESC";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->bindParam(2,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$filas = $stmt->fetch(PDO:: FETCH_ASSOC);

				$cuarto = new cuarto();
				$cuarto->setIdr($filas['id']);
				$cuarto->setIdh($filas['idHotel']);
				$cuarto->setNombre($filas['nombre']);
				$cuarto->setName($filas['nombre_en']);
				$cuarto->setCapacidad($filas['capMax']);
				$cuarto->setTipo($filas['type']);
				$cuarto->setCategoria($filas['category']);
				$cuarto->setPrioridad($filas['priority']);
				$cuarto->setAlotment($filas['quantity']);
				$cuarto->setKidsAllow($filas['kidsAllow']);
				$cuarto->setFechaEntrada($date1);
				$cuarto->setFechaSalida($date2);
				$cuarto->setNoches($noches);

				$n_rooms = 0;
				$total = 0;
				$price = 0;
				$promo = 0;
				$pricePromo = 0;
				$listAllotment = array();
				$listCapacidad = array();
				$listKidsAllow = array();
				$adults = 0;
				$kids = 0;

				while ($n_rooms < $rooms) {

					$adults += $arrayAdults[$n_rooms];
					$kids += $arrayKids[$n_rooms];

					$allotment = Allotment($cuarto);
					$capacidad= Capacity($cuarto,$arrayAdults[$n_rooms],$arrayKids[$n_rooms]);
					$kidsAllow = KidsAllow($cuarto,$arrayKids[$n_rooms]);
					array_push($listAllotment,$allotment);
					array_push($listCapacidad, $capacidad);
					array_push($listKidsAllow, $kidsAllow);

					$tarifas = Tarifas($cuarto,$arrayAdults[$n_rooms],$arrayKids[$n_rooms]);
					$tarifasPromo = TarifasPromo($cuarto,$arrayAdults[$n_rooms],$arrayKids[$n_rooms]);
					foreach ($tarifas as $tarifa) {
						$total = $total+$tarifa;
					}
					if ($tarifasPromo==0) {
						$promo = 0;
					}else{

						foreach ($tarifasPromo as $tarifaPromo) {
							$promo = $promo +$tarifaPromo;
						}
					}
					

					$n_rooms++;
				}

				if($_COOKIE['lang'] == "en"){
					$price = $total;
					$pricePromo = $promo;
					$clubestrella = PrecioClubestrella($price);
				}
				else{

					//$mexicanPesos = $hotelController->getPesos($total);
					$price = Pesos($total);
					$pricePromo = Pesos($promo);
					$clubestrella = PrecioClubestrella($price);
				}

				foreach ($listCapacidad as $capacidad) {
					if ($capacidad == 1) {
						break;
					}
				}
				foreach ($listAllotment as $allotment) {
					if ($allotment==1) {
						break;
					}
				}
				foreach ($listKidsAllow as $kidsAllow) {
					if ($kidsAllow==1) {
						break;
					}
				}

				$cuarto->setAdults($adults);
				$cuarto->setKids($kids);
				$cuarto->setAlotVerify($allotment);
				$cuarto->setCapacidadVerify($capacidad);
				$cuarto->setKidsVerify($kidsAllow);

				//checar si las fechas aceptan pago en destino
				$cuarto->setPagoDestino(PagoEnDestino($cuarto));
				//Checar si el cuarto tiene stopSales
				$cuarto->getStopSale(stop_sale($cuarto));
				//poner los precios en dolares
				$cuarto->setPromo($pricePromo);
				$cuarto->setPrice($price);
				$cuarto->setClubEstrella($clubestrella);
	
			}

			return $cuarto;
			
		} catch (Exception $e) {

			echo "error al obtner los cuartos";
			print_r($e);
			
		}
	}
	

	function formatCoin($amount){
		$amount = number_format($amount, 2, '.', ',');
		return $amount;
	}
	function convertDate($date){
		$date = explode('-', $date);
		$dateFormat = $date[0]."-".$date[1]."-".$date[2];
		return $dateFormat;
	}
	//Se obtiene de una fecha el dia en texto español
	function convertDay($date,$lang){
		//Este es el formato de fecha para esta funcion DD-MM-AAAA
		//Se convierte el formato a AAAAMMDD
		$date = explode('-', $date);
		$dateFormat = $date[0]."-".$date[1]."-".$date[2];
		if($lang == "es"){
			$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
		}
		else{
			$dias = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");	
		}
		//Se obtien el dia en numero domingo es 0 y sabdo es 6
		$day = date('w', strtotime($dateFormat));
		//Con el numero de dia se obtiene del array el dia en texto español
		$dia = $dias[date($day)];
		return $dia;
	}
	//Se obtiene el de una fecha el mes en texto español
	function getMonth($date,$lang){
		//Este es el formato de fecha para esta funcion DD-MM-AAAA
		//Se convierte el formato a AAAAMMDD
		$date = explode('-', $date);
		$dateFormat = $date[0].$date[1].$date[2];
		if($lang == "es"){
			$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
		}
		else{
			$meses = array("January", "February", "March", "April", "May", "June", "Julie", "August", "September", "October", "November", "Dicember");	
		}
		//Se obtien el mes en numero enro es 1 y Diciembre es 12
		$mon = date('n', strtotime($dateFormat));
		//Se le resta uno por que el  array de meses comienza con 0 y la funcion date n empiza con 1
		$mon = $mon - 1;
		//Con el numero de mes se obtiene del array el mes en texto español
		$mes = $meses[date($mon)];
		return $mes;
	}
	function getNumberDay($date){
		$date = explode('-', $date);
		$numberDay = $date[2];
		return $numberDay;
	}
	function getYear($date){
		$date = explode('-', $date);
		$numberYear = $date[0];
		return $numberYear;
	}
	function getNights($startDate, $endDate){
		$date = explode('-', $startDate);
		$startDate = $date[0]."-".$date[1]."-".$date[2];
		$date = explode('-', $endDate);
		$endDate = $date[0]."-".$date[1]."-".$date[2];
		$startDate = date_create($startDate);
		$endDate = date_create($endDate);
		$diff = date_diff($startDate,$endDate);
	 	$noches = $diff->format("%a");
	 	return $noches;
	}

	function getCategoria($typePlan){
		switch ($typePlan) {
			case '1':
				$plan = "Habitación Estandar";
				break;
			case '2':
				$plan = "Habitación Superior";
				break;
			case '3': 
				$plan = "Habitación Ejecutivo";
				break;
			default:
				$plan = "Habitación Estandar";
				break;
		}
		return $plan;
	}

	function Precioestrella($tarifa,$id){

		try {

			$db = new db();
			$conn = $db->connection();
			$query = "SELECT descuento from rooms WHERE id_room = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$descuento = $row["descuento"];
				$porcentaje = $descuento/100;
				$clubestrella = $tarifa - ($porcentaje*$tarifa);
				$conn = null;
				return $clubestrella;
			}
			
		} catch (Exception $e) {
			
			echo "error al calcular el descuento clubestrella";
			print_r($e);
		}

		return false;
	}

	function PuntosPesos($puntos){

		if ($puntos != 0) {

			$cashpoints = $puntos * 0.035;

		}
		else
			$cashpoints = 0;


		return $cashpoints;
	}

	function saldadoManual($cashpoints,$tarifaTotal){

		$result = $tarifaTotal - $cashpoints;
		return $result;

	}

	function QuitarPuntos($cashpoints,$tarifaTotal){

		$result = $cashpoints - $tarifaTotal;
		$quitarPuntos = round($result/0.035);

		return $quitarPuntos;

	}

	// FUNCIONES ESPECIFICAS CON EL ID DEL CUARTO

	function getSeasonId($fechaEntrada,$idHotel,$idRoom){
		try {
			
			$dateI = explode('-', $fechaEntrada);
			$date1 = $dateI[2]."-".$dateI[1]."-".$dateI[0];
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM  seasons  WHERE borrado = 0 AND '$date1' BETWEEN startdate AND enddate AND id_hot=? AND id_room = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idHotel);
			$stmt->bindParam(2,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$rows = $stmt->fetchAll(PDO:: FETCH_ASSOC);
				$lista = array();
				foreach ($rows as $row) {

					$season = new season();
					$season->setIdRoom($row['id_room']);
					$season->setPlantype($row['plantype']);
					$season->setTarifaMenor($row['aplica_tarifa_menor']);
					array_push($lista, $season);
				}

				return $lista;
			}

		} catch (Exception $e) {
			
		}
	}

	

	

	function getGrupos($code,$startDate,$endDate,$idHotel){
		try {
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM grupos WHERE codigo = ? AND ? BETWEEN startDate AND endDate AND ? BETWEEN startDate AND endDate AND hotel = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$code);
			$stmt->bindParam(2,$startDate);
			$stmt->bindParam(3,$endDate);
			$stmt->bindParam(4,$idHotel);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$grupo = new grupo();
				$grupo->setId($row['id']);
				$grupo->setCodigo($row['codigo']);
				$grupo->setStartDate($row['startDate']);
				$grupo->setEndDate($row['endDate']);
				$grupo->setNombre($row['nombre_grupo']);
				$grupo->setHotel($row['hotel']);
				$grupo->setHabitacion($row['habitacion']);
				$grupo->setSingle($row['single']);
				$grupo->setDouble($row['doble']);
				$grupo->setTriple($row['triple']);
				$grupo->setCuadra($row['cuadra']);
				$grupo->setExtra($row['extra']);
				$grupo->setMealAdult($row['meal_adult']);
				$grupo->setMealKid($row['meal_kid']);

				$conn = null;

				return $grupo;
			}
		} catch (Exception $e) {
			echo "Error al obtener información del grupo <br>";
			print_r($e);
		}
	}

	function getGrupostarifa($code,$startDate,$endDate,$idHotel,$adults,$kids){
		try {

			$normalPricePerNight = array();
			$totalPerNight = 0;
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM grupos WHERE codigo = ? AND ? BETWEEN startDate AND endDate AND ? BETWEEN startDate AND endDate AND hotel = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$code);
			$stmt->bindParam(2,$startDate);
			$stmt->bindParam(3,$endDate);
			$stmt->bindParam(4,$idHotel);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				/*$grupo = new grupo();
				$grupo->setId($row['id']);
				$grupo->setCodigo($row['codigo']);
				$grupo->setStartDate($row['startDate']);
				$grupo->setEndDate($row['endDate']);
				$grupo->setNombre($row['nombre_grupo']);
				$grupo->setHotel($row['hotel']);
				$grupo->setHabitacion($row['habitacion']);
				$grupo->setSingle($row['single']);
				$grupo->setDouble($row['doble']);
				$grupo->setTriple($row['triple']);
				$grupo->setCuadra($row['cuadra']);
				$grupo->setExtra($row['extra']);
				$grupo->setMealAdult($row['meal_adult']);
				$grupo->setMealKid($row['meal_kid']);			*/

				switch ($adults) {
					case 1:

						/*if ($cuarto->getIdr()==2) {
							$totalPerNight = $row["single"];
							$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
						}
						else*/
						$totalPerNight = $row["single"] + ($row['mealKids'] * $kids);
						
						array_push($normalPricePerNight, $totalPerNight);
						break;
					case 2:

						
						/*if ($cuarto->getIdr()==2) {
							$totalPerNight = $row["doble"];
							$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
						}
						else*/
							$totalPerNight = $row["doble"] + ($row['mealKids'] * $kids);
						
						array_push($normalPricePerNight, $totalPerNight);
						break;
					case 3:

						/*if ($cuarto->getIdr()==2) {
							$totalPerNight = $row["triple"];
							$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);							
						}

						else*/
							$totalPerNight = $row["triple"] + ($row['mealKids'] * $kids);	

						array_push($normalPricePerNight, $totalPerNight);
						break;
					case 4:

						/*if ($cuarto->getIdr()==2) {
							$totalPerNight = $row["cuadra"];
							$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
						}

						else*/
							$totalPerNight = $row["cuadra"] + ($row['mealKids'] * $kids);

						array_push($normalPricePerNight, $totalPerNight);
						break;
				}// fin del switch

				$conn = null;

				return $normalPricePerNight;
			}
		} catch (Exception $e) {
			echo "Error al obtener información del grupo <br>";
			print_r($e);
		}
	}

	function setReserve($nombre,$apellidos,$email,$telefono,$pais,$ciudad,$comentarios,$isClub,$total,$costoProv,$currency,$metodoPago,$estatus,$dateTo,$dateFrom,$idRoom,$detalles,$servicio,$nombreHotel,$isDeleted,$service){
		//echo $dateTo." ".$dateFrom;
		try {

			$dateTransaction = date("Y-m-d H:i:s");
			$db = new db();
			$conn = $db->connection();
			$query = "INSERT INTO huespedes (nombre,apellido,correo,telefono,pais,ciudad,comments,isClub) VALUES (?,?,?,?,?,?,?,?);";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$nombre);
			$stmt->bindParam(2,$apellidos);
			$stmt->bindParam(3,$email);
			$stmt->bindParam(4,$telefono);
			$stmt->bindParam(5,$pais);
			$stmt->bindParam(6,$ciudad);
			$stmt->bindParam(7,$comentarios);
			$stmt->bindParam(8,$isClub);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$lastId = $conn->lastInsertId();
				$conn2 = $db->connection();
				$query2 = "INSERT INTO transactions (id,price,costoProv,currency,formaPago,cardType,estatus,dateTransaction) VALUES (?,?,?,?,?,?,?,?);";
				$stmt2 = $conn2->prepare($query2);
				$stmt2->bindParam(1,$lastId);
				$stmt2->bindParam(2,$total);
				$stmt2->bindParam(3,$costoProv);
				$stmt2->bindParam(4,$currency);
				$stmt2->bindParam(5,$metodoPago);
				$stmt2->bindParam(6,$metodoPago);
				$stmt2->bindParam(7,$estatus);
				$stmt2->bindParam(8,$dateTransaction);
				$stmt2->execute();
				$count2 = $stmt2->rowCount();
				if ($count2 > 0) {
					
					$idLast = $conn2->lastInsertId();
					$responsable ="admin@admin.com";
					$conn3 = $db->connection();
					$query3 = "INSERT INTO reservations (id,idClient,idTransaction,dateFrom,dateTo,idRoom,detalles,responsable,notas,servicio,hotel,isDeleted,service_type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$stmt3 = $conn3->prepare($query3);
					$stmt3->bindParam(1,$lastId);
					$stmt3->bindParam(2,$lastId);
					$stmt3->bindParam(3,$idLast);
					$stmt3->bindParam(4,$dateTo);
					$stmt3->bindParam(5,$dateFrom);
					$stmt3->bindParam(6,$idRoom);
					$stmt3->bindParam(7,$detalles);
					$stmt3->bindParam(8,$responsable);
					$stmt3->bindParam(9,$comentarios);
					$stmt3->bindParam(10,$servicio);
					$stmt3->bindParam(11,$nombreHotel);
					$stmt3->bindParam(12,$isDeleted);
					$stmt3->bindParam(13,$service);
					$stmt3->execute();
					$count3 = $stmt3->rowCount();
					if ($count3 > 0) {

						$idReserve = $conn3->lastInsertId();
						$conn4 = $db->connection();
						$query4 = "INSERT INTO roomreserva (id,room_reserva,idRoom) VALUES (?,?,?);";
						$stmt4 = $conn4->prepare($query4);
						$stmt4->bindParam(1,$lastId);
						$stmt4->bindParam(2,$lastId);
						$stmt4->bindParam(3,$idRoom);
						$stmt4->execute();
						$count4 = $stmt4->rowCount();
						if ($count4 > 0) {
							
							return $lastId;
						}
						else{
							return "Error al registrar roomreserva.";
						}
					}
					else{
						return "Error al registrar la reservacion.";
					}
				}
				else{
					return "Error al registrar la transaccion.";
				}
			}
			else{

				return "Error al registrar al huesped.";
			}

		} catch (Exception $e) {

			echo "Error al poner la reserva en el panel. <br>".$e;
			//print_r($e);
		}
	}

	function updateAllotment($idRoom){
		try {
			
			$db = new db();
			$conn = $db->conn_remote();
			$query = "SELECT quantity FROM rooms WHERE id = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0){

				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$quantity = $row['quantity'];
				$allotment = $quantity -1;

				$query = "UPDATE rooms SET quantity = ? WHERE id = ?;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$allotment);
				$stmt->bindParam(2,$idRoom);
				$stmt->execute();
				$count2 = $stmt->rowCount();
				if ($count2 > 0) {
					
					$query2 = "SELECT quantity FROM rooms WHERE id = ?;";
					$stmt2 = $conn->prepare($query2);
					$stmt2->bindParam(1,$idRoom);
					$stmt2->execute();
					$count3 = $stmt->rowCount();
					if($count3 > 0){

						$row = $stmt2->fetch(PDO::FETCH_ASSOC);
						if($row['quantity'] == 0){

							return 0;//Cuando el cuarto llego a 0 hay que mandar mail
						}
						else{
							return 1;//Todavia tenemos cuartos disponibles
						}
					}
				}
			}

		} catch (Exception $e) {
			echo "Error al actualizar el alotment.";
			print_r($e);
		}
	}

	function checkAllotment($idRoom){
		try {
			
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT quantity FROM rooms WHERE id = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0){

				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$capacity = $row['quantity'];

				if($capacity == 0){

					return 0;//Cuartos agotados
				}
				else{
					return 1;//Cuartos disponibles
				}

			}

		} catch (Exception $e) {
			
		}
	}

	function getName($idRoom){

		try {

			$db = new db();
			$conn = $db->connection();
			$query = "SELECT nombre FROM rooms WHERE id = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$idRoom);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0){
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				return $row['nombre'];
			}
			else{
				return "Error";
			}
			
		} catch (Exception $e) {
			
			echo "Error al obtener el nombre del cuarto  con Id: ".$idRoom."\n".$e;
		}

	}

	function type_service($service,$isActive){

		if($service == "web" && $isActive == 1 )
			return $result = 0;//Pagina Web

		if($service == "club" && $isActive == 1)
			return $result = 1;//Club Estrella

		if($service == "group" && $isActive ==  1)
			return $result = 2;//Grupos

		if($service == "special" && $isActive == 1)
			return $result = 3;//Special Rates
	}

}

	function Allotment($cuarto){

		try {
			//optimizar con consulta al servidor
			$flag = 0;
			if ($cuarto->getAlotment() > 0) {
				$flag= 0;
			}
			else
				$flag = 1;

			return $flag;

		} catch (Exception $e) {
			echo "Error al evaluar el Allotment de cuarto ".$cuarto->getIdr()."<br>";
			print_r($e);
		}
	}

	function Capacity($cuarto,$adultos,$niños){

		try {
				
			$flag = 0;
			$totalPeopleInRoom = $adultos+$niños;

			if($totalPeopleInRoom <= $cuarto->getCapacidad()){
				$flag = 0;
			}
			else
				$flag =1;

			return $flag;

		} catch (Exception $e) {
			
			echo "Error al calcular la capacidad del cuarto <br>";
			print_r($e);
		}

	}

	function KidsAllow($cuarto,$kids){
		try {
			
			if($cuarto->getKidsAllow()==0 && $kids != 0){

				$kidsAllow = 1; // no mostrar cuarto

			}
			else{
				$kidsAllow =0;// mostrar cuarto
			}

			return $kidsAllow;

		} catch (Exception $e) {
			echo "Error con KidsAllow";
			print_r($e);
		}
	}

	function Tarifas($cuarto,$adults,$kids){

		try {

			$totalPeopleInRoom = $adults;
			$date = $cuarto->getFechaEntrada();
			$contNight = 0;
			$normalPricePerNight = array();
			$db = new db();
			$conn = $db->connection();

			if($cuarto->getNoches() == 1){

				$idHotel = $cuarto->getIdh();
				$idRoom = $cuarto->getIdr();
				$query = "SELECT * FROM seasons WHERE idHotel=?  AND idRoom= ? AND isDeleted=0 AND '$date' BETWEEN startDate AND endDate;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$idHotel);
				$stmt->bindParam(2,$idRoom);
				$stmt->execute();
				$count = $stmt->rowCount();
				if ($count > 0) {

					$row = $stmt->fetch(PDO:: FETCH_ASSOC);

					switch ($totalPeopleInRoom) {
						case 1:

							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["single"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
							}
							else
								$totalPerNight = $row["single"];
							
							array_push($normalPricePerNight, $totalPerNight);
							break;
						case 2:

							
							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["doble"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
							}
							else
								$totalPerNight = $row["doble"];
							
							array_push($normalPricePerNight, $totalPerNight);
							break;
						case 3:

							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["triple"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);							
							}

							else
								$totalPerNight = $row["triple"];	

							array_push($normalPricePerNight, $totalPerNight);
							break;
						case 4:

							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["cuadra"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
							}

							else
								$totalPerNight = $row["cuadra"];

							array_push($normalPricePerNight, $totalPerNight);
							break;
					}// fin del switch
					$conn = null;;
					return $normalPricePerNight;

				}

			}//fin del if
			else{

				while ($contNight < $cuarto->getNoches()) {

					$idHotel = $cuarto->getIdh();
					$idRoom = $cuarto->getIdr();
					$noches = date("Y-m-d", strtotime("$date + $contNight days"));
					$query = "SELECT * FROM seasons WHERE idHotel=?  AND idRoom= ? AND isDeleted=0 AND '$noches' BETWEEN startDate AND endDate;";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1,$idHotel);
					$stmt->bindParam(2,$idRoom);
					$stmt->execute();
					$count = $stmt->rowCount();
					if ($count > 0) {

						$row = $stmt->fetch(PDO:: FETCH_ASSOC);
						switch ($totalPeopleInRoom) {
							case 1:

								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["single"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
								}
								else
									$totalPerNight = $row["single"];
								
								array_push($normalPricePerNight, $totalPerNight);
								break;
							case 2:

								
								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["doble"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
								}
								else
									$totalPerNight = $row["doble"];
								
								array_push($normalPricePerNight, $totalPerNight);
								break;
							case 3:

								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["triple"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);							
								}

								else
									$totalPerNight = $row["triple"];	

								array_push($normalPricePerNight, $totalPerNight);
								break;
							case 4:

								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["cuadra"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
								}

								else
									$totalPerNight = $row["cuadra"];

								array_push($normalPricePerNight, $totalPerNight);
								break;
						}// fin del switch

					}
					$contNight++;
				}// fin del while
				$conn = null;
				return $normalPricePerNight;
				
			}// fin del else


		} catch (Exception $e) {

			echo "error al conseguir tarifa del cuarto";
			print_r($e);
			
		}

		return false;

	}//fin getTarifas

	function TarifasPromo($cuarto,$adults,$kids){

		try {

			$totalPeopleInRoom = $adults;
			$date = $cuarto->getFechaEntrada();
			$contNight = 0;
			$seed = 0;
			$normalPricePerNight = array();
			$db = new db();
			$conn = $db->connection();

			if($cuarto->getNoches() == 1){

				$idHotel = $cuarto->getIdh();
				$idRoom = $cuarto->getIdr();
				$query = "SELECT * FROM seasonspromo WHERE idHotel=?  AND idRoom= ? AND isDeleted=0 AND '$date' BETWEEN startDate AND endDate;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$idHotel);
				$stmt->bindParam(2,$idRoom);
				$stmt->execute();
				$count = $stmt->rowCount();
				if ($count > 0) {

					$row = $stmt->fetch(PDO:: FETCH_ASSOC);

					switch ($totalPeopleInRoom) {
						case 1:

							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["single"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
							}
							else
								$totalPerNight = $row["single"];
							
							array_push($normalPricePerNight, $totalPerNight);
							break;
						case 2:

							
							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["doble"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
							}
							else
								$totalPerNight = $row["doble"];
							
							array_push($normalPricePerNight, $totalPerNight);
							break;
						case 3:

							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["triple"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);							
							}

							else
								$totalPerNight = $row["triple"];	

							array_push($normalPricePerNight, $totalPerNight);
							break;
						case 4:

							if ($cuarto->getIdr()==2) {
								$totalPerNight = $row["cuadra"];
								$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
							}

							else
								$totalPerNight = $row["cuadra"];

							array_push($normalPricePerNight, $totalPerNight);
							break;
					}// fin del switch
					$conn = null;;
					return $normalPricePerNight;

				}
				else
					return $seed;

			}//fin del if
			else{

				while ($contNight < $cuarto->getNoches()) {

					$idHotel = $cuarto->getIdh();
					$idRoom = $cuarto->getIdr();
					$noches = date("Y-m-d", strtotime("$date + $contNight days"));
					$query = "SELECT * FROM seasonspromo WHERE idHotel=?  AND idRoom= ? AND isDeleted=0 AND '$noches' BETWEEN startDate AND endDate;";
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1,$idHotel);
					$stmt->bindParam(2,$idRoom);
					$stmt->execute();
					$count = $stmt->rowCount();
					if ($count > 0) {

						$row = $stmt->fetch(PDO:: FETCH_ASSOC);
						switch ($totalPeopleInRoom) {
							case 1:

								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["single"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
								}
								else
									$totalPerNight = $row["single"];
								
								array_push($normalPricePerNight, $totalPerNight);
								break;
							case 2:

								
								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["doble"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
								}
								else
									$totalPerNight = $row["doble"];
								
								array_push($normalPricePerNight, $totalPerNight);
								break;
							case 3:

								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["triple"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);							
								}

								else
									$totalPerNight = $row["triple"];	

								array_push($normalPricePerNight, $totalPerNight);
								break;
							case 4:

								if ($cuarto->getIdr()==2) {
									$totalPerNight = $row["cuadra"];
									$totalPerNight = $totalPerNight + ($row['mealKids'] * $kids);
								}

								else
									$totalPerNight = $row["cuadra"];

								array_push($normalPricePerNight, $totalPerNight);
								break;
						}// fin del switch

					}
					else{

						return $seed;
						break;
					}
					$contNight++;
				}// fin del while
				$conn = null;
				return $normalPricePerNight;
				
			}// fin del else


		} catch (Exception $e) {

			echo "error al conseguir tarifa del cuarto";
			print_r($e);
			
		}

		return false;

	}//fin getTarifasPromo

	function PagoEnDestino($cuarto){

		try {

			$flag = 0;
			$checkin = $cuarto->getFechaEntrada();
			$checkout = $cuarto->getFechaSalida();
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM pagodestino WHERE isDeleted = 0 AND ? BETWEEN startDate AND endDate OR ? BETWEEN startDate AND endDate";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$checkin);
			$stmt->bindParam(2,$checkout);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {

				$flag = 1; // no se puede pago en destino
			}
			else{
				$flag = 0; //si se puede pago destino
			}

			$conn = null;
			return $flag;
			
		} catch (Exception $e) {

			echo "Error al checar pago en destino del cuarto: ".$cuarto->getNombre()."<br>";
			print_r($e);

			
		}

		return false;

	}

	function stop_sale($cuarto){

		try {

			$flag = 0;
			$db = new db();
			$conn = $db->connection();
			$contNight = 0;
			$date = $cuarto->getFechaEntrada();
			while ($contNight < $cuarto->getNoches()) {

				$idRoom = $cuarto->getIdr();
				$noches = date("Y-m-d", strtotime("$date + $contNight days"));		
				$query = "SELECT * FROM stopsale WHERE idRoom = ?  AND ? BETWEEN startDate AND endDate AND isDeleted= 0;";
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$idRoom);
				$stmt->bindParam(2,$noches);
				$stmt->execute();
				$count = $stmt->rowCount();
				if ($count > 0) {
					# code...
					$flag = $noches;
					break;
				}
				else{

					$flag = 0;
				}

				/*while( $count > 0 ){
					$flag = 1;
				}*/
				$contNight++;
			}

			$conn = null;
			return $flag;
			
		} catch (Exception $e) {

			echo "error al sacar stopsales";
			print_r($e);
			
		}
		return false;

	}

	function PrecioClubestrella($amount){
		try {
			
			$clubestrella = 0;
			$handle = 0;
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT porcentaje FROM porcentajeClub;";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$handle = ($amount * $row['porcentaje'])/100;
				$clubestrella = $amount - $handle;
				return $clubestrella;

			}
			else
				return $clubestrella;

		} catch (Exception $e) {
			echo "Error al obtener precio clubestrella <br>";
			print_r($e);
		}
	}

	function Pesos($amount){

		try {

			$pesos=0;
			$db = new db();
			$conn = $db->connection();
			$query = "SELECT * FROM dolarvalue;";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {
				
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$pesos = $row['dolar']*$amount;

				return $pesos;
			}
			else{
				return $pesos;
			}
		} catch (Exception $e) {
			
			echo "Error al convertir dolares a pesos <br>";
			print_r($e);
		}
	}


?>