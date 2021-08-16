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
														<tr class="HeaderTDDarkgrey">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE ENERO 2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Ene,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Ene,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDDarkgrey">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
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
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale1->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale1->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale1->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                              }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDBluegray">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE FEBRERO 2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Feb,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Feb,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDBluegray">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
												<!--	 <th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                if($count2 > 0){
													foreach ($lista2 as $sale2) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale2->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale2->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale2->getStatus().'</td>
                                                                    <td class="blockText">'.$sale2->getId().'</td> 
                                                                    <td>'.$sale2->getCustomer().' '.$sale2->getLastName().' '.$sale2->getSecondName().'</td>
                                                                     <td>'.$sale2->getPaxxx().' </td>
                                                                    <td>'.$sale2->getService().'</td>
																	<td class="blockText">'.$sale2->getProvider().'</td>
																	<td class="blockText">'.$sale2->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale2->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale2->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale2->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                  echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDBluejay">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE MARZO 2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Mar,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Mar,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDBluejay">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                             <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                               if($count3 > 0){
													foreach ($lista3 as $sale3) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale3->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale3->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale3->getStatus().'</td>
                                                                    <td class="blockText">'.$sale3->getId().'</td> 
                                                                    <td>'.$sale3->getCustomer().' '.$sale3->getLastName().' '.$sale3->getSecondName().'</td>
                                                                    <td>'.$sale3->getPaxxx().' </td>
                                                                    <td>'.$sale3->getService().'</td>
																	<td class="blockText">'.$sale3->getProvider().'</td>
																	<td class="blockText">'.$sale3->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale3->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale3->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale3->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                               }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                  echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDEarthblue">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE ABRIL  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Abr,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Abr,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDEarthblue">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count4 > 0){
													foreach ($lista4 as $sale4) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale4->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale4->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale4->getStatus().'</td>
                                                                    <td class="blockText">'.$sale4->getId().'</td> 
                                                                    <td>'.$sale4->getCustomer().' '.$sale4->getLastName().' '.$sale4->getSecondName().'</td>
                                                                    <td>'.$sale4->getPaxxx().' </td>
                                                                    <td>'.$sale4->getService().'</td>
																	<td class="blockText">'.$sale4->getProvider().'</td>
																	<td class="blockText">'.$sale4->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale4->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale4->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale4->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDBluelotus">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE MAYO  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_May,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_May,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDBluelotus">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count5 > 0){
													foreach ($lista5 as $sale5) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale5->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale5->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale5->getStatus().'</td>
                                                                    <td class="blockText">'.$sale5->getId().'</td> 
                                                                    <td>'.$sale5->getCustomer().' '.$sale5->getLastName().' '.$sale5->getSecondName().'</td>
                                                                    <td>'.$sale5->getPaxxx().' </td>
                                                                    <td>'.$sale5->getService().'</td>
																	<td class="blockText">'.$sale5->getProvider().'</td>
																	<td class="blockText">'.$sale5->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale5->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale5->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale5->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDBlueivy">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE JUNIO  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Jun,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Jun,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDBlueivy">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
                                                    <!--  <th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count6 > 0){
													foreach ($lista6 as $sale6) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale6->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale6->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale6->getStatus().'</td>
                                                                    <td class="blockText">'.$sale6->getId().'</td> 
                                                                    <td>'.$sale6->getCustomer().' '.$sale6->getLastName().' '.$sale6->getSecondName().'</td>
                                                                    <td>'.$sale6->getPaxxx().' </td>
                                                                    <td>'.$sale6->getService().'</td>
																	<td class="blockText">'.$sale6->getProvider().'</td>
																	<td class="blockText">'.$sale6->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale6->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale6->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale6->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                 echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDButterflyblue">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE JULIO  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Jul,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Jul,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDButterflyblue">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count7 > 0){
													foreach ($lista7 as $sale7) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale7->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale7->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale7->getStatus().'</td>
                                                                    <td class="blockText">'.$sale7->getId().'</td> 
                                                                    <td>'.$sale7->getCustomer().' '.$sale7->getLastName().' '.$sale7->getSecondName().'</td>
                                                                    <td>'.$sale7->getPaxxx().' </td>
                                                                    <td>'.$sale7->getService().'</td>
																	<td class="blockText">'.$sale7->getProvider().'</td>
																	<td class="blockText">'.$sale7->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale7->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale7->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale7->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                
                                 echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDAqua">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE AGOSTO  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Ago,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Ago,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDAqua">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                             <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count8 > 0){
													foreach ($lista8 as $sale8) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale8->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale8->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale8->getStatus().'</td>
                                                                    <td class="blockText">'.$sale8->getId().'</td> 
                                                                    <td>'.$sale8->getCustomer().' '.$sale8->getLastName().' '.$sale8->getSecondName().'</td>
                                                                    <td>'.$sale8->getPaxxx().' </td>
                                                                   <td>'.$sale8->getService().'</td>
																	<td class="blockText">'.$sale8->getProvider().'</td>
																	<td class="blockText">'.$sale8->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale8->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale8->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale8->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDVenomgreen">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE SEPTIEMBRE  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Sep,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Sep,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDVenomgreen">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count9 > 0){
													foreach ($lista9 as $sale9) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale9->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale9->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale9->getStatus().'</td>
                                                                    <td class="blockText">'.$sale9->getId().'</td> 
                                                                    <td>'.$sale9->getCustomer().' '.$sale9->getLastName().' '.$sale9->getSecondName().'</td>
                                                                    <td>'.$sale9->getPaxxx().' </td>
                                                                    <td>'.$sale9->getService().'</td>
																	<td class="blockText">'.$sale9->getProvider().'</td>
																	<td class="blockText">'.$sale9->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale9->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale9->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale9->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDYellowgreen">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE OCTUBRE  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Oct,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Oct,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDYellowgreen">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count10 > 0){
													foreach ($lista10 as $sale10) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale10->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale10->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale10->getStatus().'</td>
                                                                    <td class="blockText">'.$sale10->getId().'</td> 
                                                                    <td>'.$sale10->getCustomer().' '.$sale10->getLastName().' '.$sale10->getSecondName().'</td>
                                                                    <td>'.$sale10->getPaxxx().'</td>
                                                                    <td>'.$sale10->getService().'</td>
																	<td class="blockText">'.$sale10->getProvider().'</td>
																	<td class="blockText">'.$sale10->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale10->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale10->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale10->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDOrangesalmon">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE NOVIEMBRE  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Nov,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Nov,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDOrangesalmon">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count11 > 0){
													foreach ($lista11 as $sale11) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale11->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale11->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale11->getStatus().'</td>
                                                                    <td class="blockText">'.$sale11->getId().'</td> 
                                                                    <td>'.$sale11->getCustomer().' '.$sale11->getLastName().' '.$sale11->getSecondName().'</td>
                                                                    <td>'.$sale11->getPaxxx().'</td>
                                                                    <td>'.$sale11->getService().'</td>
																	<td class="blockText">'.$sale11->getProvider().'</td>
																	<td class="blockText">'.$sale11->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale11->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale11->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale11->getTypeVending().'</td> -->
																	
																</tr>';
													}
                                                }
												echo'</tbody>
													</table>
											</div>';
                                
                                
                                
                                
                                
                                echo '<div class="table-responsive">
												<table id="" class=" display table table-bordered table-striped ">
													<thead>
														<tr class="HeaderTDPapayaorange">
															<th class="blockText" colspan="9"  > 
																VENTAS MENSUALES DEL MES DE DICIEMBRE  2019 (WEB / OFFLINE)
															</th>
                                                             <th class="blockText"> $'. number_format($Tot_Pub_Dic,2,".",",")   .'     </th>
                                                              <th class="blockText"> $'. number_format($Tot_Net_Dic,2,".",",")   .'     </th>
                                                            
														</tr>
														
														<tr class="HeaderTDPapayaorange">
                                                            <th class="blockText"> Estatus </th>
                                                            <th class="blockText"> Clave </th>
                                                            <th class="blockText"> Cliente </th>
                                                            <th class="blockText"> Pax </th>
														    <th class="blockText"> Servicio </th>
                                                            <th class="blockText"> Proveedor </th>
                                                            <th class="blockText"> Tipo de servicio </th>
											                <th class="blockText"> Llegada </th>
															<th class="blockText"> Salida </th>
															<th class="blockText"> Público </th>
															<th class="blockText"> Neto </th>
														<!--	<th class="blockText"> Origen </th>                -->
														     
											            </tr>
													</thead>
													<tbody id="myTable" >'; 
                                                 if($count12 > 0){
													foreach ($lista12 as $sale12) {
													 	$Objeto_DateTo = date_create_from_format('Y-m-d', $sale12->getDateTo()); 
													 	$d_m_a_DateTo = date_format($Objeto_DateTo, "d/m/Y");
													 	$Objeto_DateFrom = date_create_from_format('Y-m-d', $sale12->getDateFrom()); 
													 	$d_m_a_DateFrom = date_format($Objeto_DateFrom, "d/m/Y");
														echo '
																<tr class="DataTDover">
                                                                    <td class="blockText">'.$sale12->getStatus().'</td>
                                                                    <td class="blockText">'.$sale12->getId().'</td> 
                                                                    <td>'.$sale12->getCustomer().' '.$sale12->getLastName().' '.$sale12->getSecondName().'</td>
                                                                    <td>'.$sale12->getPaxxx().'</td>
                                                                    <td>'.$sale12->getService().'</td>
																	<td class="blockText">'.$sale12->getProvider().'</td>
																	<td class="blockText">'.$sale12->getTypeService().'</td>
																	<td class="blockText">'. $d_m_a_DateTo.'</td>
																	<td class="blockText">'. $d_m_a_DateFrom.'</td>
																	<td class="blockText">$'.number_format($sale12->getTotal(),2,".",",").'</td>
																	<td class="blockText">$'.number_format($sale12->getSubTotal(),2,".",",").'</td>
																	<!-- <td class="blockText">'.$sale12->getTypeVending().'</td> -->
																	
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
        "order": [[ 1, "desc" ]]
         } )
        
    } );
 </script>

	
</body>
</html>

