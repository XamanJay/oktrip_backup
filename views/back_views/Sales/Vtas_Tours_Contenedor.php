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
								<?php include "Vtas_Tours_Filtros.php";  ?>
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
                                echo $Rango_Fechas . "<---Rango";
								TOURS OKTRIP . DEL: &nbsp;&nbsp;&nbsp;'.date_format($Objeto_Fecha_1, "d/m/Y").'&nbsp;&nbsp; AL &nbsp;&nbsp;'.date_format($Objeto_Fecha_2, "d/m/Y") . '&nbsp;&nbsp;&nbsp;&nbsp; # DE REGISTROS : '.$count .'
								*/

								echo '<div class="table-responsive">
												<table id="trips" class="table table-bordered  table-striped ">
													<thead>
														<tr class="LabelTD"  >
                                                            
															<th class="LabelTD"  colspan="13"  >
                                                             TOURS OKTRIP  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; # DE REGISTROS : '.$count .'
															</th> 
                                                             
														</tr>
														
														<tr class="LabelTD">
														
                                                            <th class="LabelTD"> Acción </th>
                                                            <th class="LabelTD"> Titulo Tour </th>
                                                            <th class="LabelTD"> Semblanza </th>
                                                            <th class="LabelTD"> Localidades </th>
															<th class="LabelTD"> Tipo        </th>
															<th class="LabelTD"> Precios Pesos </th>
															<th class="LabelTD"> Precios Dolares </th>
															
														     
                                                        </tr>
													</thead>
													<tbody id="myTable">'; 
													foreach ($lista as $ttoouurrss) {
													     
														echo '
														<tr class="DataTDover">
															<td class="blockText"> <a href=/ventas/editatoursss?Id_Toursss='.$ttoouurrss->getId_xtours().'> <img src="../../img/Reportes_Vtas/editar.png" weight="27" height="27"  > </a> &nbsp;
																				                <a href=/ventas/eliminatoursss?Id_Toursss='.$ttoouurrss->getId_xtours().'><img src="../../img/Reportes_Vtas/cancelar.png" weight="17" height="17">  </a>  </td>
															
															<td class="blockText">'.$ttoouurrss->gettitulo().' </td>
															<td class="blockText">'.$ttoouurrss->getsemblanza().'</td>
															<td class="blockText">'.$ttoouurrss->getxlocalidades().'</td>
															<td class="blockText">'.$ttoouurrss->getxtipotours().'</td>
															<td class="blockText">Adulto: '.$ttoouurrss->getprecio_adulto_pesos().'<br>Infante: '.$ttoouurrss->getprecio_infante_pesos().'</td>
															<td class="blockText">Adult: '.$ttoouurrss->getadult_price_dollars(). '<br>Infants: '.$ttoouurrss->getinfants_price_dollars(). '</td>
															


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
		$(document).ready(function() {
 
			$("#myInput").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#myTable tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			});
	});
</script>
</body>
</html>

