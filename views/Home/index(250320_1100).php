<?php 
$mapa = new CitiesController();
$coordenadas = $mapa->getLocations();
$mapaInfo = array();
foreach ($coordenadas as $coordenada) {
	array_push($mapaInfo, 
		array(
			'id' => $coordenada->getId(),
			'nombre' => $coordenada->getNombre(),
			'pais' => $coordenada->getPais(),
			'latitud' =>$coordenada->getLatitud(),
			'longitud' =>$coordenada->getLongitud()
		)
	);
}
?>
<!DOCTYPE html> 
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	 <meta name="description" content="<?php echo $GLOBALS['_ok_description']; ?> ">
     <meta name="author" content="<?php echo $GLOBALS['_ok_author']; ?> ">
     <meta name="keywords" content="<?php echo $GLOBALS['_ok_keywords']; ?> ">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>

</head>
<body id="home">
	<?php include("views/partialViews/_header.php"); ?>
	<?php include("views/partialViews/_redesSociales.php"); ?>
	<div class="container-fluid banner">
		<div class="owl-carousel owl-theme hidden-xs" id="new_banner">
		    <div class="item"><img src="/img/new_items/banner_1.png" alt=""></div>
		    <div class="item"><img src="/img/new_items/banner_2.png" alt=""></div>
		    <div class="item"><img src="/img/new_items/banner_3.png" alt=""></div>
		</div>

		<div class="owl-carousel owl-theme visible-xs" id="new_banner_mob">
		    <div class="item"><img src="/img/new_items/mob.png" class="img-responsive" alt=""></div>
		    <div class="item"><img src="/img/new_items/mob_2.png" class="img-responsive" alt=""></div>
		    <div class="item"><img src="/img/new_items/mob_3.png" class="img-responsive" alt=""></div>
		</div>
		<div class="row" id="cont_search">
			<?php include("views/partialViews/_searcher.php"); ?>
		</div>
	</div>

	<div class="container"  style="z-index: 30;position: relative;">
		<div class="row" style="margin-bottom: 25px;">
			<!-- <div class="col-xs-12 col-sm-6 col-md-6">
				<a href="#" target="_blank"><img src="img/new_items/cupon_traslados.png" alt="Tour" class="img-responsive"></a>
			</div> -->
			<div class="col-xs-12 col-sm-6 col-md-6">
				<a href="<?php echo $GLOBALS['Home_url_oaxaca']; ?>" target="_blank"><img src="img/new_items/cupon_oaxaca.png" alt="Adhara" class="img-responsive"></a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<a href="#" target="_blank"><img src="img/new_items/cupon_contoy.png" alt="Adhara" class="img-responsive" style="margin-top: 15px;"></a>
			</div>
			<!-- <div class="col-xs-12 col-sm-6 col-md-6">
				<a href="#" target="_blank"><img src="img/new_items/cupon_canada.png" alt="Canada" class="img-responsive" style="margin-top: 15px;"></a>
			</div> -->
		</div>
		<div class="row" style="margin-bottom: 40px;">
			<div class="col-items-icons">
				<!--Alcancía -->
				<div class="row">
					<div class="col-md-6">

						<div class="col-md-12">
							<div class="row">
								<div class="col-sm-3 col-sm-12 icon">
									<img class="img-responsive" src="/img/iconos/alcancia.svg" alt="">

								</div>
								<div class="col-sm-9 col-sm-12 middle-vertical">
									<div class="txt-l">
										<?php
										echo $GLOBALS['Home_warranty_piggy_label_1'];

										?>
									</div>
									<div class="txt-sm">
										<?php
										echo $GLOBALS['Home_warranty_piggy_label_2'];
										?>
									</div>
								</div>
							</div>
							<!-- Tarifas -->
							<div class="row">
								<div class="col-sm-3 col-sm-12 icon">
									<img class="img-responsive" src="/img/iconos/hotel.svg" alt="">
								</div>
								<div class="col-sm-9 col-sm-12 middle-vertical">
									<div class="txt-l">
										<?php
										echo $GLOBALS['Home_warranty_hotel_label_1'];
										?>
									</div>
									<div class="txt-sm">
										<?php
										echo $GLOBALS['Home_warranty_hotel_label_2'];
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<!-- sin-cargos -->
							<div class="row">
								<div class="col-sm-3 col-sm-12 icon">
									<img class="img-responsive" src="/img/iconos/lupa.svg" alt="">
								</div>
								<div class="col-sm-9 col-sm-12 middle-vertical">
									<div class="txt-l">
										<?php
										echo $GLOBALS['Home_warranty_no-feels_label_2'];
										?>
									</div>
									<div class="txt-sm">
										<?php
										echo $GLOBALS['Home_warranty_no-feels_label_2'];
										?>
									</div>
								</div>
							</div>
							<!-- Secure -->
							<div class="row">
								<div class="col-sm-3 col-sm-12 icon">
									<img class="img-responsive" src="/img/new_items/shield.png" id="Shield" alt="">
								</div>
								<div class="col-sm-9 col-sm-12 middle-vertical">
									<div class="txt-l">
										<?php
											echo $GLOBALS['Home_warranty_secure_label_1'];
										?>
									</div>
									<div class="txt-sm">
										<?php
											echo $GLOBALS['Home_warranty_secure_label_2'];
										?>
									</div>
								</div>
							</div>
							<!-- Confirmacion -->
							<div class="row">
								<div class="col-sm-3 col-sm-12 icon">
									<img class="img-responsive" src="/img/new_items/safe.png" id="Safe" alt="">
								</div>
								<div class="col-sm-9 col-sm-12 middle-vertical">
									<div class="txt-l">
										<?php
											echo $GLOBALS['Home_warranty_confirm_label_1'];
										?>
									</div>
									<div class="txt-sm">
										<p style="margin-bottom: 0px;">
											<?php
												echo $GLOBALS['Home_warranty_confirm_label_2'];
											?>
										</p>
										<p>	
											<?php
												echo $GLOBALS['Home_warranty_confirm_label_3'];
											?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div id="mapaMexico"></div>
					</div>
				</div>
			</div>
			<!--div class="col-banner-vertical">
				<img class="img-responsive" src="/img/banners/BannerOkTrip.jpg" alt="">
			</div-->
		</div>
		<div class="row" style="padding-left: 40px;padding-right: 40px;">
			<a href="https://api.whatsapp.com/send?phone=529982411535" target="_blank"><img src="img/new_items/banner_whats.png" alt="Whatsapp" class="img-responsive"></a>
		</div>
		<div class="hr-solid-ok"></div>
		<div class="destinies">
			<div class="row">
				<div class="col-md-12">
					<div class="title"><?php echo $GLOBALS['Home_our_destinies_label']; ?></div>
				</div>
			</div>
			<div class="row">
				<?php 
					
					foreach ($lista_cancun as $hotel) {

						$url = "/hoteles/details/".$GLOBALS['Lang_HotelDo']."?idDestiny=2&idHotel=".$hotel["Id"]."&from=".$datefrom."&to=".$dateTo."&rooms=1&adults[0]=1&kids[0]=0";

						echo '
							<div class="col-xs-12 col-sm-6 col-md-3">
								<a href="'.$url.'"><img src="'.$hotel["Image"].'" style="width:100%;"></a>
								<p class="h_label">'.$hotel["Nombre"].'</p>
								<div style="text-align:center;margin-bottom:10px;">';
								switch ($hotel['Category']) {
									case 'S2':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S25':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S5':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
									default:
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
										break;
								}
								echo '<span> | <i class="fa fa-tripadvisor" aria-hidden="true"></i> '.$hotel['Reviews']->Rating.'/5</span>
								</div>';
							echo '
								<!--div class="row price_row">
									<div class="col-xs-6 col-sm-6 col-md-6" style="padding-right:0px;">
										<p class="title-Ok">Precio Oktrip</p>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6" style="padding-left:0px;">
										<p class="cl-ok" style="margin-bottom:5px;">$ '.number_format( $hotel['Price_Agency'], 2 ).$GLOBALS['Hoteles_Currency'].'</p>';
										if($hotel['Price_Agency'] != $hotel['Price_Normal']){

											echo'<strike class="cl-ok">$ '.number_format($hotel["Price_Normal"],2).$GLOBALS['Hoteles_Currency'].'</strike>';
										}
								echo'</div>
								</div>
								<div class="row rules_row">
									<div class="col-xs-6 col-sm-6 col-md- 6" style="padding-right:0px;">
										<p style="font-size:13px;">Precio por Noche</p>
									</div>
									<div class="col-xs-6 col-sm-6 col-md- 6" style="padding-left:0px;">
										<p style="font-size:13px;">Impuestos incluidos</p>
									</div>
								</div-->
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<a href="'.$url.'" class="btnD">'.$GLOBALS['btn_row'].'</a>	
									</div>
								</div>
							';
						echo'</div>
						';

						
					}

				?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="title" style="margin-top: 35px;"><?php echo $GLOBALS['Home_our_destinies_label_2']; ?></div>
				</div>
			</div>
			<div class="row">
				<?php 
					//print_r($lista_orlando);
					foreach ($lista_orlando as $hotel) {

						$url = "/hoteles/details/".$GLOBALS['Lang_HotelDo']."?idDestiny=2&idHotel=".$hotel["Id"]."&from=".$datefrom."&to=".$dateTo."&rooms=1&adults[0]=1&kids[0]=0";

						echo '
							<div class="col-xs-12 col-sm-6 col-md-3">
								<a href="'.$url.'"><img src="'.$hotel["Image"].'" style="width:100%;"></a>
								<p class="h_label">'.$hotel["Nombre"].'</p>
								<div style="text-align:center;margin-bottom:10px;">';
								switch ($hotel['Category']) {
									case 'S2':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S25':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S3':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S35':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S4':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S45':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i>
										';
										break;
									case 'S5':
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
									default:
										echo '
											<i class="fa fa-star star-hotel" aria-hidden="true"></i>
										';
										break;
								}
								echo '<span> | <i class="fa fa-tripadvisor" aria-hidden="true"></i> '.$hotel['Reviews']->Rating.'/5</span>
								</div>';
							echo '
								<!--div class="row price_row">
									<div class="col-xs-6 col-sm-6 col-md-6" style="padding-right:0px;">
										<p class="title-Ok">Precio Oktrip</p>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6" style="padding-left:0px;">
										<p class="cl-ok" style="margin-bottom:5px;">$ '.number_format( $hotel['Price_Agency'], 2 ).$GLOBALS['Hoteles_Currency'].'</p>';
										if($hotel['Price_Agency'] != $hotel['Price_Normal']){

											echo'<strike class="cl-ok">$ '.number_format($hotel["Price_Normal"],2).$GLOBALS['Hoteles_Currency'].'</strike>';
										}
								echo'</div>
								</div>
								<div class="row rules_row">
									<div class="col-xs-6 col-sm-6 col-md- 6" style="padding-right:0px;">
										<p style="font-size:13px;">Precio por Noche</p>
									</div>
									<div class="col-xs-6 col-sm-6 col-md- 6" style="padding-left:0px;">
										<p style="font-size:13px;">Impuestos incluidos</p>
									</div>
								</div-->
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<a href="'.$url.'" class="btnD">'.$GLOBALS['btn_row'].'</a>	
									</div>
								</div>
							';
						echo'</div>
						';
						
					}

				?>
			</div>
			

		</div>

		<!--div class="hr-solid-ok"></div>
		<div class="row" style="margin-bottom: 40px;">
			<div class="col-md-12 col-banner">
				<a href="https://clubestrella.mx/registro/registro.php" target="_blank"><img class="img-responsive" src="<?php echo $GLOBALS['Home_banner_club']; ?>" alt="Club Estrella"></a>
			</div>
		</div-->
	</div>
	
	<?php include("views/partialViews/_loader-page.html"); ?>
	<?php include("views/partialViews/_footer.php"); ?>
	<?php include("views/partialViews/_landingScripts.html"); ?>
	<?php
	$to = new DateTime();
	$from = new DateTime();
	$to->add(new DateInterval('P2D'));
	$from->add(new DateInterval('P1D'));
	?>
	<script>
		
		var mapaInfo ="";
		var latitud = 0;
		var longitud = 0;

		$(document).ready(function(){

			var jsonMapa = "<?php echo addslashes(json_encode($mapaInfo)); ?>";
			mapaInfo = $.parseJSON(jsonMapa);
			latitud = mapaInfo[0].latitud;
			longitud = mapaInfo[0].longitud;

			var height_banner = $(".banner").height();
			var height_tabs = $(".search-ok").height();

			var aux = height_banner - height_tabs;
			var margin = aux/2;

			$(".search-ok").css({"margin-top" : margin , "margin-bottom" : margin });

			//console.log(margin);

			initMapaInfo();
		});

		function initMapaInfo() {

			var from = "<?php echo $from->format("d/m/Y"); ?>";
			var to = "<?php echo $to->format("d/m/Y"); ?>";
			var posicion = {lat: parseFloat(latitud), lng: parseFloat(longitud)};
			var map = new google.maps.Map(document.getElementById('mapaMexico'), {
				center: posicion,
				zoom: 9
			});

			var pin = {
				url: "/img/iconos/pin-map-min.png",
				size: new google.maps.Size(60, 80)
			};
			var infowindow = new google.maps.InfoWindow();

			var marker, i;

			for (i = 0; i < mapaInfo.length; i++) {
				
				marker = new google.maps.Marker({
					map: map,
					position: { lat: parseFloat(mapaInfo[i].latitud), lng: parseFloat(mapaInfo[i].longitud) },
					icon: pin,
					title: mapaInfo[i].nombre
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {

						infowindow.setContent( "<div style='width:200px;padding:20px;'><div class='row'><p id='setName'><img src='/img/iconos/mapIcon.svg' style='width:70px;' alt='Oktrip'> Hoteles en: <a href='/hoteles/search?destiny="+mapaInfo[i].nombre+"&idDestiny="+mapaInfo[i].id+"&from="+from+"&to="+to+"&rooms=1&adults[0]=2&kids[0]=0&coupon=' target='_blank'>"+mapaInfo[i].nombre+"</a></p><div class='col-xs-12 col-md-12 col-sm-12'>"+mapaInfo[i].pais+"</div></div>");
						infowindow.open(map, marker);
					}
				})(marker, i));
			}// fin del for
		}// fin de la funcion Mapa general
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuPcjJM0GlcPgfN-woHfY2FnU_vRq8av4"></script>
</body>
</html>