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
							<li class="active">Editar</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_content">
								<form id="saleEditForm" method="POST" action="/ventas/editar" >
									<?php

									$service = $sale->getService();
									$customer = $sale->getCustomer();
									$payment = $sale->getPayment();
									$commission = $sale->getCommission();

									//$to = DateTime::createFromFormat('Y-m-d H:i:s', $service->getDateTo());
									$to = $service->getDateTo();
									//$from = DateTime::createFromFormat('Y-m-d H:i:s', $service->getDateFrom());
									$from = $service->getDateFrom();
									$dateSale = DateTime::createFromFormat('Y-m-d H:i:s', $sale->getDate());

									?>

									<!-- Apartado de servicios -->
									<div class="row">
										<div class="col-md-3">
											<h3>Datos del venta</h3>
												<hr>
											<input id="sale_id" name="sale[id]" type="hidden" value="<?php echo $sale->getId();?>">
											<div class="form-group">
												<label for="">Fecha y hora del servicio</label>
												<input id="sale_date" name="sale[date]" class="form-control" type="date" value="<?php echo $dateSale->format('Y-m-d');?>">
											</div>
											<div class="form-group hidden">
												<input id="sale_hour" name="sale[hour]" class="form-control" type="time" value="<?php echo $dateSale->format('H:i:s');?>">
											</div>
											<div class="form-group">
												<label for="">Proveedor</label>
												<input id="sale_provider" name="sale[provider]" class="form-control" type="text" value="<?php echo $sale->getProvider()?>">
											</div>
											<div class="form-group">
												<label for="">Xml</label>
												<?php

												if(!empty($sale->getXml()))
												{
													echo $sale->getXml();
												}
												else
												{
													echo '<div style="width: 100%; background-color: #f5f5f5; height: auto; padding: 20px; color: #ccc; text-align:center; font-size: 24px; margin-bottom: 15px;">Sin dato</div>';
												}

												?>
											</div>
										</div>
										<?php

										if(!empty($commission))
										{

											$agentSelected = $commission->getAgent_Id();

											echo '<div class="col-md-3">
											<h3>Datos de comisión (Reps)</h3>
											<hr>
											<div class="form-group">
											<label for="">Comisión: </label>
											<input id="commission_commission" name="commission[commission]" class="form-control" type="text" value="'.$commission->getCommission().'">
											</div>
											<div class="form-group">
											<label for="">Representante</label>
											<select id="commission_rep_id" name="commission[rep_id]" class="form-control">';
											foreach ($agents as $agent) {
												if($agent->getId() == $agentSelected->getId())
												{
													echo '<option value="'.$agent->getId().'" selected>'.$agent->getName().'</option>';
												}
												else
												{
													echo '<option value="'.$agent->getId().'">'.$agent->getName().'</option>';

												}
											}

											echo '</select>
											</div>
											</div>';
										}
										else
										{

											echo '<div class="col-md-12">
											<div style="width: 100%; background-color: #f5f5f5; height: auto; padding: 20px; color: #ccc; text-align:center; font-size: 24px; margin-bottom: 15px;">
											Sin datos
											</div>
											</div>';
										}

										?> 

										<!-- Apartado de servicios -->
										<div class="col-md-3">
											<h3>Datos del servicio</h3>
											<hr>
											<div class="form-group">
												<label for="">Tipo de servicio: <?php echo $service->getTypeService(); ?></label>
											</div>
											<div class="form-group">
												<label for="">Nombre del servicio</label>
												<input id="service_name" name="service[name]" class="form-control" type="text" value="<?php echo $service->getName();?>">
											</div>
											<div class="form-group">
												<label for="">Fecha de llegada</label>
												<input id="service_from" name="service[from]" class="form-control" type="date" value="<?php echo $from;?>">
											</div>
											<div class="form-group">
												<label for="">Fecha de salida</label>
												<input id="service_to" name="service[to]" class="form-control" type="date" value="<?php echo $to;?>">
											</div>
											<div class="form-group">
												<label for="">Número de personas</label>
												<input id="service_to" name="service[nopeople]" class="form-control" type="number" value="<?php echo $service->getNoPeople();?>">
											</div>
											<div class="form-group">
												<label for="">Comentarios</label>
												<textarea id="service_comments" name="service[comments]" class="form-control" cols="30" rows="5" value=""><?php echo $service->getComments();?></textarea>
											</div>

										</div>
										<div class="col-md-3">
											<?php
											switch ($service->getTypeService()) {

												case 'Hotel':

												echo '<div class="form-group">
												<label for="" class="hidden">Id por HotelDo</label>
												<input id="service_idHotelDo" name="service[idhoteldo]" class="hidden" type="text" value="'.$service->getIdHotelDo().'">
												</div>
												<div class="form-group">
												<label for="">Clave de servicio</label>
												<input id="service_key" name="service[key]" class="form-control" type="text" value="'.$service->getKey_().'">
												</div>
												<div class="form-group">
												<label for="">Ciudad</label>
												<input id="service_city" name="service[city]" class="form-control" type="text" value="'.$service->getCity().'">
												</div>
												<div class="form-group">
												<label for="">País</label>
												<input id="service_country" name="service[country]" class="form-control" type="text" value="'.$service->getCountry().'">
												</div>
												<div class="form-group">
												<label for="">Cuartos</label>
												<input id="service_norooms" name="service[norooms]" class="form-control" type="text" value="'.$service->getNoRooms().'">
												</div>
												<div class="form-group">
												<label for="">Alimento</label>
												<input id="service_mealplan" name="service[mealplan]" class="form-control" type="text" value="'.$service->getMealPlan().'">
												</div>
												<div class="form-group">
												<label for="">Categoría</label>
												<input id="service_categoryroom" name="service[categoryroom]" class="form-control" type="text" value="'.$service->getCategoryRoom().'">
												</div>';

												break;
												case 'Tour':

												$coupon = $service->getCoupon();

												echo '<div class="form-group">
												<label for="">Datos de cupón</label>
												</div>
												<div class="form-group">
												<label for="">Cupón</label>
												<input id="coupon_name" name="coupon[name]" class="form-control" type="text" value="'.$coupon->getName().'">
												</div>
												<div class="form-group">
												<label for="">Clave de cupón</label>
												<input id="coupon_key" name="coupon[key]" class="form-control" type="text" value="'.$coupon->getKey_().'">
												</div>
												<div class="form-group">
												<label for="">Proveedor</label>
												<input id="coupon_provider" name="coupon[provider]" class="form-control" type="text" value="'.$coupon->getProvider().'">
												</div>
												<div class="form-group">
												<label for="">Hora de llegada</label>
												<input id="coupon_hourpickup" name="coupon[hourpickup]" class="form-control" type="text" value="'.$coupon->getHourPickup().'">
												</div>
												<div class="form-group">
												<label for="">Hotel</label>
												<input id="coupon_hotel" name="coupon[hotel]" class="form-control" type="text" value="'.$coupon->getHotel().'">
												</div>
												<div class="form-group">
												<label for="">Cuarto</label>
												<input id="coupon_room" name="coupon[room]" class="form-control" type="text" value="'.$coupon->getRoom().'">
												</div>
												<div class="form-group">
												<label for="">Pasajeros</label>
												<input id="coupon_nopax" name="coupon[nopax]" class="form-control" type="text" value="'.$coupon->getNoPax().'">
												</div>
												<div class="form-group">
												<label for="">Tarifa neta</label>
												<input id="coupon_netrate" name="coupon[netrate]" class="form-control" type="text" value="'.$coupon->getNetRate().'">
												</div>
												<div class="form-group">
												<label for="">Tarifa pública</label>
												<input id="coupon_publicrate" name="coupon[publicrate]" class="form-control" type="text" value="'.$coupon->getPublicRate().'">
												</div>
												<div class="form-group">
												<label for="">Pago</label>
												<input id="coupon_payment" name="coupon[payment]" class="form-control" type="text" value="'.$coupon->getPayment().'">
												</div>
												<div class="form-group">
												<label for="">Comentarios</label>
												<textarea id="coupon_comments" name="coupon[comments]" class="form-control" cols="30" rows="10" value="">'.$coupon->getComments().'</textarea>
												</div>';

												break;
												case 'Transportación':
												/*$coupon = $service->getCoupon();

												echo '<div class="form-group">
												<label for="">Datos de Transportación</label>
												</div>
												<div class="form-group">
												<label for="">Clave de transportación</label>
												<input id="service_key" name="service[key]" class="form-control" type="text" value="'.$service->getKey().'">
												</div>
												<div class="form-group">
												<label for="">Origen</label>
												<input id="service_origin" name="service[origin]" class="form-control" type="text" value="'.$service->getOrigin().'">
												</div>
												<div class="form-group">
												<label for="">Destino</label>
												<input id="service_destiny" name="service[destiny]" class="form-control" type="text" value="'.$service->getDestiny().'">
												</div>
												<div class="form-group">
												<label for="">Datos de cupón</label>
												</div>
												<div class="form-group">
												<label for="">Cupón</label>
												<input id="coupon_name" name="coupon[name]" class="form-control" type="text" value="'.$coupon->getName().'">
												</div>
												<div class="form-group">
												<label for="">Clave de cupón</label>
												<input id="coupon_key" name="coupon[key]" class="form-control" type="text" value="'.$coupon->getKey().'">
												</div>
												<div class="form-group">
												<label for="">Proveedor</label>
												<input id="coupon_provider" name="coupon[provider]" class="form-control" type="text" value="'.$coupon->getProvider().'">
												</div>
												<div class="form-group">
												<label for="">Hora de llegada</label>
												<input id="coupon_hourpickup" name="coupon[hourpickup]" class="form-control" type="text" value="'.$coupon->getHourPickup().'">
												</div>
												<div class="form-group">
												<label for="">Hotel</label>
												<input id="coupon_hotel" name="coupon[hotel]" class="form-control" type="text" value="'.$coupon->getHotel().'">
												</div>
												<div class="form-group">
												<label for="">Cuarto</label>
												<input id="coupon_room" name="coupon[room]" class="form-control" type="text" value="'.$coupon->getRoom().'">
												</div>
												<div class="form-group">
												<label for="">Pasajeros</label>
												<input id="coupon_nopax" name="coupon[nopax]" class="form-control" type="text" value="'.$coupon->getNoPax().'">
												</div>
												<div class="form-group">
												<label for="">Tarifa neta</label>
												<input id="coupon_netrate" name="coupon[netrate]" class="form-control" type="text" value="'.$coupon->getNetRate().'">
												</div>
												<div class="form-group">
												<label for="">Tarifa pública</label>
												<input id="coupon_publicrate" name="coupon[publicrate]" class="form-control" type="text" value="'.$coupon->getPublicRate().'">
												</div>
												<div class="form-group">
												<label for="">Pago</label>
												<input id="coupon_payment" name="coupon[payment]" class="form-control" type="text" value="'.$coupon->getPayment().'">
												</div>
												<div class="form-group">
												<label for="">Comentarios</label>
												<textarea id="coupon_comments" name="coupon[comments]" class="form-control" cols="30" rows="10" value="">'.$coupon->getComments().'</textarea>
												</div>';*/

												break;
												case 'Vuelo':

												echo '<div class="form-group">
												<label for="">Datos de vuelo</label>
												</div>
												<div class="form-group">
												<label for="">Clave de vuelo</label>
												<input id="service_key" name="service[key]" class="form-control" type="text" value="'.$service->getKey().'">
												</div>
												<div class="form-group">
												<label for="">Aerolinea</label>
												<input id="service_airline" name="service[airline]" class="form-control" type="text" value="'.$service->getAirline().'">
												</div>
												<div class="form-group">
												<label for="">Estado</label>
												<input id="service_status" name="service[status]" class="form-control" type="text" value="'.$service->getStatus().'">
												</div>
												<div class="form-group">
												<label for="">Factura</label>
												<input id="service_invoice" name="service[invoice]" class="form-control" type="text" value="'.$service->getInvoice().'">
												</div>
												<div class="form-group">
												<label for="">Fecha de llegada</label>
												<input id="service_dateto" name="service[dateto]" class="form-control" type="text" value="'.$service->getDateTo().'">
												</div>
												<div class="form-group">
												<label for="">Fecha de salida</label>
												<input id="service_datefrom" name="service[datefrom]" class="form-control" type="text" value="'.$service->getDateFrom().'">
												</div>';

												break;
												case 'Renta':

												echo '<div class="form-group">
												<label for="">Datos de renta</label>
												</div>
												<div class="form-group">
												<label for="">Tipo de vehículo</label>
												<input id="service_typevehicle" name="service[typevehicle]" class="form-control" type="text" value="'.$service->getTypeVehicle().'">
												</div>
												<div class="form-group">
												<label for="">Ciudad de llegada</label>
												<input id="service_deliverycity" name="service[deliverycity]" class="form-control" type="text" value="'.$service->getDeliveryCity().'">
												</div>
												<div class="form-group">
												<label for="">Ciudad de vuelta</label>
												<input id="service_returncity" name="service[returncity]" class="form-control" type="text" value="'.$service->getReturnCity().'">
												</div>';

												break;
												default:
												break;
											}

											?>
										</div>

									</div>
									<!-- Apartado de cliente -->
									<div class="row" style="margin-top: 20px;">
										<div class="col-md-6">
											<h3>Datos del cliente</h3>
											<hr>
										</div>
										<div class="col-md-6">
											<h3>Datos del pago</h3>
											<hr>
										</div>
										<div class="col-md-3">
											
											<div class="form-group">
												<label for="">Nombre del cliente</label>
												<input id="customer_name" name="customer[name]" class="form-control" type="text" value="<?php echo $customer->getName();?>">
											</div>
											<div class="form-group">
												<label for="">Apellido paterno</label>
												<input id="customer_lastname" name="customer[lastname]" class="form-control" type="text" value="<?php echo $customer->getLastName();?>">
											</div>
											<div class="form-group">
												<label for="">Apellido materno</label>
												<input id="customer_secondlastname" name="customer[secondlastname]" class="form-control" type="text" value="<?php echo $customer->getSecondLastName();?>">
											</div>
											<div class="form-group">
												<label for="">Correo electrónico</label>
												<input id="customer_email" name="customer[email]" class="form-control" type="text" value="<?php echo $customer->getEmail();?>">
											</div>
											<div class="form-group">
												<label for="">Teléfono</label>
												<input id="customer_phone" name="customer[phone]" class="form-control" type="text" value="<?php echo $customer->getPhone();?>">
											</div>

										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="">Ciudad</label>
												<input id="customer_city" name="customer[city]" class="form-control" type="text" value="<?php echo $customer->getCity();?>">
											</div>
											<div class="form-group">
												<label for="">Código postal</label>
												<input id="customer_postalcode" name="customer[postalcode]" class="form-control" type="text" value="<?php echo $customer->getPostalCode();?>">
											</div>
											<div class="form-group">
												<label for="">Dirección</label>
												<input id="customer_address" name="customer[address]" class="form-control" type="text" value="<?php echo $customer->getAddress();?>">
											</div>
											<div class="form-group">
												<label for="">País</label>
												<input id="customer_country" name="customer[country]" class="form-control" type="text" value="<?php echo $customer->getCountry();?>">
											</div>
											<div class="form-group">
												<label for="">Estado</label>
												<input id="customer_state" name="customer[state]" class="form-control" type="text" value="<?php echo $customer->getState();?>">
											</div>
											<div class="form-group" style="display: none;">
												<label for="">Comentarios</label>
												<textarea id="customer_comments" name="customer[comments]" class="form-control" cols="30" rows="10" value=""><?php echo $customer->getComments();?></textarea>
											</div>
										</div>
										<!-- Apartado de pagos -->
										<div class="col-md-3">
											<div class="form-group">
												<label for="">Referencia</label>
												<input id="payment_reference" name="payment[reference]" class="form-control" type="text" value="<?php echo $payment->getReference();?>">
											</div>
											<div class="form-group">
												<label for="">Total</label>
												<input id="payment_total" name="payment[total]" class="form-control" type="text" value="<?php echo $payment->getTotal();?>">
											</div>
											<div class="form-group">
												<label for="">Subtotal</label>
												<input id="payment_subtotal" name="payment[subtotal]" class="form-control" type="text" value="<?php echo $payment->getSubtotal();?>">
											</div>
											<div class="form-group hidden">
												<label for="">Descuento</label>
												<input id="payment_discount" name="payment[discount]" class="form-control" type="text" value="<?php echo $payment->getDiscount();?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="">Método de pago</label>
												<input id="payment_paymentmethod" name="payment[paymentmethod]" class="form-control" type="text" value="<?php echo $payment->getPaymentMethod();?>">
											</div>
											<div class="form-group">
												<label for="">Estado</label>
												<select id="payment_status" name="payment[status]" class="form-control">

													<?php

													$estados = array(
														array(1,"No efectiva"), 
														array(2,"Pendiente"), 
														array(3,"Autorizada"), 
														array(4,"Declinada"),
														array(5,"Cancelada"),
														array(6,"Aprobada sin capturar"),
														array(8,"En proceso"),
													);


													foreach ($estados as $estado) {
														if($estado[0] == $payment->getStatus() )
														{
															echo '<option value="'.$estado[0].'" selected>'.$estado[1].'</option>';
														}
														else
														{
															echo '<option value="'.$estado[0].'" >'.$estado[1].'</option>';
														}
													}

													?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Moneda</label>
												<input id="payment_currency" name="payment[currency]" class="form-control" type="text" value="<?php echo $payment->getCurrency();?>">
											</div>
											<div class="form-group">
												<label for="">Tipo de cambio</label>
												<input id="payment_exchangerate" name="payment[exchangerate]" class="form-control" type="text" value="<?php echo $payment->getExchangeRate();?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<hr>
											<button class="btn btn-lg btn-primary pull-right">Guardar</button>
										</div>
									</div>
								</form>
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

