<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Panel administrativo Oktrip! </title>
	<?php include("views/partialViews/_adminPanelStyles.html"); ?>

</head>

<body id="sale-details" class="nav-md">
	<div class="container body">
		<div class="main_container">

			<!-- sidebar -->
			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>

			<!-- top navigation -->
			<?php include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<ol class="breadcrumb">
							<li><a href="/home">Home</a></li>
							<li><a href="/ventas">Ventas</a></li>
							<li class="active">Detalles</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Datos de venta <small></small></h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="row">
									<div class="col-sm-4">

										<table class="table table-bordered">
											<thead>
												<tr>
													<td colspan="2" style="text-align: center;">
														<b>Datos de servicio</b>
													</td>
												</tr>
											</thead>
											<tbody>
												
												<?php

												$service = $sale->getService();
												//$to = DateTime::createFromFormat('Y-m-d H:i:s', $service->getDateTo());
												$to = $service->getDateTo();
												//$from = DateTime::createFromFormat('Y-m-d H:i:s', $service->getDateFrom());
												$from = $service->getDateFrom();

												echo "<tr>
												<td><b>Clave de venta: </b></td>
												<td>".$sale->getKey()."</td>
												</tr>
												<tr>
												<td><b>Servicio: </b></td>
												<td>".$service->getName()."</td>
												</tr>
												<tr>
												<td><b>Tipo de servicio: </b></td>
												<td>".$service->getTypeService()."</td>
												</tr>
												<tr>
												<td><b>Fecha de llegada: </b></td>
												<td>".$from."</td>
												</tr>
												<tr>
												<td><b>Fecha de salida: </b></td>
												<td>".$to."</td>
												</tr>
												<tr>
												<td><b>Comentarios: </b></td>
												<td>".$service->getComments()."</td>
												</tr>";

												switch ($service->getTypeService()) {

													case 'Hotel':
													echo 
													"<tr>
													<td><b>Id por HotelDo: </b></td>
													<td>".$service->getIdHotelDo()."</td>
													</tr>
													<tr>
													<td><b>Clave de servicio: </b></td>
													<td>".$service->getKey_()."</td>
													</tr>
													<tr>
													<td><b>Ciudad: </b></td>
													<td>".$service->getCity()."</td>
													</tr>
													<tr>
													<td><b>País: </b></td>
													<td>".$service->getCountry()."</td>
													</tr>
													<tr>
													<td><b>Cuartos: </b></td>
													<td>".$service->getNoRooms()."</td>
													</tr>
													<tr>
													<td><b>Alimento: </b></td>
													<td>".$service->getMealPlan()."</td>
													</tr>
													<tr>
													<td><b>Categoría: </b></td>
													<td>".$service->getCategoryRoom()."</td>
													</tr>
													<tr>
													<td><b>Huéspedes</b></td>
													<td>
													<ul style='padding-left: 20px;' >";

													$arrayRoom = json_decode($service->getRooms());
													echo $arrayRoom;
													/*
													for ($i=0; $i < count($arrayRoom) ; $i++) { 
														echo "<li>
														<b>Habitación ".($i+1)."</b><br>
														Adultos: ".$arrayRoom[$i]->adults."<br>
														Niños: ".$arrayRoom[$i]->kids."
														</li>";
													}*/
													echo "</ul>
													</td>
													</tr>";

													break;
													case 'Tour':

													$coupon = $service->getCoupon();

													echo "<tr>
													<td colspan='2' style='text-align: center;'>
													<b>Datos del cupón</b>
													</td>
													</tr>
													<tr>
													<td><b>Cupón: </b></td>
													<td>".$coupon->getName()."</td>
													</tr>
													<tr>
													<td><b>Clave de cupón:  </b></td>
													<td>".$coupon->getKey()."</td>
													</tr>
													<tr>
													<td><b>Proveedor:</b></td>
													<td>".$coupon->getProvider()."</td>
													</tr>
													<tr>
													<td><b>Hora de llegada: </b></td>
													<td>".$coupon->getHourPickup()."</td>
													</tr>
													<tr>
													<td><b>Hotel: </b></td>
													<td>".$coupon->getHotel()."</td>
													</tr>
													<tr>
													<td><b>Cuarto: </b></td>
													<td>".$coupon->getRoom()."</td>
													</tr>
													<tr>
													<td><b>Pasajeros: </b></td>
													<td>".$coupon->getNoPax()."</td>
													</tr>
													<tr>
													<td><b>Tarifa neta: </b></td>
													<td>".$coupon->getNetRate()."</td>
													</tr>
													<tr>
													<td><b>Tarifa pública: </b></td>
													<td>".$coupon->getPublicRate()."</td>
													</tr>
													<tr>
													<td><b>Pago: </b></td>
													<td>".$coupon->getPayment()."</td>
													</tr>
													<tr>
													<td><b>Comentarios: </b></td>
													<td>".$coupon->getComments()."</td>
													</tr>";

													break;
													case 'Transportación':
													$coupon = $service->getCoupon();

													echo "<tr>
													<td><b>Origen: </b></td>
													<td>".$service->getOrigin()."</td>
													</tr>
													<tr>
													<td><b>Destino: </b></td>
													<td>".$service->getDestiny()."</td>
													</tr>
													<tr>
													<td colspan='2'>
													<b>Datos del cupón</b>
													</td>
													</tr>
													<tr>
													<td><b>Cupón: </b></td>
													<td>".$coupon->getName()."</td>
													</tr>
													<tr>
													<td><b>Clave de cupón:  </b></td>
													<td>".$coupon->getKey()."</td>
													</tr>
													<tr>
													<td><b>Proveedor:</b></td>
													<td>".$coupon->getProvider()."</td>
													</tr>
													<tr>
													<td><b>Hora de llegada: </b></td>
													<td>".$coupon->getHourPickup()."</td>
													</tr>
													<tr>
													<td><b>Hotel: </b></td>
													<td>".$coupon->getHotel()."</td>
													</tr>
													<tr>
													<td><b>Cuarto: </b></td>
													<td>".$coupon->getRoom()."</td>
													</tr>
													<tr>
													<td><b>Pasajeros: </b></td>
													<td>".$coupon->getNoPax()."</td>
													</tr>
													<tr>
													<td><b>Tarifa neta: </b></td>
													<td>".$coupon->getNetRate()."</td>
													</tr>
													<tr>
													<td><b>Tarifa pública: </b></td>
													<td>".$coupon->getPublicRate()."</td>
													</tr>
													<tr>
													<td><b>Pago: </b></td>
													<td>".$coupon->getPayment()."</td>
													</tr>
													<tr>
													<td><b>Comentarios: </b></td>
													<td>".$coupon->getComments()."</td>
													</tr>";

													break;
													case 'Vuelo':

													echo "<tr>
													<td><b>Clave: </b></td>
													<td>".$service->getKey()."</td>
													</tr>
													<tr>
													<td><b>Aerolinea: </b></td>
													<td>".$service->getAirline()."</td>
													</tr>
													<tr>
													<td><b>Estado: </b></td>
													<td>".$service->getStatus()."</td>
													</tr>
													<tr>
													<td><b>Factura: </b></td>
													<td>".$service->getInvoice()."</td>
													</tr>
													<tr>
													<td><b>Fecha de llegada: </b></td>
													<td>".$service->getDateTo()."</td>
													</tr>
													<tr>
													<td><b>Fecha de salida: </b></td>
													<td>".$service->getDateFrom()."</td>
													</tr>";

													break;
													case 'Renta':

													echo "<tr>
													<td><b>Tipo de vehículo: </b></td>
													<td>".$service->getTypeVehicle()."</td>
													</tr>
													<tr>
													<td><b>Ciudad de llegada: </b></td>
													<td>".$service->getDeliveryCity()."</td>
													</tr>
													<tr>
													<td><b>Ciudad de vuelta: </b></td>
													<td>".$service->getReturnCity()."</td>
													</tr>";

													break;
													default:
													break;
												}

												?>
											</tbody>
										</table>
									</div>
									<div class="col-sm-4">
										<table class="table table-bordered">
											<thead>
												<tr>
													<td colspan="2" style="text-align: center;">
														<b>Datos de cliente</b>
													</td>
												</tr>
											</thead>
											<tbody>

												<?php 
												$customer = $sale->getCustomer();

												echo "<tr>
												<td><b>Nombre: </b></td>
												<td>".$customer->getName()."</td>
												</tr>
												<tr>
												<td><b>Apellido paterno: </b></td>
												<td>".$customer->getLastName()."</td>
												</tr>
												<tr>
												<td><b>Apellido materno: </b></td>
												<td>".$customer->getSecondLastName()."</td>
												</tr>
												<tr>
												<td><b>Teléfono: </b></td>
												<td>".$customer->getPhone()."</td>
												</tr>
												<tr>
												<td><b>Email: </b></td>
												<td>".$customer->getEmail()."</td>
												</tr>
												<tr>
												<td><b>País: </b></td>
												<td>".$customer->getCountry()."</td>
												</tr>
												<tr>
												<td><b>Estado: </b></td>
												<td>".$customer->getState()."</td>
												</tr>
												<tr>
												<td><b>Ciudad: </b></td>
												<td>".$customer->getCity()."</td>
												</tr>
												<tr>
												<td><b>Código postal: </b></td>
												<td>".$customer->getPostalCode()."</td>
												</tr>
												<tr>
												<td><b>Dirección: </b></td>
												<td>".$customer->getAddress()."</td>
												</tr>
												<tr>
												<td><b>Comentarios: </b></td>
												<td>".$customer->getComments()."</td>
												</tr>";

												?>
											</tbody>
										</table>
										<table class="table table-bordered">
											<thead>
												<tr>
													<td colspan="2" style="text-align: center;">
														<b>XML</b>
													</td>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?php echo  htmlentities(urldecode($sale->getXml())).""; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="col-sm-4">
										<table class="table table-bordered">
											<thead>
												<tr>
													<td colspan="2" style="text-align: center;">
														<b>Datos de pago</b>
													</td>
												</tr>
											</thead>
											<tbody>
												<?php 
												$payment = $sale->getPayment();
												echo "
												<tr>
												<td><b>Referencia: </b></td>
												<td>".$payment->getReference()."</td>
												</tr>
												<tr>
												<td><b>Total: </b></td>
												<td>".$payment->getTotal()."</td>
												</tr>
												<tr>
												<td><b>Subtotal: </b></td>
												<td>".$payment->getSubtotal()."</td>
												</tr>
												<tr>
												<td><b>Descuento: </b></td>
												<td>".$payment->getDiscount()."</td>
												</tr>
												<tr>
												<td><b>Método de pago: </b></td>
												<td>".$payment->getPaymentMethod()."</td>
												</tr>
												<tr>
												<td><b>Estado: </b></td>
												<td>".$payment->getStatus()."</td>
												</tr>
												<tr>
												<td><b>Moneda: </b></td>
												<td>".$payment->getCurrency()."</td>
												</tr>
												<tr>
												<td><b>Tipo de cambio: </b></td>
												<td>".$payment->getExchangeRate()."</td>
												</tr>
												";
												?>
											</tbody>
										</table>
										<table class="table table-bordered">
											<thead>
												<tr>
													<td colspan="2" style="text-align: center;">
														<b>Datos de comisión</b>
													</td>
												</tr>
											</thead>
											<tbody>
												<?php
												$commission = $sale->getCommission();
												if(!empty($commission))
												{	
													echo "<tr>
													<td><b>Representante: </b></td>
													<td>".$commission->getAgent_Id()->getName()."</td>
													</tr>
													<tr>
													<td><b>Comisión: </b></td>
													<td>".$commission->getCommission()."</td>
													</tr>";
												}
												else
												{
													echo "<tr>
													<td colspan='2' style='text-align: center;'>Sin datos</td>
													</tr>";
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4">

									</div>
								</div>									
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- footer content -->
			<footer>
				<div class="pull-right">
					Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
				</div>
				<div class="clearfix"></div>
			</footer>
		</div>
	</div>

	<?php include("views/partialViews/_adminPanelScripts.html"); ?>

</body>
</html>

