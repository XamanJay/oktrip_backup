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

<body background="000FFF" class="nav-md">
	<div class="container body">
		<div class="main_container">

			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>
			<?php include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							
							<form id="formSale" method="POST" action="/ventas/crear" >
								<div class="row">

				     				<!-- CLIENTE   -->
				     				<div class="col-xs-12 col-sm-12 col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 

										<p style="text-align: center;margin-bottom: 20px;margin-top: 25px;">A L T A&nbsp;&nbsp;DE&nbsp;&nbsp; R E S E R V A S:: </p> 

										<div class="form-group col-xs-12 col-sm-3">
											<label for="customer_name"><font color="000000" >Nombre (s) </font></label>
											<input id="customer_name" name="customer[name]" class="form-control" type="text" value="" required>
										</div>
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label for="customer_lastname"><font color="000000" >Apellido (s)</font></label>
											<input id="customer_lastname" name="customer[lastname]" class="form-control" type="text" value="" required>
										</div>
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label for="customer_email"><font color="000000" >Correo electrónico</font></label>
											<input id="customer_email" name="customer[email]" class="form-control" type="text" value="NA" required>
										</div>
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label for="customer_phone"><font color="000000" >Teléfono</font></label>
											<input id="customer_phone" name="customer[phone]" class="form-control" type="text" value="NA" required>
										</div>
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label for="customer_country"><font color="000000" >País</font></label>
											<input id="customer_country" name="customer[country]" class="form-control" type="text" value="NA" required>
										</div>
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label for="customer_state"><font color="000000" >Estado</font></label>
											<input id="customer_state" name="customer[state]" class="form-control" type="text" value="NA" required>
										</div>
										<div class="form-group col-xs-12 col-sm-3">
											<label for="customer_city"><font color="000000" >Ciudad</font></label>
											<input id="customer_city" name="customer[city]" class="form-control" type="text" value="NA" required>
										</div>
										<div class="form-group col-xs-12 col-sm-3">
											<label for="customer_address"><font color="000000" >Dirección</font></label>
											<input id="customer_address" name="customer[address]" class="form-control" type="text" value="NA" required>
										</div>
									</div>									

									<!-- SERVICIO  -->
									<div class="col-xs-12 col-sm-12 col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
												
										<div class="form-group col-xs-12 col-sm-2">
											<label for="sale_date"><font color="000000" >N° Cupón Oktrip</font></label>
											<input id="payment_reference" name="payment[reference]" class="form-control" type="text" value="" required>
										</div>
										<div class="form-group col-xs-12 col-sm-2">
											<label for="service_typeService"><font color="000000" >Tipo de servicio </font></label>
											<select id="service_typeService" name="service[typeService]" class="form-control">
												<?php
												foreach ($typeservices as $typeService)
												{
													echo "<option value=\"".$typeService["id"]."\">".$typeService["Nombre"]."</option>";
												}

												?>
											</select>
										</div>
										<div class="form-group col-xs-12 col-sm-3">
											<label for="service_provider" class="label-form"><font color="000000" >Proveedores</font></label>
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
											<input type="hidden" name="service[Idproductos]" id="id_producto">
											<input type="hidden" name="service[Idproviders]" id="id_provider">
										</div>
										<div class="form-group col-xs-12 col-sm-3">
											<label for="service_provider"><font color="000000" >Descripción</font></label>
											<input type="text" class="form-control" name="service[descrip]">
										</div>
										<div class="form-group col-xs-12 col-sm-2">
											<label for="service_from"><font color="000000" >Fecha de llegada</font></label>
											<input id="service_from" name="service[from]" class="form-control" type="date" value="" required>
										</div>
										<div class="form-group col-xs-12 col-sm-2">
											<label for="service_to"><font color="000000" >Fecha de salida</font></label>
											<input id="service_to" name="service[to]" class="form-control" type="date" value="" required>
										</div>
										<div class="form-group col-xs-12 col-sm-3">
											<label for="service_HotelName"><font color="000000" >Nombre de hotel</font></label>
											<input id="service_HotelName" name="service[hotelname]" class="form-control" type="text" value="">
										</div>
										<div class="form-group col-xs-12 col-sm-2">
											<label for="room"><font color="000000" >No. Habitación </font> </label>
											<input id="room" name="service[room]" class="form-control" type="number" value="0">
										</div>
										<div class="form-group col-xs-12 col-sm-1">
											<label for="Adults"><font color="000000" >Adultos</font></label>
											<input id="Adults" name="service[adults]" class="form-control" type="number" value="">
										</div>
										<div class="form-group col-xs-12 col-sm-1">
											<label for="Kids"><font color="000000" >Niños</font></label>
											<input id="Kids" name="service[kids]" class="form-control" type="number" value="0">
										</div>
										<div class="form-group col-xs-12 col-sm-3">
											<label for="Kids"><font color="000000" >Clave Reservación Proveedor</font></label>
											<input id="autorization" name="payment[autorization]" class="form-control" type="text" value="">
										</div>
												
												
									</div>

									<!-- PAGOS -->
									<div class="col-xs-12 col-sm-12 col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				
										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_total"><font color="000000" >Total Público</font></label>
											<input id="payment_total" name="payment[total]" class="form-control" type="text" value="" required>
										</div>
										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_total"><font color="000000" >Total Neto %</font></label>
											<input id="payment_total" name="payment[subtotal]" class="form-control" type="text" value="" required>
										</div>
										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_status"><font color="000000" >Estado</font></label>
											<select id="payment_status" name="payment[status]" class="form-control">

												<?php

												foreach ($status as $aux) {
													echo '<option value="'.$aux[0].'">'.$aux[1].'</option>';
												}

												?>
											</select>
										</div>

										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_paymentmethod"><font color="000000" >Método de pago</font></label>
											<select id="payment_paymentmethod" name="payment[paymentmethod]" class="form-control">
												<option value="Tarjeta de crédito" selected>Tarjeta de crédito</option>
												<option value="Tarjeta de débito">Tarjeta de débito</option>
												<option value="Transferencia bancaria">Transferencia bancaria</option>
												<option value="Depósito bancario">Depósito bancario</option>
												<option value="Paypal">Paypal</option>
												<option value="Efectivo">Efectivo</option>
												<option value="Otro">Otro</option>
											</select>
										</div>

										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_currency"><font color="000000" >Moneda</font></label>
											<select id="payment_currency" name="payment[currency]" class="form-control">
												<option value="MXN" selected>MXN</option>
												<option value="USD">USD</option>
												<option value="EUROS">EUROS</option>
											</select>
										</div>

										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_exchangerate"><font color="000000" >Tipo de cambio</font></label>
											<input id="payment_exchangerate" name="payment[exchangerate]" class="form-control" type="number" value="0">
										</div>

									</div>
						
									<!-- REPRESENTANTE -->
									<div class="col-xs-12 col-sm-12 col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
					                       


										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_paymentmethod"><font color="000000" >Nombre del Rep.</font></label>
											<select id="payment_paymentmethod" name="comission[agent]" class="form-control">
												<?php
													foreach ($agents as $agent) {
														echo '<option value="'.$agent['Id'].'">'.$agent['Name'].'</option>';
													}

												?>
											</select>
										</div>

										<div class="form-group col-xs-12 col-sm-2">
											<label for="payment_status"><font color="000000" ><font color="000000" >Comisión</font></font ></label>
											<select id="payment_status" name="comission[cake]" class="form-control">
                                                <option value="0"> 0 %</option>
												<option value="5"> 5 %</option>
												<option value="7"> 7 %</option>
												<option value="10">10 %</option>
												<option value="15">15 %</option>
											</select>

										</div>
											
                                        <div class="form-group col-xs-12 col-sm-8">
											<label for="payment_status"> <font color="000000" ></font >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
											<input type="submit" class="btn btn-primary"  value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :: G U A R D A R :: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
											<input type="reset" class="btn btn-primary"  value="&nbsp;&nbsp; :: R E S E T :: &nbsp;&nbsp;">
				 						</div>
									</div>

								</div> <!-- class="row" -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer content -->
		<footer>
			<div class="pull-right"> Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>	</div>
			<div class="clearfix"></div>
		</footer>
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
	    //console.log($("#provider").val(provider));

		$("#products").chosen().change(
	        function (evt) {
	            var label = $(this.options[this.selectedIndex]).closest('optgroup').prop('label');
	            var id_provedor = $(this.options[this.selectedIndex]).closest('optgroup').prop('id');
	            //var id_producto = $(this.val());
	            /*console.log("Nombre Proveedor: "+label);
	            console.log("Id Proovedor: "+id_provedor);
	            console.log("Nombre Producto: "+$("#products").val());
	            console.log("Id Producto: "+$(this.options[this.selectedIndex]).prop('id'));*/
	            $("#id_provider").val(id_provedor);
	            $("#id_producto").val($(this.options[this.selectedIndex]).prop('id'));
	            $("#provider").val(label);

	    });
	});
</script>
</body>
</html>
