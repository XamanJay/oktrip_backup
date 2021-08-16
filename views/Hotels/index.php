<!DOCTYPE html>
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>

</head>
<body id="hoteles">
	<?php include("views/partialViews/_header.php"); ?>
	<div class="container-fluid banner">
		<div class="owl-carousel owl-theme hidden-xs" id="new_banner">
		    <div class="item"><img src="/img/new_items/banner_1.png" alt=""></div>
		    <div class="item"><img src="/img/new_items/banner_2.png" alt=""></div>
		    <div class="item"><img src="/img/new_items/banner_3.png" alt=""></div>
		</div>

		<div class="owl-carousel owl-theme visible-xs" id="new_banner_mob">
		    <div class="item"><img src="/img/new_items/mob.png" alt=""></div>
		    <div class="item"><img src="/img/new_items/mob_2.png" alt=""></div>
		    <div class="item"><img src="/img/new_items/mob_3.png" alt=""></div>
		</div>
		
		<div class="row" id="cont_search">
			<?php include("views/partialViews/_searcher.php"); ?>
		</div>

	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="cl-ok" style="margin-bottom: 50px; margin-left: 30px;"><?php echo $GLOBALS['Hoteles_Index_title']; ?></h3>
			</div>
		</div>
		<!-- Hotel Adhara -->
		<div class="row">
			<div class="col-md-4">
				<img class="img-responsive center-block img-side-left" src="/img/banners/adhara.jpg" alt="Hotel Adhara">
				<img class="img-responsive center-block img-side-left" src="/img/places/adhara-room.png" alt="Hotel Margaritas">
				<img class="img-responsive center-block img-side-left" src="/img/places/adhara-pool.png" alt="Hotel Ramada">
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-sm-10">
						<p style="margin-bottom: 20px; color: #777;">
							<span class="cl-ok" style="font-size: 25px;"><?php echo $GLOBALS['Hoteles_Index_Adhara_title']; ?></span>&nbsp;&nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star-o star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star-o star-hotel" aria-hidden="true"></i> &nbsp;
							<br>

							<a class='style-none cl-gray-s' style="cursor: pointer;" onclick='initMap(0);'>
								<i class="fa x20 fa-map-marker cl-ok" aria-hidden="true"></i><?php echo $GLOBALS['Hoteles_Index_lbl_location']; ?>
							</a>

						</p>
					</div>
					<div class="col-sm-2">
						<a href="<?php echo $GLOBALS['Home_url_adhara'];?>" class="btn btn-ok pull-right link-hotel">
							<?php echo $GLOBALS['Hoteles_Index_btn_reserve']; ?>
						</a>
					</div>
				</div>
				<p style="margin-top: 10px;">
					<span class="subtitle"><?php echo $GLOBALS['Hoteles_Index_about_title']; ?></span>&nbsp;&nbsp;
				</p>
				<p class="text-justify txt-des">
					<?php echo $GLOBALS['Hoteles_Index_Adhara_txt_about']; ?>
				</p>
				<p class="text-justify txt-des" >
					<?php echo $GLOBALS['Hoteles_Index_Adhara_txt_about_2']; ?>
				</p>

				<div class="row">
					<div class="col-md-12" style="margin-top: 30px;">
						<p class="subtitle">
							<?php echo $GLOBALS['Hoteles_Index_ser_title']; ?>
						</p>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/wifi.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_1']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/padlock.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_2']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/laundry.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_3']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/elevator.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_4']; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top: 30px;">
						<p class="subtitle">
							<?php echo $GLOBALS['Hoteles_Index_res_title']; ?>
						</p>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/restaurant.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_res_opt_1']; ?>
						</div>
						<div class="item-img" style="line-height: 25px;">
							<img class="img-responsive img-align-left" src="/img/iconos/yard.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_res_opt_2']; ?>
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 30px; margin-top: 30px;">
					<div class="col-md-12">
						<p class="subtitle">
							<?php echo $GLOBALS['Hoteles_Index_fac_title']; ?>
						</p>
					</div>
					<div class="col-md-6">
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/pool.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_1']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/car.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_2']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/gym.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_3']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/cup.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_4']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/meeting.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_5']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsve img-align-left" src="/img/iconos/event.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_6']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Hotel Ramada -->
		<div class="row" style="margin-bottom: 50px;">
			<div class="col-md-4">
				<img class="img-responsive center-block img-side-left" src="/img/banners/ramada.jpg" alt="Hotel Adhara">
				<img class="img-responsive center-block img-side-left" src="/img/places/ramada-pool.png" alt="Hotel Margaritas">
				<img class="img-responsive center-block img-side-left" src="/img/places/ramada-room.png" alt="Hotel Ramada">
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-sm-10">
						<p style="margin-bottom: 20px; color: #777;">
							<span class="cl-ok" style="font-size: 25px;"><?php echo $GLOBALS['Hoteles_Index_ramada_title']; ?></span>&nbsp;&nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star-half-o star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star-o star-hotel" aria-hidden="true"></i> &nbsp;
							<i class="fa x20 fa-star-o star-hotel" aria-hidden="true"></i> &nbsp;
							<br>
							<a class='style-none cl-gray-s' style="cursor: pointer;" onclick='initMap(2);'>
								<i class="fa x20 fa-map-marker cl-ok" aria-hidden="true"></i><?php echo $GLOBALS['Hoteles_Index_lbl_location']; ?>
							</a>
						</p>
					</div>
					<div class="col-sm-2">
						<a href="<?php echo $GLOBALS['Home_url_ramada'];?>" class="btn btn-ok pull-right link-hotel">
							<?php echo $GLOBALS['Hoteles_Index_btn_reserve']; ?>
						</a>
					</div>
				</div>
				<p style="margin-top: 10px;">
					<span class="subtitle"><?php echo $GLOBALS['Hoteles_Index_about_title']; ?></span>&nbsp;&nbsp;

				</p>
				<p class="text-justify txt-des">
					<?php echo $GLOBALS['Hoteles_Index_ramada_txt_about']; ?>
				</p>
				<p class="text-justify txt-des">
					<?php echo $GLOBALS['Hoteles_Index_ramada_txt_about_2']; ?>
				</p>

				<div class="row">
					<div class="col-md-6" style="margin-top: 30px;">
						<p class="subtitle">
							<?php echo $GLOBALS['Hoteles_Index_ser_title']; ?>
						</p>
						<div class="item-img">
							<img class="img-responsive img-align-left" src="/img/iconos/wifi.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_1']; ?>
						</div>
						<div class="item-img">
							<img class="img-responsive img-align-left" src="/img/iconos/padlock.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_2']; ?>
						</div>
						<div class="item-img">
							<img class="img-responsive img-align-left" src="/img/iconos/laundry.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_3']; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top: 30px;">
						<p class="subtitle">
							<?php echo $GLOBALS['Hoteles_Index_res_title']; ?>
						</p>
						<div class="item-img" style="line-height: 25px;">
							<img class="img-responsive img-align-left" src="/img/iconos/restaurant.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_res_opt_3']; ?>
							
						</div>
					</div>
				</div>
				<div class="row" style="margin-bottom: 40px;margin-top: 30px;">
					<div class="col-md-12">
						<p class="subtitle">
							<?php echo $GLOBALS['Hoteles_Index_fac_title']; ?>
						</p>
					</div>
					<div class="col-md-12">

						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/pool.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_1']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/gym.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_3']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/meeting.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_5']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsive img-align-left" src="/img/iconos/cup.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_4']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsve img-align-left" src="/img/iconos/event.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_fac_opt_6']; ?>
						</div>
						<div class="item-img" >
							<img class="img-responsve img-align-left" src="/img/iconos/elevator.svg" alt="" > 
							<?php echo $GLOBALS['Hoteles_Index_ser_opt_4']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modalMap" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Locación por hotel</h4>
				</div>
				<div class="modal-body">
					<div id="mapHotel" style="width: 100%; height: 500px;"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<?php include("views/partialViews/_loader-page.html"); ?>
	<?php include("views/partialViews/_footer.php"); ?>
	<?php include("views/partialViews/_landingScripts.html"); ?>
	<script>
		var locations = new Array(
		{
			name: 'Hotel Adhara Hacienda Cancún', 
			stars: '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i>', 
			trip: '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> 3.5 / 5 </span>',
			address: 'Cancún, Zona centro',
			lat: 21.168369293213,
			lng: -86.824104309082 
		}, 
		{
			name: 'Hotel Margaritas Cancún', 
			stars: '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i>', 
			trip: '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> 3.5 / 5 </span>',
			address: 'Cancún, Zona centro',
			lat: 21.167891,
			lng: -86.824279 
		},
		{
			name: 'Hotel Ramada Cancún', 
			stars: '<i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star star-hotel" aria-hidden="true"></i><i class="fa fa-star-half-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i><i class="fa fa-star-o star-hotel" aria-hidden="true"></i>', 
			trip: '<i class="fa fa-tripadvisor" aria-hidden="true"></i> <span style="color:green;" title="TripAdvisor"> 4 / 5 </span>',
			address: 'Cancún, Zona centro',
			lat: 21.162914,
			lng: -86.829325 
		});

		$(document).ready(function(){

			var height_banner = $(".banner").height();
			var height_tabs = $(".search-ok").height();

			var aux = height_banner - height_tabs;
			var margin = aux/2;

			$(".search-ok").css({"margin-top" : margin , "margin-bottom" : margin });

			//initMap();

		});
		function initMap(hotel) {

			var pin = {
				url: "/img/iconos/pin-map-min.png",
				size: new google.maps.Size(60, 80)
			};
			var infowindow = new google.maps.InfoWindow();

			setTimeout(
				function(){

					var map = new google.maps.Map(document.getElementById("mapHotel"), {
						center: { lat: locations[hotel].lat, lng: locations[hotel].lng} ,
						zoom: 12
					});

					var marker = new google.maps.Marker({
						map: map,
						position: { lat: locations[hotel].lat , lng: locations[hotel].lng },
						icon: pin,
						title: locations[hotel].name
					});


					google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {

							infowindow.setContent( '<div style="width:300px;padding:20px;"><div class="row"><p id="setName">Hotel: '+locations[hotel].name+'</p><div class="col-xs-6 col-md-6 col-sm-6">'+locations[hotel].stars+'</div><div class="col-xs-6 col-md-6 col-sm-6">'+locations[hotel].trip+'</div><div class="col-xs-12 col-md-12 col-sm-12">'+locations[hotel].address+'</div></div></div>');
							infowindow.open(map, marker);
						}
					})(marker, hotel));

					$("#modalMap .modal-title").html(locations[hotel].name);

				}, 300);

			$('#modalMap').modal();

		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuPcjJM0GlcPgfN-woHfY2FnU_vRq8av4"></script>
</body>
</html>