<?php
class clubestrellaController{
	
	function PuntosPesos($puntos){

		if ($puntos != 0) {

			if ($GLOBALS['lang'] == "es") {
				$cashpoints = $puntos * 0.035;
			}
			else if($GLOBALS['lang'] == "en"){
				$cashpoints = $puntos * 0.0018;
			}
			

		}
		else
			$cashpoints = 0;


		return $cashpoints;
	}

	function showEstrella($tarifaNormal,$tarifaOktrip){

		$result = $tarifaOktrip - $tarifaNormal;
		$porcentaje = ($result/$tarifaNormal)*100;
		$precioClub = 0;

		if ($porcentaje >= 25) {
			$precioClub = round(($tarifaNormal/0.85), 2);
		}
		else
			$precioClub = 0;

		return $precioClub;
	}
}


if (isset($_POST['tarifa']) && isset($_POST['clubestrella']) && isset($_POST['idioma'])){

	if ($_POST['tarifa'] > $_POST['clubestrella']) {
		
		echo 0;
	}
	else{
		echo saldado($_POST['tarifa'],$_POST['idioma']);
	}	
}

function saldado($amount,$idioma){

	if ($idioma == 0) {
		# code...
		$puntos = round ($amount/0.035);
	}
	else if($idioma == 1){
		$puntos = round ($amount/0.0018);
	}
	
	return $puntos;
		
}

if (isset($_POST['cashpoints']) && isset($_POST['clubestrella']) && isset($_POST['idioma'])) {

	echo PuntosPesos($_POST['cashpoints'],$_POST['clubestrella'],$_POST['idioma']);
}

function PuntosPesos($puntos,$clubestrella,$idioma){

	if ($puntos != 0) {

		// si es español
		if ($idioma == 0) { 
			$cashpoints = $puntos * 0.035;
		}
		// si es ingles
		else if($idioma == 1){ 
			$cashpoints = $puntos * 0.0018;
		}
		
		if ($cashpoints > $clubestrella) {
			# code...
			$cashpoints=0;
		}
		
	}
	else
		$cashpoints = 0;

	return $cashpoints;
}


if (isset($_POST['convertpoints']) && isset($_POST['total'])) {
	echo saldadoManual($_POST['total'],$_POST['convertpoints']);
}

function saldadoManual($tarifaTotal,$cashpoints){

	$result = $tarifaTotal - $cashpoints;
	return $result;

}

?>