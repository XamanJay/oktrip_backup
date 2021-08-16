<!DOCTYPE html>
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>
</head>
<body id="home">
	<?php include("views/partialViews/_header.php"); ?>
	<div class="container-fluid banner">
		<div class="container">
			<div class="search-ok">
				<div id="tabs" class="row">
					<div class="col-md-2 col-xs-4" style="padding-right: 0px;">
						<ul class="nav nav-pills nav-stacked">
							<li class="active"><a href="#formSearch">Hoteles</a></li>
							<li><a href="#Paquetes">Paquetes</a></li>
							<li><a href="#Tours">Tours</a></li>
							<li><a href="#Traslados">Traslados</a></li>
							<li><a href="#Autos">Autos</a></li>
							<li><a href="#Grupos">Grupos</a></li>
						</ul>
					</div>
					<div class="col-md-10 col-xs-8" style="padding-left: 0px;">
						<div class="searcher-ok">
							<form id="formSearch" class="tab-pane fade in active" method="GET" action="/hoteles/search/">
								<div class="row">
									<div class="col-md-12">
										<div style="font-size: 24px;margin-top:10px;margin-bottom: 10px;">!Reserva tu hotel!</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label for="destiny">Destino / Hotel</label>
											<div class="input-group">
												<div class="input-group-addon">
													<img class="icon-small" src="/img/iconos/hotel-w.png" alt="">
												</div>
												<input id="destiny" name="destiny" type="text" onkeyup="refillDestiny(this);" class="form-control" placeholder="Busca tu ciudad y selecciona">
												<input id="idDestiny" name="idDestiny" type="hidden" >
											</div>
										</div>
										<div class="form-group col-md-6 half-input-r">
											<label for="from">Llegada</label>
											<div class="input-group">
												<div class="input-group-addon">
													<img class="icon-small" src="/img/iconos/calendario-e.png" alt="">
												</div>
												<input id="from" name="from" class="form-control datepicker" placeholder="dd/mm/aaaa" type="text">
											</div>
											<label for="from" generated="true" class="error"></label>
										</div>
										<div class="form-group col-md-6 half-input-l">
											<label for="to">Salida</label>
											<div class="input-group">
												<div class="input-group-addon">
													<img class="icon-small" src="/img/iconos/calendario-s.png" alt="">
												</div>
												<input id="to" name="to" class="form-control datepicker" placeholder="dd/mm/aaaa" type="text">
											</div>
											<label for="to" generated="true" class="error"></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="rooms" >Cuartos</label>
											<select id="rooms" name="rooms" class="form-control">
												<option value="1" selected>1</option>
												<option value="2">2</option>
												<option value="3">3</option>
											</select>
										</div>
										<div class="form-group min">
											<div class="row" style="padding: 0px 15px;">
												<div class="col-md-6 col-xs-6 half-input-r">
													<label for="adults_0">Adultos</label>
													<input id="adults_0" name="adults[0]" class="form-control" type="number" min="1" value="1">
												</div>
												<div class="col-md-6 col-xs-6 half-input-l">
													<label for="kids_0">Niños</label>
													<input id="kids_0" name="kids[0]" class="form-control" type="number" min="0" value="0">
												</div>
												<label for="adults_0" generated="true" class="error"></label><br>
												<label for="kids_0" generated="true" class="error"></label>
												<div class="con-rooms"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="hr-solid"></div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group col-md-6 half-input-r">
											<label for="coupon">¿Tienes un cupón?</label>
											<div class="input-group">
												<div class="input-group-addon">
													<img class="icon-small" src="/img/iconos/etiqueta-inv.png" alt="">
												</div>
												<input id="coupon" name="coupon" type="text" class="form-control">
											</div> 
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-spacing"></div>
										<div class="form-group">
											<button class="btn btn-default form-control">Buscar</button>
										</div>
									</div>
								</div>
							</form>
							<form class="tab-pane fade" id="Paquetes">Paquetes</form>
							<form class="tab-pane fade" id="Tours">Tours</form>
							<form class="tab-pane fade" id="Traslados">Traslados</form>
							<form class="tab-pane fade" id="Autos">Autos</form>
							<form class="tab-pane fade" id="Grupos">Grupos</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row" style="margin-bottom: 25px;">
			<div class="col-md-12 col-banner">
				<div class="owl-carousel owl-theme">
					<div class="item">
						<img class="img-responsive" src="/img/banners/BancoIcon.png" alt="">
					</div>
					<div class="item">
						<img class="img-responsive" src="/img/banners/BancoIcon.png" alt="">
					</div>
					<div class="item">
						<img class="img-responsive" src="/img/banners/BancoIcon.png" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom: 40px;">
			<div class="col-items-icons">

				<!-- Alcancía -->
				<div class="row">
					<div class="col-sm-3 col-sm-12 icon">
						<img class="img-responsive" src="/img/iconos/alcancia.png" alt="">
					</div>
					<div class="col-sm-9 col-sm-12 middle-vertical">
						<div class="txt-l">
							Los precios más bajos garantizados
						</div>
						<div class="txt-sm">
							Contamos con atención personalizada a nuestros clientes.
						</div>
					</div>
				</div>
				<!-- Clubestrella -->
				<div class="row">
					<div class="col-sm-3 col-sm-12 icon">
						<img class="img-responsive" src="/img/logos/ClubestrellaIcon2.png" alt="">
					</div>
					<div class="col-sm-9 col-sm-12 middle-vertical">
						<div class="txt-l">
							Únete a nuestro club de lealtad
						</div>
						<div class="txt-sm">
							Acumula puntos para recibir recompensas Club Estrella.
						</div>
					</div>
				</div>
				<!-- Tarifas -->
				<div class="row">
					<div class="col-sm-3 col-sm-12 icon">
						<img class="img-responsive" src="/img/iconos/hotel.png" alt="">
					</div>
					<div class="col-sm-9 col-sm-12 middle-vertical">
						<div class="txt-l">
							Las mejores tarifas en Hoteles
						</div>
						<div class="txt-sm">
							Precios accesibles para todos.
						</div>
					</div>
				</div>
				<!-- sin-cargos -->
				<div class="row">
					<div class="col-sm-3 col-sm-12 icon">
						<img class="img-responsive" src="/img/iconos/lupa.png" alt="">
					</div>
					<div class="col-sm-9 col-sm-12 middle-vertical">
						<div class="txt-l">
							Sin cargos ocultos
						</div>
						<div class="txt-sm">
							Nuestros precios incluyen todos los impuestos.
						</div>
					</div>
				</div>
			</div>
			<div class="col-banner-vertical">
				<img class="img-responsive" src="/img/banners/BannerOkTrip.jpg" alt="">
			</div>
		</div>
		<div class="hr-solid-ok"></div>
		<div class="destinies">
			<div class="row">
				<div class="col-md-12">
					<div class="title">Ofertas destacadas</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="bann-r">
						<a href="#"><img class="img-responsive" src="/img/banners/san-lucas.png" alt=""></a>
						<div class="txt-des">
							Reserva desde nuestro sitio www.oktrip.com y obtén beneficios adicionales como transportación Aeropuerto - Hotel y/o Hotel - Aeropuerto, puntos Club Estrella y ¡Muchos más!
						</div>
					</div>
					<div class="bann-r">
						<a href="#"><img class="img-responsive" src="/img/banners/punta-cana.png" alt=""></a>
						<div class="txt-des">
							Reserva desde nuestro sitio www.oktrip.com y obtén beneficios adicionales como transportación Aeropuerto - Hotel y/o Hotel - Aeropuerto, puntos Club Estrella y ¡Muchos más!
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">

					<div class="bann-m">
						<a href="#"><img class="img-responsive" src="/img/banners/zacatecas.png" alt=""></a>
						<div class="txt-des">
							Reserva desde nuestro sitio www.oktrip.com y obtén beneficios adicionales como transportación Aeropuerto - Hotel y/o Hotel - Aeropuerto, puntos Club Estrella y ¡Muchos más!
						</div>
					</div>
					<div class="bann-m">
						<a href="#"><img class="img-responsive" src="/img/banners/playa-carmen.png" alt=""></a>
						<div class="txt-des">
							Reserva desde nuestro sitio www.oktrip.com y obtén beneficios adicionales como transportación Aeropuerto - Hotel y/o Hotel - Aeropuerto, puntos Club Estrella y ¡Muchos más!
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="bann-l">
						<a href="#"><img class="img-responsive" src="/img/banners/tepoztlan.png" alt=""></a>
						<div class="txt-des">
							Reserva desde nuestro sitio www.oktrip.com y obtén beneficios adicionales como transportación Aeropuerto - Hotel y/o Hotel - Aeropuerto, puntos Club Estrella y ¡Muchos más!
						</div>
					</div>
					<div class="bann-l">
						<a href="#"><img class="img-responsive" src="/img/banners/eua.png" alt=""></a>
						<div class="txt-des">
							Reserva desde nuestro sitio www.oktrip.com y obtén beneficios adicionales como transportación Aeropuerto - Hotel y/o Hotel - Aeropuerto, puntos Club Estrella y ¡Muchos más!
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="hr-solid-ok"></div>
		<div class="row">
			<div class="col-md-12 col-banner">
				<img class="img-responsive" src="/img/banners/OktripTransporte.png" alt="">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 more-options">
				<button class="btn btn-ok center-block">Más opciones</button>
			</div>
		</div>
	</div>
	<?php include("views/partialViews/_footer.php"); ?>
	<?php include("views/partialViews/_landingScripts.html"); ?>
</body>
</html>