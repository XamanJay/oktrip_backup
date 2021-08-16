<!DOCTYPE html>
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>
</head>
<body id="search">
	<?php include("views/partialViews/_header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<?php
				if(isset($this->message)){
					echo $this->message."<br>";
				}
				?>
			</div>
		</div>	
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="/home"><?php echo $GLOBALS['Hoteles_Search_Home']; ?></a></li>
					<li class="active"><?php echo $city->getName()." - ".$city->getCountry();?></li>
				</ol>
				<div class="cl-blue" style="font-size: 16px; width: 100%; margin-bottom: 15px;"><b>
					<?php 
					if(is_array($hoteles)){
						echo count($hoteles); 
					}
					else if(isset($hoteles->Error))
					{	
						echo "0";
					}

					?> <?php echo $GLOBALS['Hoteles_Search_Hotels']; ?></b> <?php echo $GLOBALS['Hoteles_Search_Result']; ?>
				</div>
			</div>
		</div>
		<div class="col filter">
			<div class="f-box">
				<div class="f-section">
					<h4 class="text-center"><?php echo $GLOBALS['Hoteles_Search_tittle']; ?></h4>
				</div>
				<img src="" alt="">
				<div class="hr"></div>
				<div class="f-section">
					<ul class="l-style-none">
						<li>
							<div class="row">
								<div class="col-md-2" style="height: 30px;">
									<img src='/img/iconos/hotel-w.svg' style='height: 25px; width: 25px;' alt=''> 
								</div>
								<div class="col-md-10">
									<div class="middle-vertical" style="height: 30px;">
										<?php echo $city->getName(); ?>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2" style="height: 30px;">
									<img src='/img/iconos/calendario-s.svg' style='height: 25px; width: 25px;' alt=''> 
								</div>
								<div class="col-md-10">
									<div class="middle-vertical" style="height: 30px; line-height: normal;">
										<?php echo utf8_encode($dateLargeFrom)." - ".utf8_encode($dateLargeTo); ?>
									</div>
								</div>
								
							</div>
						</li>
						<li>
							<div class="row">
								
								<div class="col-md-2" style="height: 30px;">
									<img src='/img/iconos/person.svg' style='height: 25px; width: 25px;' alt=''> 
								</div>
								<div class="col-md-10">
									<div class="middle-vertical" style="height: 30px;">
										<?php echo $guetsStr; ?>
									</div>
								</div>
								
							</div>
						</li>
						<li>
							<div class="row">
								<div class="col-md-2" style="height: 30px;">
									<img src='/img/iconos/bed.svg' style='height: 25px; width: 25px;' alt=''> 
								</div>
								<div class="col-md-10">
									<div class="middle-vertical" style="height: 30px;">
										<?php echo $roomsStr; ?>
									</div>
								</div>
								
							</div>
						</li>
					</ul>
				</div>
				<div class="hr"></div>
				<div class="f-section">
					<h4 class="text-center"><?php echo $GLOBALS['Hoteles_Search_New_Search']; ?></h4>
				</div>
				<form id="formSearch" method="GET" action="/hoteles/search/<?php echo $GLOBALS['lang']; ?>">
					<div class="f-section">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="destiny"><?php echo $GLOBALS['_searcher_label_destiny']; ?></label>
									<div class="input-group" onclick="$('#destiny').focus();" style="cursor: pointer;">
										<div class="input-group-addon">
											<img class="icon-small" src="/img/iconos/hotel-w.svg" alt="">
										</div>
										<input id="destiny" name="destiny" type="text" onkeyup="refillDestiny(this);" class="form-control"  value="<?php echo $city->Name.", ".$city->Country; ?>" placeholder="Busca tu ciudad y selecciona">
										<input id="idCity" name="idCity" value="<?php echo $city->IdCity; ?>" type="hidden" >
										<input id="idHotel" name="idHotel" value="<?php echo $idHotel; ?>" type="hidden" >
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="from"><?php echo $GLOBALS['_searcher_label_from']; ?></label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar" style="color: white; font-size: 20px;" aria-hidden="true"></i>
										</div>
										<input id="from" name="from" class="form-control datepicker" value="" placeholder="dd/mm/aaaa" type="text" required>
									</div>
									<label for="from" generated="true" class="error"></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="to"><?php echo $GLOBALS['_searcher_label_to']; ?></label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar" style="color: white; font-size: 20px;" aria-hidden="true"></i>
										</div>
										<input id="to" name="to" class="form-control datepicker" value="" placeholder="dd/mm/aaaa" type="text" required>
									</div>
									<label for="to" generated="true" class="error"></label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="rooms" style="font-weight: normal;"><?php echo $GLOBALS['_searcher_label_rooms']; ?></label>
									<select id="rooms" name="rooms" class="form-control">
										<option value="1" <?php if($this->rooms == 1){echo "selected";} ?> >1</option>
										<option value="2" <?php if($this->rooms == 2){echo "selected";} ?> >2</option>
										<option value="3" <?php if($this->rooms == 3){echo "selected";} ?> >3</option>
									</select>
									<label for="rooms" generated="true" class="error"></label>
								</div>
							</div>	
						</div>
						<div class="hr"></div>
						<div id="room_0">

							<div class="row">
								<div class="col-md-12" style="text-align: center;">
									<label for=""><?php echo $GLOBALS['_searcher_label_room']." "; ?> 1</label>
								</div>
								<div class="col-md-6" style="padding-right: 7.5px; text-align: center; ">
									<div class="form-group">
										<label for="adults_0" style="font-weight: normal;"><?php echo $GLOBALS['_searcher_label_adults']; ?></label>
										<input id="adults_0" name="adults[0]" class="form-control" value="<?php echo $this->adults[0]; ?>" placeholder="" type="number" required>
										<label for="adults_0" generated="true" class="error"></label>
									</div>
								</div>
								<div class="col-md-6" style="padding-left: 7.5px;  text-align: center; ">
									<div class="form-group">
										<label for="kids_0" style="font-weight: normal;"><?php echo $GLOBALS['_searcher_label_kids'] ?></label>
										<input id="kids_0" name="kids[0]" class="form-control kids-s-0" value="<?php echo $this->kids[0]; ?>" placeholder="" type="number" required>
										<label for="kids_0" generated="true" class="error"></label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="con-ages-0">
									<?php

									for ($i=0; $i < 3; $i++) { 
										if(!empty($this->ageKids[0][$i])){
											$style = ($i == 0) ? "padding-right: 7.5px; text-align: center;" : (($i == 1) ? "padding-left: 7.5px; padding-right: 7.5px; text-align: center;" : (($i == 2) ? "padding-left: 7.5px;  text-align: center;" : "")) ;
											echo '<div class="col-md-4 col-sm-12" style="'.$style.'">
											<div class="form-group">
											<label for="ages_0_'.$i.'" style="font-size: 9px;">'.$GLOBALS["_searcher_label_age_kid"].' '.( $i+1 ).'</label>
											<input id="ages_0_'.$i.'" name="ages[0]['.$i.']" type="number" class="form-control" min="1" value="'.$this->ageKids[0][$i].'" required>
											</div>
											<label for="ages_0_'.$i.'" generated="true" class="error"></label>
											</div>';
										}
									}
									echo "";
									?>
								</div>
							</div>
						</div>
						<div class="hr"></div>
						<div class="con-rooms">
							<?php
							for ($i=1; $i < $this->rooms; $i++) { 
								echo '
								<div id="room_'.$i.'">
								<div class="row">
								<div class="col-md-12" style="text-align: center;">
								<label for="">'.$GLOBALS["_searcher_label_room"].' '.($i+1).'</label>
								</div>
								<div class="col-xs-6" style="padding-right: 7.5px; text-align: center;">
								<div class="form-group">
								<label for="adults_'.$i.'">'.$GLOBALS['_searcher_label_adults'].'</label>
								<input id="adults_'.$i.'" name="adults['.$i.']" type="number" class="form-control" min="1" value="'.$this->adults[$i].'" required>
								</div>
								<label for="adults_'.$i.'" generated="true" class="error"></label>
								</div>
								<div class="col-xs-6" style="padding-left: 7.5px;  text-align: center; ">
								<div class="form-group">
								<label for="kids_'.$i.'">'.$GLOBALS['_searcher_label_kids'].'</label>
								<input id="kids_'.$i.'" name="kids['.$i.']" type="number" class="form-control kids-s-'.$i.'" min="0" value="'.$this->kids[$i].'" required>
								</div>
								<label for="kids_'.$i.'" generated="true" class="error"></label>
								</div>
								</div>
								<div class="row">
								<div class="con-ages-'.$i.'">';
								for ($j=0; $j < 3; $j++) { 
									if(!empty($this->ageKids[$i][$j])){
										$style = ($j == 0) ? "padding-right: 7.5px; text-align: center;" : (($j == 1) ? "padding-left: 7.5px; padding-right: 7.5px; text-align: center;" : (($j == 2) ? "padding-left: 7.5px;  text-align: center;" : "")) ;
										echo '<div class="col-md-4 col-sm-12" style="'.$style.'">
										<div class="form-group">
										<label for="ages_'.$i.'_'.$j.'" style="font-size: 9px;">'.$GLOBALS["_searcher_label_age_kid"].' '.( $j+1 ).'</label>
										<input id="ages_'.$i.'_'.$j.'" name="ages['.$i.']['.$j.']" type="number" class="form-control" min="1" value="'.$this->ageKids[$i][$j].'" required>
										</div>
										<label for="ages_'.$i.'_'.$j.'" generated="true" class="error"></label>
										</div>';
									}
								}
								echo '</div>
								</div>
								<div class="clear"></div><hr>
								</div>';
							}
							?>
						</div>

						<!--div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="coupon">Cupón</label>
									<input id="coupon" name="coupon" class="form-control" placeholder="" type="text">
									<label for="coupon" generated="true" class="error"></label>
								</div>
							</div>
						</div-->
					</div>
					<!--div class="hr"></div-->
					<div class="f-section">
						<div class="form-group" style="margin-bottom: 0px;">
							<button class="btn btn-default center-block"><?php echo $GLOBALS['_searcher_btn_search']; ?></button>
						</div>     
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
			<div id="mapGeneral">
				<div id="mapGeneric" style="height: 250px;"></div>
			</div>
		</div>
		<div class="col search">
			<div class="row">
				<div class="col-md-12 cl-gray">
					<div class="pull-left">
						
						<span>
							<?php echo $GLOBALS['Hoteles_Search_Order_by']; ?>
						</span>
						<select id="filterSelect" class="form-control" style="width: auto; display: inline-block;">
							<option value="1"><?php echo $GLOBALS['Hoteles_Search_Order_Desc']; ?></option>
							<option value="2"><?php echo $GLOBALS['Hoteles_Search_Order_Asc']; ?></option>
							<option value="3" selected="selected"><?php echo $GLOBALS['Hoteles_Search_Stars']; ?></option>
							<option value="4"><?php echo $GLOBALS['Hoteles_Search_Tripadvisor']; ?></option>
						</select>
						<!--button class="btn btn-small" style="background-color: #f8f8f8;">Precio <i class="fa fa-sort" aria-hidden="true"></i></button-->
					</div>
					<div class="pull-right">
						<ul class="nav nav-pills">
							<li class="active"><a class="btn btn-opt" href="#hotels-ok"><i class="fa fa-list-ul" aria-hidden="true"></i> <?php echo $GLOBALS['Hoteles_Search_List']; ?></a></li>
							<li><a class="btn btn-opt" href="#map-ok" onclick="setTimeout(initMap, 200);"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $GLOBALS['Contact_address_map']; ?></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="hr"></div>
			<div class="row">
				<div id="hotels-ok" class="col-md-12 tab-pane fade in active">

					<div class="holder"></div>
					<div id="itemContainer">
						<?php
						/*$locations = array();
						$hotelInfo = array();
						if(!isset($hoteles->Error)){
							foreach ($hoteles as $hotel) {
								array_push($locations, 
									array(
										'city' => $hotel->getName(),
										'lat' => $hotel->getLatitude(), 
										'lng' => $hotel->getLongitude()
									)
								);

								array_push($hotelInfo,
									array(
										'name' => $hotel->getName(),
										'stars' => $hotel->CategoryId,
										'trip' => $hotel->Review->Rating,
										'address' => $hotel->Address->City
									)
								);


								$stars = '';

								switch ($hotel->CategoryId) {
									case 'S2':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S25':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S3':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S35':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S4':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S45':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S5':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S55':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i> | ';
									break;
									case 'S6':
									$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i> | ';
									break;
									default:
									$stars = '<i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel-o" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
									break;
								}


								$nights = $this->to->diff($this->from)->days;
								$serviceFree = '';

								foreach ($hotel->Services as $service) {
									if(empty($service->ExtraCharge)){

										switch ($service->Id) {
											case 'WIREINTE':
											$serviceFree .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'"><i class="fa fa-wifi orange-hover" aria-hidden="true"></i></div>';
											break;
											case 'KIDS':
											$serviceFree .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'"><i class="fa fa-child orange-hover" aria-hidden="true"></i></div>';
											break;
											case 'ATM':
											$serviceFree .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'"><i class="fa fa-credit-card orange-hover" aria-hidden="true"></i></div>';
											break;
											case 'CASACAMB':
											$serviceFree .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'"><i class="fa fa-usd orange-hover" aria-hidden="true"></i></div>';
											break;
											case 'ICEMACH':
											$serviceFree .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'"><i class="fa fa-cubes orange-hover" aria-hidden="true"></i></div>';
											break;
											default:
											break;
										}
									}
								}


								if(empty($serviceFree)){
									$serviceFree .= '<span class="cl-gray">Sin servicios</span>';
								}

								$rating = '';
								if(!empty($hotel->Review)){
									$rating .= '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> '.$hotel->Review->Rating.' / 5 </span> | ';
								}
								$comments = '<span class="cl-ok"><i class="fa fa-comment" aria-hidden="true"></i> 4.3 / 5 !Muy bueno! </span>';


								$priceNormal = $hotel->Rooms[0]->MealPlans[0]->Normal;
								$tarifaNormal = $hotel->Rooms[0]->MealPlans[0]->Total;
								$priceOk = $hotel->Rooms[0]->MealPlans[0]->AgencyPublic->AgencyPublic;

								$clubestrellaController = new clubestrellaController();
								$precioClub = $clubestrellaController->showEstrella($tarifaNormal,$priceOk);

								//FOR WINDOWS - extension=ext/php_intl.dll
								/**/

								/*$formatter = new NumberFormatter('es_MX', NumberFormatter::CURRENCY);
								$curr = 'MXN';

								$priceNormalPerNight = $formatter->formatCurrency(($priceNormal/$nights), $curr);
								$priceOkPerNight = $formatter->formatCurrency(($priceOk/$nights), $curr);
								$priceClub = $formatter->formatCurrency(($precioClub/$nights), $curr);

								// FOR UBUNTU SERVER

								/*$priceNormalPerNight = money_format('%.2n', ($priceNormal/$nights));
								$priceOkPerNight = money_format('%.2n', ($priceOk/$nights) );
								$priceClub = money_format('%.2n', ($precioClub/$nights) );
									*/

								/*$url = "/hoteles/details?idDestiny=".$city->getIdCity()."&idHotel=".$hotel->getId()."&from=".$this->from->format("d/m/Y")."&to=".$this->to->format("d/m/Y")."&rooms=".$this->rooms;

								for ($i=0; $i < $this->rooms ; $i++) { 

									$url .= "&adults[".$i."]=".$this->adults[$i];
									$url .= "&kids[".$i."]=".$this->kids[$i];

									for ($j=0; $j < 3; $j++) { 
										if(!empty($this->ageKids[$i][$j])){
											$url .= "&ages[".$i."][".$j."]=".$this->ageKids[$i][$j];
										}
									}
								}
								echo "<div class='item-hotel'>
								<div class='row'>
								<div class='col-sm-3'>
								<img class='img-responsive' style='width: 100%; margin-bottom: 15px;' src='".$hotel->getThumbnailUrl()."'; title='".$hotel->getName()."'>
								</div>
								<div class='col-sm-6'>
								<a class='cl-ok name-hotel style-none link-hotel' href='".$url."'>".$hotel->getName()."</a>
								<div class='score-hotel' >".$stars.$rating.$comments."</div>
								<a class='cl-ok style-none' href='#' onclick='initMapHotel(".$hotel->getLatitude().",".$hotel->getLongitude().", \"".$hotel->getName()."\");'>".$hotel->getCityName()." <i class='fa fa-map-marker' aria-hidden='true'></i></a>
								<div class='serviceFree'>Servicios sin costo: ".$serviceFree."</div>
								</div>
								<div class='col-sm-3'>
								<div class='row'>";
								if ($precioClub != 0) {
									echo"
									<div class='col-xs-6 col-sm-12'>
									<div class='priceOk'>
									<span class='title'>Precio Clubestrella</span>
									<div class='cl-ok'>MXN <span class='price'>".$priceClub."</span></div>
									</div>
									</div>";
								}
								echo"
								<div class='col-xs-6 col-sm-12'>
								<div class='priceNormal'>
								<div class='title-Ok'>Precio Oktrip</div>
								<div class='cl-ok'>MXN <span class='price'>".$priceOkPerNight."</span></div>
								</div>
								</div>
								</div>

								<div class='row'>
								<div class='col-xs-12'>
								<div class='little-letter'>* Promedio por noche.<br>* Impuestos incluidos.</div>
								</div>
								</div>
								<a href='".$url."' class='btn btn-reserve form-control'>Reservar</a>
								</div>
								</div>
								</div>";
							}

						}
						else
						{
							echo "<div style='width: 100%; height: 100px; background-color: #f8f8f8; text-align:center; padding: 30px;'>
							No se encontraron resultados, intente recargando la página o con una nueva búsqueda.
							</div>";
						}*/

						?>

					</div>
					<div class="holder"></div>
				</div>
				<div class="hoteles-print-js">
					
				</div>
				<div id="map-ok" class="col-md-12 tab-pane fade">
					<div id="map"></div>
				</div>
			</div>
		</div>
		<div id="modalMap" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><?php echo $GLOBALS['Hoteles_Search_Location']; ?></h4>
					</div>
					<div class="modal-body">
						<div id="mapHotel" style="width: 100%; height: 500px;"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $GLOBALS['Hoteles_Search_Close']; ?></button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
	

	<?php //echo addslashes(json_encode($locations)); ?>
	<?php include("views/partialViews/_loader-page.html"); ?>
	<?php include("views/partialViews/_footer.php"); ?>
	<?php include("views/partialViews/_landingScripts.html"); ?>

	<script>

		var dateFrom = "<?php echo $this->from->format('d/m/Y');?>";
		var dateTo = "<?php echo $this->to->format('d/m/Y');?>";
		var rooms = <?php echo $this->rooms; ?>;
		var idCity = <?php echo $city->getIdCity(); ?>;
		var lang = "<?php echo $GLOBALS['lang']; ?>";
		var currency = "<?php echo $GLOBALS['Hoteles_Currency']; ?>";

		var hoteles = <?php echo json_encode($hoteles); ?> ;
		var adults = <?php echo json_encode($this->adults); ?> ;
		var kids = <?php echo json_encode($this->kids); ?> ;
		var ageKids = <?php echo json_encode($this->ageKids); ?> ;

		var nights = <?php echo $this->to->diff($this->from)->days; ?> ;

		var locations = new Array();
		
		var _url = "&from="+dateFrom+"&to="+dateTo+"&rooms="+rooms;

		$(document).ready(function(){

			for (var i=0; i < rooms ; i++) { 

				_url += "&adults["+i+"]="+adults[i];
				_url += "&kids["+i+"]="+kids[i];

				if(kids[i] > 0){
					for (var j=0; j < 3; j++) { 
						if((ageKids[i][j] == null || ageKids[i][j] == 'undefinded' || ageKids[i][j] == '') != true ){
							_url += "&ages["+i+"]["+j+"]="+ageKids[i][j];
						}
					}
				}
			}

			//Ordenamiento por Categoria
			hoteles.sort(function (a, b){

				return (b.Stars - a.Stars);

			});

			/*var jsonLocations = "<?php echo addslashes(json_encode($locations)); ?>";
			var jsonHotels = "<?php echo addslashes(json_encode($hotelInfo)); ?>";
			locations = $.parseJSON(jsonLocations);
			hoteles = $.parseJSON(jsonHotels);
			latitud = locations[0].lat;
			longitud = locations[0].lng;*/

			for(var i = 0; i < hoteles.length; i++ ){
				printHotel(hoteles[i]);
			}
			


			$("div.holder").jPages({
				containerID : "itemContainer",
				perPage: 12,
				previous: "Ant",
				next: "Sig"
			});

			$("#filterSelect").change(function() {

				var seleted = $(this).val();
				switch(seleted){
					case "1":
						//Ordenamiento por Precio Mayor
						hoteles.sort(function (a, b){
							return (b.Rooms[0].MealPlans[0].AgencyPublic.AgencyPublic - a.Rooms[0].MealPlans[0].AgencyPublic.AgencyPublic)
						});
					//	
					break;
					case "2":
						//Ordenamiento por Precio Mayor
						hoteles.sort(function (a, b){
							return (a.Rooms[0].MealPlans[0].AgencyPublic.AgencyPublic - b.Rooms[0].MealPlans[0].AgencyPublic.AgencyPublic)
						});
					//	
					break;
					case "3":
						//Ordenamiento por Categoria
						hoteles.sort(function (a, b){
							return (b.Stars - a.Stars);
						});
					//
					break;
					case "4":
						//Ordenamiento por Categoria
						hoteles.sort(function (a, b){
							return (b.Review.Rating - a.Review.Rating);
						});
					//
					break;
				}

				$("#itemContainer").html("");

				for(var i = 0; i < hoteles.length; i++ ){
					printHotel(hoteles[i]);
				}
				

				$("div.holder").jPages("destroy").jPages({
					containerID : "itemContainer",
					perPage     : 12,
					previous: "Ant",
					next: "Sig"
				});
			});

			$("#home rooms option[value="+rooms+"]").attr("selected",true);


			$('#from').datetimepicker({
				format: 'DD/MM/YYYY',
				minDate: moment().add(1, 'day'),
				useCurrent: false
			}).val(dateFrom);

			$('#to').datetimepicker({
				format: 'DD/MM/YYYY',
				minDate: moment().add(2, 'day'),
				useCurrent: false
			}).val(dateTo);

			$("#from").on("dp.change", function (e) {
				$('#to').data("DateTimePicker").minDate(e.date.add(1, 'day'));
			});
			$("#to").on("dp.change", function (e) {
				$('#from').data("DateTimePicker").maxDate(e.date.subtract(1, 'day'));
			});
			var lang = readCookie("Lang");
			$.getJSON("/js/lang/"+lang+".json", function(aux){
				initKids(aux);
			});
			MapGenerico();

		}); 


		function initMap() {

			var myLatLng = {lat: locations[0].lat , lng: locations[0].lng };
			var map = new google.maps.Map(document.getElementById('map'), {
				center: myLatLng,
				zoom: 12
			});

			var pin = {
				url: "/img/iconos/pin-map-min.png",
				size: new google.maps.Size(60, 80)
			};
			for (var i = 0; i < locations.length; i++) {
				var marker = new google.maps.Marker({
					map: map,
					position: { lat: locations[i].lat, lng: locations[i].lng },
					icon: pin,
					title: locations[i].hotel
				});
			}
		}

		function MapGenerico() {

			var posicion = {lat: locations[0].lat , lng: locations[0].lng };
			var map = new google.maps.Map(document.getElementById('mapGeneric'), {
				center: posicion,
				zoom: 15
			});

			var pin = {
				url: "/img/iconos/pin-map-min.png",
				size: new google.maps.Size(60, 80)
			};
			var infowindow = new google.maps.InfoWindow();

			var marker, i;
			var rating = "";
			var stars ="";

			for (i = 0; i < locations.length; i++) {


				marker = new google.maps.Marker({
					map: map,
					position: { lat: locations[i].lat, lng: locations[i].lng },
					icon: pin,
					title: locations[i].hotel
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {

						switch(locations[i].stars){
							case 'S2':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S25':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S3':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S35':
							$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S4':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S45':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S5':
							$stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S55':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i> | ';
							break;
							case 'S6':
							stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i> | ';
							break;
							default:
							stars = '<i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel-o" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
							break;
						}

						if (locations[i].trip == null) {
							rating = '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> 0 / 5 </span> | ';
						}
						else{
							rating = '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> '+locations[i].trip+' / 5 </span> | ';
						}

						infowindow.setContent( '<div style="width:300px;padding:20px;"><div class="row"><p id="setName">Hotel: '+locations[i].hotel+'</p><div class="col-xs-6 col-md-6 col-sm-6">'+stars+'</div><div class="col-xs-6 col-md-6 col-sm-6">'+rating+'</div><div class="col-xs-12 col-md-12 col-sm-12">'+locations[i].address+'</div></div></div>');
						infowindow.open(map, marker);
					}
				})(marker, i));
}	
}

function initMapHotel(lat, lng, name)
{


	setTimeout(
		function(){
			var myLatLng = {lat: lat, lng: lng };

			var map = new google.maps.Map(document.getElementById('mapHotel'), {
				center: myLatLng,
				zoom: 12
			});

			var pin = {
				url: "/img/iconos/pin-map-min.png",
				size: new google.maps.Size(60, 80)
			};

			var marker = new google.maps.Marker({
				map: map,
				position: { lat: lat, lng: lng },
				icon: pin,
				title: name
			});

			$("#modalMap .modal-title").html(name);

		}, 300);

	$('#modalMap').modal();
}

function showEstrella(tarifaNormal,tarifaOktrip)
{


	var result = tarifaOktrip - tarifaNormal;
	var porcentaje = (result/tarifaNormal)*100;
	var precioClub = 0;

	if (porcentaje >= 25) {
		precioClub = (tarifaNormal/0.85).toFixed(2);
	}
	else
		precioClub = 0;

	return precioClub;
}

function printHotel(hotel)
{
	var data = new Object();

	data.hotel = hotel.Name;
	data.lat = hotel.Latitude;
	data.lng = hotel.Longitude;
	data.stars = hotel.CategoryId;
	data.trip = hotel.Review.Rating;
	data.address = hotel.Address.City;

	locations.push(data);
	var print = "";
	var stars = "";
	var serviceFree = "";
	var comments = "";
	var rating = "";
	var url = "";


	switch (hotel.CategoryId) {
		case 'S2':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S25':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S3':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S35':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S4':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S45':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S5':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S55':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i> | ';
		break;
		case 'S6':
		stars = '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i> | ';
		break;
		default:
		stars = '<i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel-o" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i> | ';
		break;
	}

	for(var j = 0; j < hotel.Services.length ; j++){

		if(hotel.Services[j].ExtraCharge === null || hotel.Services[j].ExtraCharge === 'undefinded' || hotel.Services[j].ExtraCharge == ''){
			switch (hotel.Services[j].Id) {
				case 'WIREINTE':
				serviceFree += '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'+hotel.Services[j].Name+'"><i class="fa fa-wifi orange-hover" aria-hidden="true"></i></div>';
				break;
				case 'KIDS':
				serviceFree += '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'+hotel.Services[j].Name+'"><i class="fa fa-child orange-hover" aria-hidden="true"></i></div>';
				break;
				case 'ATM':
				serviceFree += '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'+hotel.Services[j].Name+'"><i class="fa fa-credit-card orange-hover" aria-hidden="true"></i></div>';
				break;
				case 'CASACAMB':
				serviceFree += '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'+hotel.Services[j].Name+'"><i class="fa fa-usd orange-hover" aria-hidden="true"></i></div>';
				break;
				case 'ICEMACH':
				serviceFree += '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'+hotel.Services[j].Name+'"><i class="fa fa-cubes orange-hover" aria-hidden="true"></i></div>';
				break;
				default:
				break;
			}
		}
	}

	if(serviceFree == "" ){
		serviceFree += '<span class="cl-gray">Sin servicios</span>';
	}

	if(hotel.Review.Rating != 0){
		rating += '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> '+hotel.Review.Rating+' / 5 </span>';
	}

	//comments = '<span class="cl-ok"><i class="fa fa-comment" aria-hidden="true"></i> 4.3 / 5 !Muy bueno! </span>';

	var priceNormal = hotel.Rooms[0].MealPlans[0].Normal.toFixed(2);
	var tarifaNormal = hotel.Rooms[0].MealPlans[0].Total;
	var priceOk = hotel.Rooms[0].MealPlans[0].AgencyPublic.AgencyPublic;
	var policie = hotel.Rooms[0].MealPlans[0].RateDetails.RateDetail.CancellationPolicy.Description;

	var precioClub = showEstrella(tarifaNormal,priceOk);

	var priceNormalPerNight = (priceNormal/nights).toFixed(2);
	var priceOkPerNight = (priceOk/nights).toFixed(2);
	var priceClub = (precioClub/nights).toFixed(2);

	url = "/hoteles/details/"+lang+"?idDestiny="+idCity+"&idHotel="+hotel.Id + _url;

	print = "<div class='item-hotel'>"+
	"<div class='row'>"+
	"<div class='col-sm-3'>"+
	"<img class='img-responsive' style='width: 100%; margin-bottom: 15px;' src='"+hotel.ThumbnailUrl+"'; title='"+hotel.Name+"'>"+
	"</div>"+
	"<div class='col-sm-6'>"+
	"<a class='cl-ok name-hotel style-none link-hotel' href='"+url+"'>"+hotel.Name+"</a>"+
	"<div class='score-hotel' >"+stars+rating+"</div>"+
	"<a class='cl-ok style-none' href='#' onclick='initMapHotel("+hotel.Latitude+","+hotel.Longitude+", \""+hotel.Name+"\");'>"+hotel.CityName+" <i class='fa fa-map-marker' aria-hidden='true'></i></a>"+
	"<div class='serviceFree'><?php echo $GLOBALS['Hoteles_Search_lbl_service']; ?> "+serviceFree+"</div>"+
	"<div class='serviceFree'><span style='color:#FC5D20;'><?php echo $GLOBALS['Hoteles_Search_lbl_cancellation']; ?></span> "+policie+"</div>"+
	"</div>"+
	"<div class='col-sm-3'>"+
	"<div class='row'>";

	if (precioClub != 0) {
		print += "<div class='col-xs-6 col-sm-12'>"+
		"<div class='priceOk'>"+
		"<span class='title'><?php echo $GLOBALS['Hoteles_Search_lbl_price_club']; ?></span>"+
		"<div class='cl-ok'>"+currency+" <span class='price'>$"+parseFloat(priceClub).toLocaleString("<?php echo $GLOBALS['Locale_string']; ?>")+"</span></div>"+
		"</div>"+
		"</div>";
	}

	print += "<div class='col-xs-6 col-sm-12'>"+
	"<div class='priceNormal'>"+
	"<div class='title-Ok'><?php echo $GLOBALS['Hoteles_Search_lbl_price_oktrip']; ?></div>"+
	"<div class='cl-ok'>"+currency+" <span class='price'>$"+parseFloat(priceOkPerNight).toLocaleString("<?php echo $GLOBALS['Locale_string']; ?>")+"</span></div>";
	if(priceNormal != priceOkPerNight){

	print +="<div class='cl-ok'>"+currency+" <span class='price2'><strike>$"+parseFloat(priceNormal).toLocaleString("<?php echo $GLOBALS['Locale_string']; ?>")+"</strike></span></div>";
	}
	print +="</div>"+
	"</div>"+
	"</div>"+
	"<div class='row'>"+
	"<div class='col-xs-12'>"+
	"<div class='little-letter'><?php echo $GLOBALS['Hoteles_Search_lbl_average']; ?><br><?php echo $GLOBALS['Hoteles_Search_lbl_tax']; ?></div>"+
	"</div>"+
	"</div>"+
	"<a href='"+url+"' class='btn btn-reserve form-control'><?php echo $GLOBALS['Hoteles_Search_btn_reserve']; ?></a>"+
	"</div>"+
	"</div>"+
	"</div>";

	$("#itemContainer").append(print);
}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuPcjJM0GlcPgfN-woHfY2FnU_vRq8av4"></script>

</body>

</html>