<!DOCTYPE html> 
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Reporte de Vtas Consolidado  </title>

	<?php include("views/partialViews/_adminPanelStyles.html"); ?>
	

</head>
<link href="../../css/tables3d.css" rel="stylesheet" type="text/css">
<body  class="nav-md">
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
						
                                
                               
                            <!--  <div class="table-responsive">-->
                              <div >      
												<table id="trips" class="table table-bordered  table-striped ">
													<thead>
														<tr class="LabelTD" >
                                                            <th class="LabelTD" >
                                                            <img src="../../img/Reportes_Vtas/oktrip.png" wight="80" height="60">
                                                            </th>
                                                            <th class="LabelTD"  colspan="11" >                                                            
                                                            OKTRIP.MX <BR>
                                                            CONSOLIDADO <BR>
                                                            ENERO A DICIEMBRE  2019 - 2018 - 2017 -2016 
                                                            </th>
                                                        </tr>
														
														<tr class="LabelTD">
											                <th class="blockText">&nbsp;  </th>
														    <th class="blockText">&nbsp;  </th>
											                <th class="blockText"> NETO </th>
											                <th class="blockText"> PÚBLICO </th>
											                <th class="blockText"> NETO </th>
															<th class="blockText"> PÚBLICO </th>
															<th class="blockText"> NETO </th>
															<th class="blockText"> PÚBLICO </th>
															<th class="blockText"> NETO </th>
															<th class="blockText"> PÚBLICO </th>                
														    <th class="blockText"> NETO </th> 
                                                            <th class="blockText"> PÚBLICO </th> 
											            </tr>
                                                        </tr>
														<tr class="LabelTD">
											                <th class="LabelTD" > SEGMENTO </th>
														    <th class="blockText"> #PAX.  </th>
											                <th class="blockText"><font color="#F4080C"> 2019 </font> </th>
											                <th class="blockText"><font color="#F4080C"> 2019 </font> </th>
											                <th class="blockText"> 2018 </th>
															<th class="blockText"> 2018 </th>
															<th class="blockText"> 2017 </th>
															<th class="blockText"> 2017 </th>
															<th class="blockText"> 2016 </th>
															<th class="blockText"> 2016 </th>                
														    <th class="blockText"> 2015 </th> 
                                                            <th class="blockText"> 2015 </th> 
											            </tr>
													</thead>
                                                    
													<tbody id="myTable">
													
                                
														
																<tr class="DataTDover">
																	<th class="LabelTD">VENTAS WEB</th> 
                                                                    <td class="blockText"> <?php  echo $TOTAL_PAX_WEB_2019 ; ?> </td> 
                                                                    <td class="FieldTD"><!-- $9,096.00 --> <?php  echo "$". number_format($NETO_2019_VTAS_WEB,2,".",",") ;  ?> </td> 
                                                                    <td class="HeaderTable" ><!-- $11,087.00 --> <?php  echo "$". number_format($PUBLICO_2019_VTAS_WEB,2,".",",") ; 
                                                                                                                                                        // echo "$---> ". $Prueba ;
                                                                                                                                         ?></td> 
                                                                    
                                                                    <td class="blockText" > $642,616<?php //echo "$". number_format($NETO_2018_VTAS_WEB,2,".",",") ;  ?> </td> 
                                                                    <td class="blockText"> $799,144<?php// echo "$". number_format($PUBLICO_2018_VTAS_WEB,2,".",",") ;  ?></td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td> 
                                                                    <td class="blockText">  </td> 
																</tr>
                                                        
                                                                    <tr class="DataTDover">
																	<th class="LabelTD">VENTAS OFF-LINE</th> 
                                                                    <td class="blockText"><?php echo $TOTAL_PAX_OFFLINE_2019; ?> </td> 
                                                                    <td class="FieldTD"><!--$6,683.00--><?php  echo "$". number_format($NETO_2019_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                    <td class="HeaderTable"><!--$8,036.00--><?php  echo "$". number_format($PUBLICO_2019_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                       
                                                                    <td class="blockText"> $65,197<?php// echo "$". number_format($NETO_2018_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                    <td class="blockText">$89,603 <?php //echo "$". number_format($PUBLICO_2018_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                        
                                                                  <tr class="DataTDover">
																	<th class="LabelTD">REPS OKTRIP.MX</th> 
                                                                    <td class="blockText"><?php echo $TOTAL_PAX_OFFLINE_REPS_2019; ?></td> 
                                                                    <td class="FieldTD"><!--$158,277.50--><?php echo "$". number_format($NETO_2019_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                    <td class="HeaderTable"><!--$186,047.00--><?php echo "$". number_format($PUBLICO_2019_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                      
                                                                    <td class="blockText">$1,585,172<?php// echo "$". number_format($NETO_2018_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                    <td class="blockText">$2,735,095<?php// echo "$". number_format($PUBLICO_2018_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                                  <tr class="DataTDover">
																	<th class="LabelTD">ULTRAMAR</th> 
                                                                    <td class="blockText"><?php  echo $TOTAL_PAX_ULTRAMAR_2019; ?>       </td> 
                                                                    <td class="FieldTD"><!--$18,359.97--><?php echo "$". number_format($NETO_2019_VTAS_ULTRAMAR,2,".",",") ;  ?>  </td> 
                                                                    <td class="HeaderTable"><!--$22,624.00--><?php echo "$". number_format($PUBLICO_2019_VTAS_ULTRAMAR,2,".",",") ;  ?></td>
                                                                      
                                                                    <td class="blockText">$553,226</td> 
                                                                    <td class="blockText">$723,477</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                        
                                                                   <tr class="DataTDover">
																	<th class="LabelTD">GPH RVAS</th> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="FieldTD">&nbsp;</td> 
                                                                    <td class="HeaderTable">&nbsp;</td>
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
													                <tr class="DataTDover">
																	<th class="LabelTD">TRANSPORTACIONES PAGADAS 7USD</th> 
                                                                    <td class="blockText"><!--21--><?php  echo $TOT_PAX_2019 ;  ?> </td> 
                                                                    <td class="FieldTD"><!--$2,473.00--><?php  echo "$". number_format($NETO_2019_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="HeaderTable"><!--$5,346.00--><?php  echo "$". number_format($PUBLICO_2019_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="blockText"><?php// echo "$". number_format($NETO_2018_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="blockText"><?php// echo "$". number_format($PUBLICO_2018_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
																</tr>
                                                        
                                                                    
																<tr class="DataTDover">
																	<th class="LabelTD">TRANSPORTACIÓN CORTESIA</th> 
                                                                    <td class="blockText"><!--3--><?php  echo $TOTAL_PAX_GRATIS_2019 ;  ?> </td> 
                                                                    <td class="FieldTD">&nbsp;</td> 
                                                                    <td class="HeaderTable">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                                   <tr class="DataTDover">
																	<th class="LabelTD">TRANSPORTACIÓN VOLARIS LLEGADAS</th> 
                                                                    <td class="blockText"><!--348--><?php  echo $TOT_PAX_IN_2019 ;  ?></td> 
                                                                    <td class="FieldTD">&nbsp;</td> 
                                                                    <td class="HeaderTable">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr> 
                                                        
                                                        
                                                        
                                                                  <tr class="DataTDover">
																	<th class="LabelTD">TRANSPORTACIÓN VOLARIS SALIDAS</th> 
                                                                    <td class="blockText"><!--346--><?php  echo $TOT_PAX_OUT_2019 ;  ?></td> 
                                                                    <td class="FieldTD">&nbsp;</td> 
                                                                    <td class="HeaderTable">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                                  <tr class="DataTDover">
																	<th class="LabelTD">&nbsp;</th> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="FieldTD">&nbsp;</td> 
                                                                    <td class="HeaderTable">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">$2,553,696</td> 
                                                                    <td class="blockText">$3,601,276</td> 
                                                                    <td class="blockText">$3,912,302</td> 
                                                                    <td class="blockText">$4,443,353</td> 
                                                                    <td class="blockText">$3,608,655</td> 
                                                                    <td class="blockText">$4,299,104</td> 
																</tr>
                                                        
                                                        
                                                        
                                                                   <tr class="DataTDover">
																	<th class="LabelTD">&nbsp;</th> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="FieldTD">&nbsp;</td> 
                                                                    <td class="HeaderTable">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
													                <tr class="LabelTD">
																	<th  class="LabelTD">TOTALES</th> 
                                                                    <th class="blockText" ><!--718--><?php  echo $TOT_PAX; ?> </th> 
                                                                        
                                                                    <th class="blockText"><!--$194,889.47--><?php  echo "$". number_format($TOT_N_2019,2,".",",") ;  ?></th> 
                                                                    <th class="blockText"><!--$233,140.00--><?php echo "$". number_format($TOT_P_2019,2,".",",") ;  ?> </th> 
                                                                        
                                                                    <th class="blockText">$2,846,211<?php// echo "$". number_format($TOT_N_2018,2,".",",") ;  ?></th> 
                                                                    <th class="blockText">$4,347,319<?php// echo "$". number_format($TOT_P_2018,2,".",",") ;  ?> </th>  
                                                                    <th class="blockText">$2,553,696</th> 
                                                                    <th class="blockText">$3,601,276</th> 
                                                                    <th class="blockText">$3,912,302</th> 
                                                                    <th class="blockText">$4,443,353</th> 
                                                                    <th class="blockText">$3,608,655</th> 
                                                                    <th class="blockText">$4,299,104</th>  
																</tr>
                                                        
                                                        
												</tbody>
								         </table>
                                  <?php    date_default_timezone_set("America/Cancun");  echo  date("d/m/Y");   ?>││  M&eacute;xico  ││  <a href="www.oktrip.mx">www.oktrip.mx !</a> 
											</div>
								
	
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- footer content -->
			<footer>
					
			</footer>
		</div>
	</div>
	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/scripts-admin.js"></script> 
    
     <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  
    

	
</body>
</html>

