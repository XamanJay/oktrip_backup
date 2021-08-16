<?php

$stars = '';
switch ($HotelCity->getCategory()) {
	case 'S2':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S25':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S3':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S35':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S4':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S45':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S5':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S55':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	case 'S6':
	$stars = '<i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star star-hotel fnt-24" aria-hidden="true"></i>';
	break;
	default:
	$stars = '<i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i><i class="fa fa-star-o star-hotel fnt-24" aria-hidden="true"></i>';
	break;
}

$services = '';
foreach ($hoteles->Services as $service) {
	switch ($service->Id) {
		case 'WIREINTE':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-wifi fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;
		case 'KIDS':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-child fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;
		case 'ATM':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-credit-card fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;
		case 'CASACAMB':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-usd fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;
		case 'ICEMACH':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-cubes fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;
		case 'LAUNDRY':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-black-tie fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;
		case 'SAFEDEP':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-lock fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;	
		case 'TRAVELAG':
		$services .= '<div class="border-circle" data-toggle="tooltip" data-placement="top" title="'.$service->Name.'" style="display:inline-block; margin-left: 10px; margin-right: 10px;" ><i class="fa fa-plane fnt-24 orange-hover" aria-hidden="true"></i></div>';
		break;	
		default:
		break;
	}
}

if(empty($services)){
	$services .= '<span class="cl-gray">Sin servicios</span>';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>
</head>
<body id="details">
	<?php include("views/partialViews/_header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ol class="breadcrumb">
					<li><a href="/home"><?php echo $GLOBALS['Hoteles_Search_Home']; ?></a></li>
					<li><a class="link-hotel" href="/hoteles/search?<?php echo $urlReturn; ?>"><?php echo $city->Name.", ".$city->Country; ?></a></li>
					<li class="active"><?php echo $hoteles->Name; ?></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3 class="cl-ok" style="margin-bottom: 20px; float: left;">
					<p>
						<?php echo $hoteles->Name." ".$stars ?> 
						<p/>
						<a href="#title-map" class="style-none">
							<small><?php echo $hoteles->Address->City->Name; ?> <i class='fa fa-map-marker cl-ok' aria-hidden='true'></i></small>
						</a>

					</h3>
					<button class="btn form-control pull-right btn-collapse-filter" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="filter">
						<i class="fa fa-caret-down pull-left" style="margin-top: 4px;" aria-hidden="true"></i> <i class="fa fa-search" aria-hidden="true"></i> <?php echo $GLOBALS['Hoteles_Search_New_Search']; ?>
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">


					<div class="col filter">

						<div class="row">
							<div class="col-md-12 collapse" id="filter">
								<div  class="f-box" style="margin-top: 0px;">
									<div class="f-section">
										<h4 class="text-center"><?php echo $GLOBALS['Hoteles_Search_tittle']; ?></h4>
									</div>
									<div class="hr"></div>
									<div class="f-section">
										<?php
										echo $city->getName()."<br>";
									//Quitar el utf8_encode cuando se pase al servidor
										echo utf8_encode($dateLargeFrom)." - ".utf8_encode($dateLargeTo)."<br>";
										echo $guetsStr."<br>";
										echo $roomsStr."<br>";
										?>
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
															<input id="destiny" name="destiny" type="text" onkeyup="refillDestiny(this);" class="form-control"  value="<?php echo $HotelCity->Name.", ".$city->Country; ?>" placeholder="Busca tu ciudad y selecciona">
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
															<label for="kids_0" style="font-weight: normal;"><?php echo $GLOBALS['_searcher_label_kids']; ?></label>
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
						</div>
					</div>
					<div class="clear"></div>
					<div class="box">
						<form id="changeDates" class="cl-gray-s" action="/hoteles/details/<?php echo $GLOBALS['lang']; ?>" method="GET">
							<div class="row">
								<div class="col-md-12">
									<label><?php echo $GLOBALS['Hoteles_Details_Dates']; ?></label>
									<hr>
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
											<input id="from_" name="from" class="form-control datepicker" value="" placeholder="dd/mm/aaaa" type="text" required>
										</div>
										<label for="from_" generated="true" class="error"></label>
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
											<input id="to_" name="to" class="form-control datepicker" value="" placeholder="dd/mm/aaaa" type="text" required>
										</div>
										<label for="to_" generated="true" class="error"></label>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">
									<div class="" style="background-color: #f8f8f8; padding: 5px; margin-bottom: 15px;">
										<button type="button" id="btn-minus" class="btn btn-sm pull-right" style="margin-left: 5px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
										<button type="button" id="btn-plus" class="btn btn-sm pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>
										<label for="" style="margin-top: 5px;"><?php echo $GLOBALS['_searcher_label_rooms']; ?>: <span id="con-room"><?php echo $this->rooms;?><span></label>
											<input id="rooms_" name="rooms" type="hidden" value="<?php echo $this->rooms;?>" required>
										</div>
									</div>
								</div>
								<div id="room_0">
									<div class="row">
										<div class="col-xs-6 half-input-r">
											<div class="form-group">
												<label for="adults_0"><?php echo $GLOBALS['_searcher_label_adults']; ?></label>
												<input id="adults_0_" name="adults[0]" type="number" class="form-control" min="1" value="<?php echo $this->adults[0];?>" required>
												<label for="adults_0_" generated="true" class="error"></label>
											</div>
										</div>
										<div class="col-xs-6 half-input-l">
											<div class="form-group">
												<label for="kids_0"><?php echo $GLOBALS['_searcher_label_kids']; ?></label>
												<input id="kids_0_" name="kids[0]" type="number" class="form-control kids-d-0" min="0" value="<?php echo $this->kids[0];?>" required>
												<label for="kids_0_" generated="true" class="error"></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="con-ages-0_">
											<?php

											for ($i=0; $i < 3; $i++) { 
												if(!empty($this->ageKids[0][$i])){
													$class = ($i == 0) ? "half-input-r" : (($i == 1) ? "half-input-m" : (($i == 2) ? "half-input-l" : "")) ;
													echo '<div class="col-xs-4 '.$class.'">
													<div class="form-group">
													<label for="ages_0_'.$i.'" style="font-size: 10px;">'.$GLOBALS["_searcher_label_age_kid"].' '.( $i+1 ).'</label>
													<input id="ages_0_'.$i.'_" name="ages[0]['.$i.']" type="number" class="form-control" min="1" value="'.$this->ageKids[0][$i].'" required>
													<label for="ages_0_'.$i.'_" generated="true" class="error"></label>
													</div>
													</div>';
												}
											}
											echo "";
											?>
										</div>
									</div>
									<div class='clear'></div><hr>
								</div>
								<div class="con-rooms_">
									<?php
									for ($i=1; $i < $this->rooms; $i++) { 
										echo '
										<div id="room_'.$i.'_">
										<div class="row">
										<div class="col-xs-6 half-input-r">
										<div class="form-group">
										<label for="adults_'.$i.'">'.$GLOBALS["_searcher_label_adults"].'</label>
										<input id="adults_'.$i.'_" name="adults['.$i.']" type="number" class="form-control" min="1" value="'.$this->adults[$i].'" required>
										<label for="adults_'.$i.'_" generated="true" class="error"></label>
										</div>
										</div>
										<div class="col-xs-6 half-input-l">
										<div class="form-group">
										<label for="kids_'.$i.'">'.$GLOBALS["_searcher_label_kids"].'</label>
										<input id="kids_'.$i.'_" name="kids['.$i.']" type="number" class="form-control kids-d-'.$i.'" min="0" value="'.$this->kids[$i].'" required>
										<label for="kids_'.$i.'_" generated="true" class="error"></label>
										</div>
										</div>
										</div>
										<div class="row">
										<div class="con-ages-'.$i.'_">';
										for ($j=0; $j < 3; $j++) { 

											if(!empty($this->ageKids[$i][$j])){
												$class = ($j == 0) ? "half-input-r" : (($j == 1) ? "half-input-m" : (($j == 2) ? "half-input-l" : "")) ;

												echo '<div class="col-xs-4 '.$class.'">
												<div class="form-group">
												<label for="ages_'.$i.'_'.$j.'" style="font-size: 10px;">'.$GLOBALS["_searcher_label_age_kid"].' '.($j+1).'</label>
												<input id="ages_'.$i.'_'.$j.'_" name="ages['.$i.']['.$j.']" type="number" class="form-control" min="1" value="'.$this->ageKids[$i][$j].'" required>
												<label for="ages_'.$i.'_'.$j.'_" generated="true" class="error"></label>
												</div>
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

								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-default form-control cl-gray"><?php echo $GLOBALS['Hoteles_Details_Disponibility']; ?></button>
										<input id="idDestiny_" name="idDestiny" type="hidden" value="<?php echo $idCiudad;?>" required>
										<input id="idHotel_" name="idHotel" type="hidden" value="<?php echo $idHotel;?>" required>

									</div>
								</div>
								<div class="clear"></div>
							</form>
						</div>
					</div>

					<div class="col search" style="padding-top: 0px;">
						<div class="box">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

								<div class="carousel-inner" role="listbox">
									<?php
									$first = true;
									foreach ($hoteles->Gallery as $image) 
									{
										if(strcmp($image->Title, 'Main')){
											if ($first) 
											{
												echo "<div class='item active'>
												<img src='".$image->URL."' alt='".$image->Title."' class='img-responsive center-block'>
												<div class='carousel-caption'>
												".$image->Description."
												</div></div>";
												$first = false;
											}
											else
											{
												echo "<div class='item'>
												<img src='".$image->URL."' alt='".$image->Title."' class='img-responsive center-block'>
												<div class='carousel-caption'>
												".$image->Description."
												</div></div>";
											}
										}
									}

									?>
								</div>
								<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
						<div class="box-inv">
							<?php echo $GLOBALS['Hoteles_Details_Services']; ?>
							<div class="hr-solid-w-wm"></div>
							<?php echo $services;?>
						</div>
						<div class="desc-hotel" style="margin-bottom: 30px;">
						<h4>Esto es details</h4>
							<h4 class="cl-ok"><?php echo $GLOBALS['Hoteles_Details_About']; ?></h4>
							<p class="text-justify cl-gray">
								<?php echo $hoteles->Description;?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 cl-gray text-right">
					<?php echo "Búsqueda: ".$guetsStr.", ".$roomsStr.", ".utf8_encode($dateLargeFrom)." - ".utf8_encode($dateLargeTo)."<br>";?>
					<div class="hr-solid-wm-gray"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4 class="cl-ok"><?php echo $GLOBALS['_searcher_label_rooms']; ?></h4>
					<?php

					if(isset($hoteles->Error)){
						echo "<div class='noFound'>
						".$GLOBALS['Hoteles_Details_Search_Result']."
						</div>";
					}


					else
					{

						/*FOR WINDOWS - extension=ext/php_intl.dll
						$formatter = new NumberFormatter('es_MX', NumberFormatter::CURRENCY);
						$curr = 'MXN';*/
						/* FOR UBUNTU SERVER
						$priceNormal = money_format('%.2n', $hotel->Rooms[0]->MealPlans[0]->Normal);
						$priceOk = money_format('%.2n', $hotel->Rooms[0]->MealPlans[0]->AgencyPublic->AgencyPublic);
						*/
						$diff = $this->to->diff($this->from); /*direfencias en días coinciden con las noches alojadas*/

						$clubestrellaController = new clubestrellaController();

						foreach ($hoteles->Rooms as $room) {

							$priceOk = $room->MealPlans[0]->AgencyPublic->AgencyPublic;
							$priceOkPerNight = $priceOk/$diff->days;
							$tarifaNormal = $room->MealPlans[0]->Total;
							$policie = $room->MealPlans[0]->RateDetails->RateDetail->CancellationPolicy->Description;

							$precioClub = $clubestrellaController->showEstrella($tarifaNormal,$priceOk);

							/*$priceRoom = $formatter->formatCurrency($priceOkPerNight, $curr);
							$priceTotal = $formatter->formatCurrency($priceOk, $curr);
							$priceClub = $formatter->formatCurrency($precioClub, $curr);*/
							
							$priceRoom = money_format('%.2n', $priceOkPerNight);
							$priceTotal = money_format('%.2n', $priceOk);
							$priceClub = money_format('%.2n', $precioClub);


							echo "
							<div class='room-hotel'>
							<form id='reserveGet' action='/hoteles/reserve/".$GLOBALS['lang']."' method='GET'>
							<div class='row cl-gray'>
							<div class='col-md-3'>
							<img class='img-responsive center-block' src='".$room->ImageUrl."' alt='".$room->Name."'>
							</div>
							<div class='col-md-3 col-sm-12'>
							<h5 class='cl-ok'>".$room->Name."</h5>
							<p>
							".$GLOBALS['Hoteles_Details_Capacity']." <br>
							".$room->CapacityTotal." ".$GLOBALS['Hoteles_Details_People']." <br>
							</p>
							<p>
							".$room->RoomView."
							</p>
							<p>
							".$room->Bedding."
							</p>
							</div>
							<div class='col-md-1 col-sm-6'>
							<h5 class='cl-ok'>Plan</h5>
							<p>
							".$room->MealPlans[0]->Name."
							</p>
							</div>
							<div class='col-md-2 col-sm-6'>
							<h5 class='cl-ok'>Precio por noche</h5>
							<p>
							".$priceRoom." ".$GLOBALS['Hoteles_Currency']."
							</p>
							</div>
							<div class='col-md-1 col-sm-6'>
							<h5 class='cl-ok'>Noches</h5>
							".$diff->days."
							</div>
							<div class='col-md-2 col-sm-6'>
							<h5 class='cl-ok'>Total Oktrip</h5>
							".$priceTotal." ".$GLOBALS['Hoteles_Currency']." <br>";
							if ($precioClub !=0) {

								echo "<h5 class='cl-ok'>Total Clubestrella</h5>
								".$priceClub." ".$GLOBALS['Hoteles_Currency']." <br>";
							}
							echo "
							</div>
							</div>
							<div class='clearfix'></div>
							<div class='row'>
							<div class='col-md-7 col-md-push-3'>
								<h5 class='cl-ok'>".$GLOBALS['_searcher_label_policie']."</h5>
								<p class='cl-gray'>".$policie."</p>
							</div>
							<div class='col-md-2 col-md-push-3'>

							<input type='hidden' name='to' value='".$this->to->format('d/m/Y')."'>
							<input type='hidden' name='from' value='".$this->from->format('d/m/Y')."'>
							<input type='hidden' name='idDestiny' value='".$idCiudad."'>
							<input type='hidden' name='idHotel' value='".$idHotel."'>
							<input type='hidden' name='idRoom' value='".$room->Id."'>
							<input type='hidden' name='rooms' value='".$this->rooms."'>";

							for ($i=0; $i < $this->rooms ; $i++) { 
								echo "<input type='hidden' name='adults[".$i."]' value='".$this->adults[$i]."'>";
								echo "<input type='hidden' name='kids[".$i."]' value='".$this->kids[$i]."'>";

								for ($j=0; $j < 3; $j++) { 
									if(!empty($this->ageKids[$i][$j])){
										echo "<input type='hidden' name='ages[".$i."][".$j."]' value='".$this->ageKids[$i][$j]."'>";

									}
								}

							}

							echo "
							<button class='btn btn-ok btn-float' style='margin-top: 10px;' >".$GLOBALS['_searcher_label_reserve']."</button>
							</div>
							</div>
							</form>
							</div>
							<hr>";
						}
					}
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4 class="cl-ok"><?php echo $GLOBALS['Hoteles_Details_Facilities']; ?></h4>
					<ul class="cl-gray facilities-list">
						<?php
						if(!empty($hoteles->Facilities)){
							foreach ($hoteles->Facilities as $facility) {
								echo "<li>".$facility->Name."</li>";
							}
						}
						else
						{
							echo "<div class='noFound'>".$GLOBALS['Hoteles_Details_No_Facilities']."</div>";
						}
						?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4 class="cl-ok"><?php echo $GLOBALS['Hoteles_Details_Restaurants']; ?></h4>
					<p class="text-justify">
						<?php
						if (!empty($hoteles->Restaurants)) {
							foreach ($hoteles->Restaurants as $restaurant) {
								echo "<p class='cl-gray'><b>".$restaurant->Name.": </b></br>".$restaurant->Description."</p>";
							}
						}
						else
						{
							echo "<div class='cl-gray-s'>".$GLOBALS['Hoteles_Details_No_Restaurants']."</div>";
						}
						?>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h4 id="title-map" class="cl-ok"><?php echo $GLOBALS['Contact_address_map']; ?></h4>
					<div id="map" style="width: 100%; height: 600px; margin-bottom: 30px;">
					</div>
				</div>
			</div>
		</div>
		<?php include("views/partialViews/_loader-page.html"); ?>
		<?php include("views/partialViews/_footer.php"); ?>
		<?php include("views/partialViews/_landingScripts.html"); ?>
		<script type="text/javascript">

			$(document).ready(function(){

				var dateFrom = "<?php echo $this->from->format('d/m/Y');?>";
				var dateTo = "<?php echo $this->to->format('d/m/Y');?>";
				var rooms = <?php echo $this->rooms; ?>;

				$('#from, #from_').datetimepicker({
					format: 'DD/MM/YYYY',
					minDate: moment().add(1, 'day'),
					useCurrent: false
				}).val(dateFrom);

				$('#to, #to_').datetimepicker({
					format: 'DD/MM/YYYY',
					minDate: moment().add(2, 'day'),
					useCurrent: false
				}).val(dateTo);

				$("#from, #from_").on("dp.change", function (e) {
					$('#to, #to_').data("DateTimePicker").minDate(e.date.add(1, 'day'));
				});
				$("#to, #to_").on("dp.change", function (e) {
					$('#from, #from_').data("DateTimePicker").maxDate(e.date.subtract(1, 'day'));
				});

				var lang = readCookie("Lang");
				$.getJSON("/js/lang/"+lang+".json", function(aux){
					$("#btn-plus").on("click", function(){
						if(rooms < 3){
							var template = '<div id="room_'+rooms+'_"><div class="row"><div class="col-xs-6 half-input-r"><div class="form-group"><label for="adults_'+rooms+'">'+aux.searcher.adults+'</label><input id="adults_'+rooms+'" name="adults['+rooms+']" type="number" class="form-control" min="1" value="1" required><label for="adults_'+rooms+'" generated="true" class="error"></label></div></div><div class="col-xs-6 half-input-l"><div class="form-group"><label for="kids_'+rooms+'">'+aux.searcher.kids+'</label><input id="kids_'+rooms+'" name="kids['+rooms+']" type="number" class="form-control kids-d-'+rooms+'" min="0" value="0" required><label for="kids_'+rooms+'" generated="true" class="error"></label></div></div></div><div class="row"><div class="con-ages-'+rooms+'_"></div></div></div>';
							$(".con-rooms_").append(template);
							rooms++;
							$("#con-room").html(rooms);
							$("#rooms_").val(rooms);
							initKids(aux);
						}
					});
					$("#btn-minus").on("click", function(){
						if(rooms > 1){
							rooms--;
							$("#room_"+rooms+"_").remove();
							$("#room_"+rooms+"_").remove();
							$("#con-room").html(rooms);
							$("#rooms_").val(rooms);
							initKids(aux);
						}
					});
					initKids(aux);
				});
				initMap();

			});

			function initMap() {

				var myLatLng = {lat: <?php echo $hoteles->Latitude; ?>, lng: <?php echo $hoteles->Longitude; ?> };

				var map = new google.maps.Map(document.getElementById('map'), {
					center: myLatLng,
					zoom: 12
				});

				var pin = {
					url: "/img/iconos/pin-map-min.png",
					size: new google.maps.Size(60, 80)
				};

				var marker = new google.maps.Marker({
					map: map,
					position: { lat: <?php echo $hoteles->Latitude; ?>, lng: <?php echo $hoteles->Longitude; ?> },
					icon: pin,

					title: "<?php echo $hoteles->Name; ?>"
				});

			}

		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuPcjJM0GlcPgfN-woHfY2FnU_vRq8av4"></script>
	</body>
	</html>