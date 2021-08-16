<!DOCTYPE html> 

<html lang="en">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">



	<title>ReporteVtasWebMensuales </title>

    <link href="../../css/animate/Ollin.css" rel="stylesheet">

     

	<?php include("views/partialViews/_adminPanelStyles.html"); ?>

	

    

</head>

<link href="../../css/tables3d.css" rel="stylesheet" type="text/css">

<body class="nav-md">

	<div class="container body">

		<div class="main_container">



			<!-- sidebar -->

			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>



			<!-- top navigation -->

			<?php // include("views/partialViews/_adminPanelTopNav.php"); ?>



			<!-- page content -->

			<div class="right_col" role="main">

				<div class="clear"></div>

				<div class="row">

					<div class="col-md-12">

						<div class="x_panel">

							<div class="x_title">

								<?php  include "◣_◢-Vtas_Mensuales_Filtros.php";  ?>

								<div class="clearfix"></div>

							</div>

							<div class="x_content">

								<div id="controlPanel"></div>

								<div class="clear"></div>

								<?php 

										

										echo '<div class="table-responsive">

												<table id="" class=" display table table-bordered table-striped ">

													<thead>

														<tr class="HeaderTDslategray">

															<th colspan="10"  > 

																VENTAS MENSUALES DEL MES DE JUNIO &nbsp;<mark> 2 0 1 9 </mark>&nbsp; (WEB / OFFLINE)

															</th>

                                                             <th class="blockText"> $'. number_format($Tot_Pub_Jun,2,".",",")   .'     </th>

                                                              <th class="blockText"> $'. number_format($Tot_Net_Jun,2,".",",")   .'     </th>

                                                            

														</tr>

														

														<tr class="HeaderTDslategray">

															<th  colspan="10"  > 

																VENTAS MENSUALES DEL MES DE JUNIO &nbsp;<mark> 2 0 2 0 </mark>&nbsp; (WEB / OFFLINE)

															</th>

                                                             <th class="blockText"> $'. number_format($GRAN_TOT_PUBLICO_0620,2,".",",")   .'</th>

                                                              <th class="blockText"> $'. number_format($GRAN_TOT_NETO_0620,2,".",",")   .'</th>

                                                            

														</tr>

														<tr class="HeaderTDBlueivy">

															<th  colspan="10"  > 

																VENTAS MENSUALES DEL MES DE JUNIO &nbsp;<mark> 2 0 2 1 </mark>&nbsp; (WEB / OFFLINE)

															</th>

                                                             <th class="blockText"> $'. number_format($GRAN_TOT_PUBLICO_0621,2,".",",")   .'</th>

                                                              <th class="blockText"> $'. number_format($GRAN_TOT_NETO_0621,2,".",",")   .'</th>

                                                            

														</tr>

														

														<tr class="HeaderTDweb1">

                                                            <th class="blockText"> Estatus </th>

                                                            <th class="blockText"> Clave </th>

                                                            <th class="blockText"> Cliente </th>

                                                            <th class="blockText"> Pax </th>

														    <th class="blockText"> Servicio </th>

                                                            <th class="blockText"> Proveedor </th>

                                                            <th class="blockText"> Tipo de servicio </th>

															<th class="blockText"> Fecha de Venta</th>

											                <th class="blockText"> Llegada </th>

															<th class="blockText"> Salida </th>

															<th class="blockText"> Público </th>

															<th class="blockText"> Neto </th>

														<!--	<th class="blockText"> Origen </th>                -->

														     

											            </tr>

													</thead>

													<tbody id="myTable" >'; 

                                              if($count1 > 0){

													foreach ($lista1 as $sale1) {

													$ODate = substr($sale1->getDate(),0, 10);

													 $Objeto_Date = date_create_from_format('Y-m-d', $ODate); 

													 $d_m_a_Date =  date_format($Objeto_Date, "d/m/Y");

													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale1->getDateTo()); 

													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");

													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale1->getDateFrom()); 

													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");

														echo '

																<tr class="DataTDover">

                                                                    <td class="blockText">'.$sale1->getStatus().'</td>

                                                                    <td class="blockText">'.$sale1->getId().'</td> 

                                                                    <td>'.$sale1->getCustomer().' '.$sale1->getLastName().' '.$sale1->getSecondName().'</td>

                                                                    <td>'.$sale1->getPaxxx().' </td>

                                                                    <td>'.$sale1->getService().'</td>

																	<td class="blockText">'.$sale1->getProvider().'</td>

																	<td class="blockText">'.$sale1->getTypeService().'</td>

																	 <td class="blockText">'. $d_m_a_Date.'</td>

																	<td class="blockText">'. $d_m_a_DateFrom.'</td>

																	<td class="blockText">'. $d_m_a_DateTo.'</td>

																	<td class="blockText">$'.number_format($sale1->getTotal(),2,".",",").'</td>

																	<td class="blockText">$'.number_format($sale1->getSubTotal(),2,".",",").'</td>

																	<!-- <td class="blockText">'.$sale1->getTypeVending().'</td> -->

																	

																</tr>';

													}

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

	

        $('table.display').DataTable ( {

        //"pageLength": 25

        "paging": false,

        "searching": false,

        "order": [[ 7, "desc" ]]

         } )

        

    } );

 </script>



	

</body>

</html>



