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
<link href="../../css/animate/Ollin.css" rel="stylesheet">
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
                              <div class="MOVIMIENTO_DESCENDIENDO" >      
												<table id="trips" class="table table-bordered  table-striped ">
													<thead>
														<tr class="LabelTD" >
                                                            <th class="LabelTD" >
                                                            <img  class="MOVIMIENTO_CRECIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50">
                                                            </th>
                                                            <th class="LabelTD"  colspan="11" >                                                            
                                                            OKTRIP.MX │ CONSOLIDADO.  <BR> ENERO A DICIEMBRE:  2019 - 2018 - 2017 - 2016 - 2015
                                                            </th>
                                                        </tr>
														
														<tr class="LabelTD">
											                <th class=" CENTRADO" >SEGMENTO <BR> </th>
														    <th class="CENTRADO"> PAX <BR>2019 </th>
											                <th class="CENTRADO"> NETO<BR>2019 </th>
											                <th class="CENTRADO"> PÚBLICO<BR>2019 </th>
											                <th class="CENTRADO"> NETO <BR>2018</th>
															<th class="CENTRADO"> PÚBLICO <BR>2018</th>
															<th class="CENTRADO"> NETO <BR>2017</th>
															<th class="CENTRADO"> PÚBLICO<BR>2017 </th>
															<th class="CENTRADO"> NETO <BR>2016</th>
															<th class="CENTRADO"> PÚBLICO <BR>2016</th>                
														    <th class="CENTRADO"> NETO <BR>2015</th> 
                                                            <th class="CENTRADO"> PÚBLICO <BR>2015</th> 
											            </tr>
                                                       
														<!--<tr class="LabelTD">
											                <th class="CENTRADO" >  </th>
														    <th class="CENTRADO"><font color="#F4080C" size="2"> 2019 </font>  </th>
											                <th class="CENTRADO"><font color="#F4080C"> 2019 </font> </th>
											                <th class="CENTRADO"><font color="#F4080C"> 2019 </font> </th>
											                <th class="CENTRADO"> 2018 </th>
															<th class="CENTRADO"> 2018 </th>
															<th class="CENTRADO"> 2017 </th>
															<th class="CENTRADO"> 2017 </th>
															<th class="CENTRADO"> 2016 </th>
															<th class="CENTRADO"> 2016 </th>                
														    <th class="CENTRADO"> 2015 </th> 
                                                            <th class="CENTRADO"> 2015 </th> 
											            </tr>-->
													</thead>
                                                    
													<tbody id="myTable">
													
                                
														
																<tr class="DataTDover">
																	<th class="LabelTD">VENTAS WEB.</th> 
                                                                    <td class="CENTRADO"> <?php  echo $TOTAL_PAX_WEB_2019 ; ?> </td> 
                                                                    <td class="FieldTDcentrado"><!-- $9,096.00 --> <?php  echo "$". number_format($NETO_2019_VTAS_WEB,2,".",",") ;  ?> </td> 
                                                                    <td class="HeaderTablecentrado" ><!-- $11,087.00 --> <?php  echo "$". number_format($PUBLICO_2019_VTAS_WEB,2,".",",") ; 
                                                                                                                                                        // echo "$---> ". $Prueba ;
                                                                                                                                         ?></td> 
                                                                    
                                                                    <td class="CENTRADO" > $642,616<?php //echo "$". number_format($NETO_2018_VTAS_WEB,2,".",",") ;  ?> </td> 
                                                                    <td class="CENTRADO"> $799,144<?php// echo "$". number_format($PUBLICO_2018_VTAS_WEB,2,".",",") ;  ?></td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td>
                                                                    <td class="blockText">  </td> 
                                                                    <td class="blockText">  </td> 
																</tr>
                                                        
                                                                    <tr class="DataTDover">
																	<th class="LabelTD">VENTAS OFF-LINE.</th> 
                                                                    <td class="CENTRADO"><?php echo $TOTAL_PAX_OFFLINE_2019; ?> </td> 
                                                                    <td class="FieldTDcentrado"><!--$6,683.00--><?php  echo "$". number_format($NETO_2019_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                    <td class="HeaderTablecentrado"><!--$8,036.00--><?php  echo "$". number_format($PUBLICO_2019_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                       
                                                                    <td class="CENTRADO"> $65,197<?php// echo "$". number_format($NETO_2018_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                    <td class="CENTRADO">$89,603 <?php //echo "$". number_format($PUBLICO_2018_VTAS_OFFLINE,2,".",",") ;  ?></td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                        
                                                                  <tr class="DataTDover">
																	<th class="LabelTD">REPS OKTRIP.MX</th> 
                                                                    <td class="CENTRADO"><?php echo $TOTAL_PAX_OFFLINE_REPS_2019; ?></td> 
                                                                    <td class="FieldTDcentrado"><!--$158,277.50--><?php echo "$". number_format($NETO_2019_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                    <td class="HeaderTablecentrado"><!--$186,047.00--><?php echo "$". number_format($PUBLICO_2019_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                      
                                                                    <td class="CENTRADO">$1,585,172<?php// echo "$". number_format($NETO_2018_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                    <td class="CENTRADO">$2,735,095<?php// echo "$". number_format($PUBLICO_2018_VTAS_OFFLINE_REPS,2,".",",") ;  ?></td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                                  <tr class="DataTDover">
																	<th class="LabelTD">ULTRAMAR.</th> 
                                                                    <td class="CENTRADO"><?php  echo $TOTAL_PAX_ULTRAMAR_2019; ?>       </td> 
                                                                    <td class="FieldTDcentrado"><!--$18,359.97--><?php echo "$". number_format($NETO_2019_VTAS_ULTRAMAR,2,".",",") ;  ?>  </td> 
                                                                    <td class="HeaderTablecentrado"><!--$22,624.00--><?php echo "$". number_format($PUBLICO_2019_VTAS_ULTRAMAR,2,".",",") ;  ?></td>
                                                                      
                                                                    <td class="CENTRADO">$553,226</td> 
                                                                    <td class="CENTRADO">$723,477</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                        <tr class="DataTDover">
																	<th class="LabelTD">ALOHA KAI.</th> 
                                                                    <td class="CENTRADO"><?php  echo $TOTAL_PAX_ALOHAKAI_2019; ?>       </td> 
                                                                    <td class="FieldTDcentrado"><!--$18,359.97--><?php echo "$". number_format($NETO_2019_VTAS_ALOHAKAI,2,".",",") ;  ?>  </td> 
                                                                    <td class="HeaderTablecentrado"><!--$22,624.00--><?php echo "$". number_format($PUBLICO_2019_VTAS_ALOHAKAI,2,".",",") ;  ?></td>
                                                                      
                                                                    <td class="CENTRADO">&nbsp;</td> 
                                                                    <td class="CENTRADO">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                        
                                                       <tr class="DataTDover">
																	<th class="LabelTD">AZUL TRAVEL.</th> 
                                                                    <td class="CENTRADO"><?php  echo $TOTAL_PAX_AZULTRAVEL_2019; ?>       </td> 
                                                                    <td class="FieldTDcentrado"><!--$18,359.97--><?php echo "$". number_format($NETO_2019_VTAS_AZULTRAVEL,2,".",",") ;  ?>  </td> 
                                                                    <td class="HeaderTablecentrado"><!--$22,624.00--><?php echo "$". number_format($PUBLICO_2019_VTAS_AZULTRAVEL,2,".",",") ;  ?></td>
                                                                      
                                                                    <td class="CENTRADO">&nbsp;</td> 
                                                                    <td class="CENTRADO">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
																</tr>
                                                        
                                                        
                                                        
                                                              
                                                        
                                                        
                                                        
                                                                   <tr class="DataTDover">
																	<th class="LabelTD">GPH RVAS.</th> 
                                                                    <td class="CENTRADO"><?php  echo $TOTAL_PAX_GPH_2019; ?>       </td> 
                                                                    <td class="FieldTDcentrado"><?php echo "$". number_format($NETO_2019_VTAS_GPH,2,".",",") ;  ?>  </td> 
                                                                    <td class="HeaderTablecentrado"><?php echo "$". number_format($PUBLICO_2019_VTAS_GPH,2,".",",") ;  ?></td>
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
																	<th class="LabelTD">TRANSPORTACIONES PAGADAS 7USD.</th> 
                                                                    <td class="CENTRADO"><!--21--><?php  echo $TOT_PAX_2019 ;  ?> </td> 
                                                                    <td class="FieldTDcentrado"><!--$2,473.00--><?php  echo "$". number_format($NETO_2019_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="HeaderTablecentrado"><!--$5,346.00--><?php  echo "$". number_format($PUBLICO_2019_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="CENTRADO"><?php// echo "$". number_format($NETO_2018_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="CENTRADO"><?php// echo "$". number_format($PUBLICO_2018_VTAS_TRAS_7USD,2,".",",") ;  ?></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
                                                                    <td class="blockText"></td> 
																</tr>
                                                        
                                                                    
																<tr class="DataTDover">
																	<th class="LabelTD">TRANSPORTACIÓN CORTESIA.</th> 
                                                                    <td class="CENTRADO"><!--3--><?php  echo $TOTAL_PAX_GRATIS_2019 ;  ?> </td> 
                                                                    <td class="FieldTDcentrado">&nbsp;</td> 
                                                                    <td class="HeaderTablecentrado">&nbsp;</td> 
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
																	<th class="LabelTD">TRANSPORTACIÓN VOLARIS LLEGADAS.</th> 
                                                                    <td class="CENTRADO"><!--348--><?php  echo $TOT_PAX_IN_2019 ;  ?></td> 
                                                                    <td class="FieldTDcentrado">&nbsp;</td> 
                                                                    <td class="HeaderTablecentrado">&nbsp;</td> 
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
																	<th class="LabelTD">TRANSPORTACIÓN VOLARIS SALIDAS.</th> 
                                                                    <td class="CENTRADO"><!--346--><?php  echo $TOT_PAX_OUT_2019 ;  ?></td> 
                                                                    <td class="FieldTDcentrado">&nbsp;</td> 
                                                                    <td class="HeaderTablecentrado">&nbsp;</td> 
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
                                                                    <td class="CENTRADO">&nbsp;</td> 
                                                                    <td class="FieldTDcentrado">&nbsp;</td> 
                                                                    <td class="HeaderTablecentrado">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="blockText">&nbsp;</td> 
                                                                    <td class="CENTRADO">$2,553,696</td> 
                                                                    <td class="CENTRADO">$3,601,276</td> 
                                                                    <td class="CENTRADO">$3,912,302</td> 
                                                                    <td class="CENTRADO">$4,443,353</td> 
                                                                    <td class="CENTRADO">$3,608,655</td> 
                                                                    <td class="CENTRADO">$4,299,104</td> 
																</tr>
                                                        
                                                        
                                                        
                                                                   <tr class="DataTDover">
																	<th class="LabelTD">&nbsp;</th> 
                                                                    <td class="CENTRADO">&nbsp;</td> 
                                                                    <td class="FieldTDcentrado">&nbsp;</td> 
                                                                    <td class="HeaderTablecentrado">&nbsp;</td> 
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
																	<th  class="CENTRADO">TOTALES : </th> 
                                                                    <th class="CENTRADO_TOT" ><!--718--><?php  echo $TOT_PAX; ?> </th> 
                                                                        
                                                                    <th class="CENTRADO_TOT"><!--$194,889.47--><?php  echo "$". number_format($TOT_N_2019,2,".",",") ;  ?></th> 
                                                                    <th class="CENTRADO_TOT"><!--$233,140.00--><?php echo "$". number_format($TOT_P_2019,2,".",",") ;  ?> </th> 
                                                                        
                                                                    <th class="CENTRADO">$2,846,211<?php// echo "$". number_format($TOT_N_2018,2,".",",") ;  ?></th> 
                                                                    <th class="CENTRADO">$4,347,319<?php// echo "$". number_format($TOT_P_2018,2,".",",") ;  ?> </th>  
                                                                    <th class="CENTRADO">$2,553,696</th> 
                                                                    <th class="CENTRADO">$3,601,276</th> 
                                                                    <th class="CENTRADO">$3,912,302</th> 
                                                                    <th class="CENTRADO">$4,443,353</th> 
                                                                    <th class="CENTRADO">$3,608,655</th> 
                                                                    <th class="CENTRADO">$4,299,104</th>  
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

