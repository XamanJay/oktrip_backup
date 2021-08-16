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
								<?php include "Vtas_Volaris_Filtros.php";  ?>
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
															<input  class="form-control" id="myInput" type="text" placeholder="Buscar..." autofocus size="150"  >
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
														<tr class="LabelTD"  >
                                                            
															<th class="LabelTD"  colspan="13"  >
                                                             TRANSPORTACIÓN VOLARIS   . DEL: &nbsp;&nbsp;&nbsp;'.date_format($Objeto_Fecha_1, "d/m/Y").'&nbsp;&nbsp; AL &nbsp;&nbsp;'.date_format($Objeto_Fecha_2, "d/m/Y") . '&nbsp;&nbsp;&nbsp;&nbsp; # DE REGISTROS : '.$count .'
															</th>
                                                            
														</tr>
														<tr class="LabelTD">
                                                            <th colspan="8" >
                                                              Reservación.
                                                            </th>
															<th  colspan="2" >
																Datos de Llegada.
															</th>
															<th  colspan="2" >
																Datos de Salida. 
															</th>
														</tr>
														<tr class="LabelTD">
                                                            <th class="LabelTD"> Acción </th>
                                                            <th class="LabelTD"> Cve </th>
											                <th class="LabelTD"> Nombre </th>
                                                            <th class="LabelTD"> Reserva </th>
                                                            <th class="LabelTD"> #Pax:  '. $total_pax.'</th>
															<th class="LabelTD"> -Tipo- </th>
															<th class="LabelTD"> $Público </th>
															<th class="LabelTD"> $Neto </th>
														    <th class="LabelTD"> Llegada </th>
											                <th class="LabelTD"> No.Vuelo </th>
											              	<th class="LabelTD"> Salida </th>
															<th class="LabelTD"> No.Vuelo </th>
															             
														     
                                                        </tr>
													</thead>
													<tbody id="myTable">'; 
													foreach ($lista as $volaris) {
													     $Objeto_DateTo = date_create_from_format('Y-m-d', $volaris->getfecha_llegada()); 
													 	 $d_m_a_fecha_llegada = date_format($Objeto_DateTo, "d/m/Y");
													 	 $Objeto_DateFrom = date_create_from_format('Y-m-d', $volaris->getfecha_salida()); 
													 	 $d_m_a_fecha_salida = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText"> <a href=/ventas/editavolaris?Id_Volaris='.$volaris->getId_Volaris().'> <img src="../../img/Reportes_Vtas/editar.png" weight="27" height="27"  > </a> &nbsp;
                                                                                                            <a href=/ventas/borrarvolaris?Id_Volaris='.$volaris->getId_Volaris().'>   <img src="../../img/Reportes_Vtas/cancelar.png" weight="17" height="17">  </a>  </td>
                                                                    <td align="center" class="blockText">'.$volaris->getId_Volaris().' </td>
                                                                    <td align="center" class="blockText">'.$volaris->getnombre_completo().' </td>
                                                                    <td align="center" class="blockText">'.$volaris->getno_reserva().'</td>
                                                                    <td align="center" class="blockText">'.$volaris->getpaxxx().'</td>
																	<td align="center" class="blockText">'.$volaris->getName().'</td>
																	<td align="center" class="blockText">'.$volaris->gettotal_publico().'</td>
																	<td align="center" class="blockText">'.$volaris->gettotal_neto().'</td>
																	<td align="center" class="blockText">'.$d_m_a_fecha_llegada.'</td> 
																	<td align="center" class="blockText">'.$volaris->getno_vuelo_llegada().'</td>
																	<td align="center" class="blockText">'.$d_m_a_fecha_salida.'</td>
																	<td align="center" class="blockText">'.$volaris->getno_vuelo_salida().'</td>
																	
																	
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
       // "order": [[ 5, "desc" ]]
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
				defaultDate: "null",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on( "change", function() {
				to.datepicker( "option", "minDate", getDate( this ) );
			}),
			to = $( "#to" ).datepicker({
				defaultDate: "null",
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
        
        
        
     
        
      $( function() {
        $( "#datepicker" ).datepicker();
      } );


           
          $( function() {
        $( "#datepicker_s" ).datepicker();
      } );
        
        
        
        
        $( function() {
    $( "#datepicker_o" ).datepicker();
      } );
        
        
       $( function() {
	   $("#datepicker_oc").datepicker();
	   } ) ;
	   
	   
	   $( function() {
	   $("#datepicker_i_o_c_ll").datepicker();
	   } ) ;
        
		
		
		$( function() {
	   $("#datepicker_i_o_c_ss").datepicker();
	   } ) ;
        
        
        
	</script>

</body>
</html>

