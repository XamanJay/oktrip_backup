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
<link href="../../css/animate/Ollin.css" rel="stylesheet">
<link href="../../css/tables3d.css" rel="stylesheet" type="text/css">
<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<!-- sidebar -->
			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>

			<!-- top navigation -->
			<?php //  include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_title">
								<?php include "Vtas_Trips_Filtros.php";  ?>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="controlPanel"></div>
								<div class="clear"></div>
                                
                                <?php 
										
									echo '<div class="table-responsive">								   
											<table align="center" class=" table-striped" >
												<thead>
													<tr class="table-secondary">
                                                    
														<td><i  class="glyphicon glyphicon-search"></i>
                                                        </td>
														<td colspan="11" >
															<input  class="form-control" id="myInput" type="text" placeholder="Buscar..." autofocus size="180"  >
														</td>
													</tr>
												</thead>
											</table>				
										</div> ';
									
									
									$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1);  
									$Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
                                
                                /*echo $Id_productos."<----" ;
                                echo $Fecha_1. "<--Fecha1";
                                echo $Fecha_2. "<--Fecha2";
                                echo $Rango_Fechas . "<---Rango";*/

										echo '<div class="table-responsive">
												<table id="trips" class="table table-bordered  table-striped ">
													<thead>
														<tr class="HeaderTD">
                                                            
															<td  colspan="11" align="center" >
                                                            <h4><strong> VENTAS DE TRASLADOS. DEL: &nbsp;&nbsp;&nbsp;'.date_format($Objeto_Fecha_1, "d/m/Y").'&nbsp;&nbsp; AL &nbsp;&nbsp;'.date_format($Objeto_Fecha_2, "d/m/Y") . '&nbsp;&nbsp;&nbsp;&nbsp; # DE REGISTROS : '.$count .'</strong></h4>
															</td>
                                                            
														</tr>
														<tr class="HeaderTD">
															<td  colspan="5" align="center">
																<h4><strong>Total Público: $ '.number_format($total_publico,2,".",",").'</strong></h4>
															</td>
															<td  colspan="6" align="center">
																<h4><strong>Ventas Netas: $ '.number_format($total_neto,2,".",",").'</strong></h4>
															</td>
														</tr>
														<tr class="HeaderTD">
											                <th class="blockText"> Nombre </th>
														    <th class="blockText"> Clave </th>
											                <th class="blockText"> Estatus </th>
											                <th class="blockText"> Proveedor </th>
											                <th class="blockText"> Servicio </th>
															<th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Total Público </th>
															<th class="blockText"> Total Neto </th>
															<th class="blockText"> Origen </th>                
														    <th class="blockText"> Tipo </th> 
											            </tr>
													</thead>
													<tbody id="myTable">'; 
													foreach ($lista as $sale) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
																	<td>'.$sale->getCustomer().' '.$sale->getLastName().' '.$sale->getSecondName().'</td>
																	<td class="blockText">'.$sale->getId().'</td> 
																	<td class="blockText">'.$sale->getStatus().'</td>
																	<td class="blockText">'.$sale->getProvider().'</td>
																	<td>'.$sale->getService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale->getSubTotal(),2,".",",").'</td>
																	<td class="blockText">'.$sale->getTypeVending().'</td>
																	<td class="blockText">'.$sale->getTypeService().'</td>
																</tr>';
													}
												echo'</tbody>
													</table>
											</div>';
								?>
	
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					M&eacute;xico  ||||||||||||||||||||  <a href="www.oktrip.mx">www.oktrip.mx !</a> 
				</div>
				<div class="clearfix"></div>
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/scripts-admin.js"></script> 
    
     <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
	 $(document).ready(function() {
	
        $('#trips').DataTable ( {
        //"pageLength": 25
        "paging": false,
        "searching": false,
        "order": [[ 1, "desc" ]]
         } )
        
    } );
 </script>

	<script>
		$(document).ready(function(){

			$("#myInput").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#myTable tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			});

			var dateFormat = "mm/dd/yy",
			from = $( "#from" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on( "change", function() {
				to.datepicker( "option", "minDate", getDate( this ) );
			}),
			to = $( "#to" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on( "change", function() {
				from.datepicker( "option", "maxDate", getDate( this ) );
			});

			function getDate( element ) {
				var date;
				try {
					date = $.datepicker.parseDate( dateFormat, element.value );
				} catch( error ) {
					date = null;
				}
				return date;
			}
		});
        
        
        
     

           
        
        
	</script>

</body>
</html>

