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

<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>
			<?php include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<ol class="breadcrumb">
							<li><a href="/home">Home</a></li>
							<li><a href="/ventas">Ventas</a></li>
							<li class="active">Crear</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_content">
								<form id="formSale" method="POST" action="/ventas/crear" >
									<div class="row">
										<div class="col-xs-12 col-sm-6">
											<div class="row">
												<div class="col-md-12">
													<h3>Datos del cliente</h3>
													<!--<?php print_r($agents); ?>-->
													<hr>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_name">Nombre (s)</label>
													<input id="customer_name" name="customer[name]" class="form-control" type="text" value="" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_lastname">Apellido (s)</label>
													<input id="customer_lastname" name="customer[lastname]" class="form-control" type="text" value="" required>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_email">Correo electrónico</label>
													<input id="customer_email" name="customer[email]" class="form-control" type="text" value="NA" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_phone">Teléfono</label>
													<input id="customer_phone" name="customer[phone]" class="form-control" type="text" value="NA" required>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_country">País</label>
													<input id="customer_country" name="customer[country]" class="form-control" type="text" value="NA" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_state">Estado</label>
													<input id="customer_state" name="customer[state]" class="form-control" type="text" value="NA" required>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_city">Ciudad</label>
													<input id="customer_city" name="customer[city]" class="form-control" type="text" value="NA" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="customer_address">Dirección</label>
													<input id="customer_address" name="customer[address]" class="form-control" type="text" value="NA" required>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6">
											<div class="row">
												<div class="col-md-12">
													<h3>Datos del servicio </h3>
													<hr>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="sale_date">N° Cupón Oktrip</label>
													<input id="payment_reference" name="payment[reference]" class="form-control" type="text" value="" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="service_typeService">Tipo de servicio </label>
													<select id="service_typeService" name="service[typeService]" class="form-control"> 
														<?php
														foreach ($typeservices as $typeService)
														{
															echo "<option value=\"".$typeService["id"]."\">".$typeService["Nombre"]."</option>";
														}

														?>											
													</select>
												</div>
											</div>	
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="service_provider" class="label-form">Proveedores</label>
													<select data-placeholder="Your Favorite Football Team" class="chosen-select form-control" tabindex="5" style="width: 100%;" name="service[product]" id="products">
														<?php
															foreach ($providers as $provider)
															{
																//echo "<option value=\"".$provider["Id"]."\">".$provider["Nombre"]."</option>";
																echo "<optgroup label='".$provider["Nombre"]."' id='".$provider["Id"]."'>";
																$db->setTable(tables::Product);
																$products = $db->where(
																	array(
																		array(
																			"field" => "id_Provider",
																			"value" => $provider["Id"],
																			"optMat" => "=",
																			"optLog" => "AND"
																		),
																		array(
																			"field" => "isDeleted",
																			"value" => 0,
																			"optMat" => "=",
																			"optLog" => NULL
																		)
																	)
																);
																foreach ($products as $product) {
																	echo "<option id='".$product["Id"]."'>".$product["Name"]."</option>";
																}
																echo "</optgroup>";
															}

														?>
																													
													</select>
													<input type="hidden" name="service[provider]" id="provider">
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="service_provider">Comentarios</label>
													<input type="text" class="form-control" name="service[descrip]">
												</div>
											</div>
											<div class="row">	
												<div class="form-group col-xs-12 col-sm-6">
													<label for="service_from">Fecha de llegada</label>
													<input id="service_from" name="service[from]" class="form-control" type="date" value="" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="service_to">Fecha de salida</label>
													<input id="service_to" name="service[to]" class="form-control" type="date" value="" required>
												</div>
											</div>
											<hr/>
											<div class="row">	
												<div class="form-group col-xs-12 col-sm-6">
													<label for="service_HotelName">Nombre de hotel</label>
													<input id="service_HotelName" name="service[hotelname]" class="form-control" type="text" value="">
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="room">No. Habitación</label>
													<input id="room" name="service[room]" class="form-control" type="number" value="0">
												</div>
											</div>
											<div class="row">	
												<div class="form-group col-xs-12 col-sm-6">
													<label for="Adults">Adultos</label>
													<input id="Adults" name="service[adults]" class="form-control" type="number" value="">
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="Kids">Niños</label>
													<input id="Kids" name="service[kids]" class="form-control" type="number" value="0">
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="Kids">Clave Reservación Proveedor</label>
													<input id="autorization" name="payment[autorization]" class="form-control" type="text" value="0">
												</div>
											</div>
										</div>
										<!-- Apartado de pagos -->
										<div class="col-xs-12 col-sm-6">
											<div class="row">
												<div class="col-md-12">
													<h3>Datos del pago</h3>
													<hr>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_total">Total Público</label>
													<input id="payment_total" name="payment[total]" class="form-control" type="text" value="" required>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_total">Total Neto %</label>
													<input id="payment_total" name="payment[subtotal]" class="form-control" type="text" value="" required>
												</div>
												
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_status">Estado</label>
													<select id="payment_status" name="payment[status]" class="form-control">

														<?php

														foreach ($status as $aux) {
															echo '<option value="'.$aux[0].'">'.$aux[1].'</option>';
														}

														?>
													</select>
												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_paymentmethod">Método de pago</label>
													<select id="payment_paymentmethod" name="payment[paymentmethod]" class="form-control">
														<option value="Tarjeta de crédito" selected>Tarjeta de crédito</option>
														<option value="Tarjeta de débito">Tarjeta de débito</option>
														<option value="Transferencia bancaria">Transferencia bancaria</option>
														<option value="Depósito bancario">Depósito bancario</option>
														<option value="Paypal">Paypal</option>
														<option value="Efectivo">Efectivo</option>
														<option value="Link">Link</option>
														<option value="Otro">Otro</option>
													</select>
												</div>
											</div>
											<div class="row">

												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_currency">Moneda</label>
													<select id="payment_currency" name="payment[currency]" class="form-control">
														<option value="MXN" selected>MXN</option>
														<option value="USD">USD</option>
														<option value="EUROS">EUROS</option>
													</select>

												</div>
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_exchangerate">Tipo de cambio</label>
													<input id="payment_exchangerate" name="payment[exchangerate]" class="form-control" type="number" value="0">
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6">
											<div class="row">
												<div class="col-md-12">
													<h3>Datos del Rep</h3>
													<hr>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_paymentmethod">Nombre del Rep</label>
													<select id="payment_paymentmethod" name="comission[agent]" class="form-control">
														<?php 
															foreach ($agents as $agent) {
																echo '<option value="'.$agent['Id'].'">'.$agent['Name'].'</option>';
															}

														?>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="form-group col-xs-12 col-sm-6">
													<label for="payment_status">Comisión</label>
													<select id="payment_status" name="comission[cake]" class="form-control">
														<option value="5">5%</option>
														<option value="7">7%</option>
														<option value="10">10%</option>
														<option value="15">15%</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6">
											<input type="submit" value="Enviar">
											<div id="response" style="padding: 10px;margin-top: 15px;text-align: center;color: black;width: 400px;"></div>
										</div>
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

<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/icheck.min.js"></script>
<script type="text/javascript" src="/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/moment/moment.min.js"></script>
<script type="text/javascript" src="/js/moment/locale/es.js"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/SweetAlert/sweetalert2.min.js"></script>

<script type="text/javascript" src="/js/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/js/dataTables/dataTables.bootstrap.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/responsive/dataTables.responsive.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/responsive/responsive.bootstrap.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/buttons/dataTables.buttons.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/buttons/buttons.bootstrap.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/buttons/jszip.min.js"></script>	
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js	"></script>
<script type="text/javascript" src="/js/dataTables/buttons/buttons.html5.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/buttons/buttons.print.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/buttons/buttons.colVis.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/select/dataTables.select.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/editor/dataTables.editor.min.js"></script>	
<script type="text/javascript" src="/js/dataTables/editor/editor.bootstrap.min.js"></script>

<!-- Choosen -->
<script type="text/javascript" src="/js/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="/js/chosen/prism.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/chosen/init.js" charset="utf-8"></script>

<script type="text/javascript" src="/js/scripts-admin.js"></script> 
<script type="text/javascript">
	$(document).ready(function(){

		$("#formSale").validate({

			submitHandler:function(form){
				$.ajax({
					type:form.method,
					url:form.action,
					data:$(form).serialize(),
					beforeSend:function(){

					},
					success:function(jsonObject){
						var object = JSON.parse(jsonObject);
						if(object.type = "success"){
							$("#response").addClass("bg-success");
							$("#response").append(object.message);
							$("#formSale")[0].reset();
						}
					}
				});

			}
		});

		var provider = $("#products").find("option:selected").closest('optgroup').prop('label');
	    $("#provider").val(provider);


		$("#products").chosen().change(
	        function (evt) {
	            var label = $(this.options[this.selectedIndex]).closest('optgroup').prop('label');
	            console.log(label);
	            $("#provider").val(label);
	            
	    });
	});
</script>
</body>
</html>
