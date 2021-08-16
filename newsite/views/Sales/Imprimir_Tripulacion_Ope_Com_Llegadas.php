<!DOCTYPE html> 
<html lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Panel administrativo Oktrip! </title>

	<?php //include("views/partialViews/_adminPanelStyles.html"); ?>
	
<link rel="icon" type="image/png" href="/img/iconos/favicon.png" />
</head>
<link href="../../css/animate/Ollin.css" rel="stylesheet">
<link href="../../css/tables3d.css" rel="stylesheet" type="text/css">
<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<!-- sidebar -->
			<?php //include("views/partialViews/_adminPanelSidebar.php"); ?>

			<!-- top navigation -->
			<?php //  include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_title">
								<?php include "Imprimir_Encabezados_Ope_Com_Llegadas.php";  ?>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="controlPanel"></div>
								<div class="clear"></div>
                            
                                 
                                <?php 
									$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1);  
									$Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
                                                          
                               //echo '<div class="table-responsive">
								echo '<div>
												<table align="center" width="70%" border="2" id="trips" >
													<thead>
                                                   	<tr>
                                                            <th>No</th>
                                                            <th>NOMBRE</th>
															<th>-TIPO-</th> 
                                                            
											                <th>No.<BR>VUELO</th>
                                                            <th>HR.<BR>VUELO</th>
                                                            <th>PICK<BR>UP</th> 
														    <th>PAX</th>
											                
											                <th>UNI.</th>
											                <th>OPERADOR</th>
															<th>No.<BR>RVA</th>
															<th class="DataPrint">VUELO<BR>SALIDA</th>
															<th class="DataPrint">DO</th>                
                                                            <th class="DataPrint">PICKUP<BR>SALIDA</th>                
                                                            <th class="DataPrint">OPERADOR<BR>SALIDA</th>      
                                                           </tr>
													</thead>
													<tbody id="myTable">'; 
                                                   
                         for($i = 1; $i < 9; $i++){
                                $i ;
                          } 
                                
                                $No = 0 ;
													foreach ($lista as $volaris) {
                                                        
                                                        
                                                        
                                                         $No = $No + 1 ; 
													     $Objeto_DateTo = date_create_from_format('Y-m-d', $volaris->getfecha_llegada()); 
													 	 $d_m_a_fecha_llegada = date_format($Objeto_DateTo, "d/m/Y");
													 	 $Objeto_DateFrom = date_create_from_format('Y-m-d', $volaris->getfecha_salida()); 
													 	 $d_m_a_fecha_salida = date_format($Objeto_DateFrom, "d/m/Y");
                           
                          
														echo '
																<tr>
                                                                    <td align="center">'.$No .'</td>
                                                                    <td align="center">'.$volaris->getnombre_completo() .'</td>
                                                                    <td align="center">'.$volaris->getName() .'</td>
                                                                    <td align="center">'.$volaris->getno_vuelo_llegada().'</td>
                                                                    <td align="center">'.$volaris->gethora_vuelo_llegada().'</td>
                                                                    <td align="center"><strong>'.$volaris->gethora_pickup_llegada().'</strong> </td>
                                                                    <td align="center">'.$volaris->getpaxxx().'</td>
                                                                  
                                                                    <td align="center">'.$volaris->getunidad_llegada().'</td>
                                                                    <td align="center">'.$volaris->getoperador_llegada().'</td>
                                                                    <td align="center">'.$volaris->getno_reserva().'</td>
                                                                    <td class="DataPrint" align="center"><strong>'.$volaris->getno_vuelo_salida().'</strong></td>
                                                                    <td class="DataPrint" align="center"><strong>'.$volaris->gethora_vuelo_salida().'</strong></td>
                                                                    <td class="DataPrint" align="center"><strong>'.$volaris->gethora_pickup_salida().'</strong></td>
                                                                    <td class="DataPrint" align="center"><strong>'.$volaris->getoperador_salida().'</strong></td>
																	</tr>';
													}
												echo'</tbody>
													</table>
											</div>';
								?>
	                             <div align="left">
								  <HR> <br> <p> Observaciones:</p>
								  <br>
								  <br>
								  <br>
								  <br><HR>
								 </div>
								<div align="center">
                                 <p> AV.CARLOS NADER MZ01 LT.1 A 3 SMZA.2  CENTRO CANCUN QUINTANA ROO  CP:77500  TEL: 529981406570       </p>
                                 <p>ELABORO:  FABIOLA  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;      RECIBIO: SANTOS  A. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;                RECIBIO JOAZ  JIMENEZ         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;                         <!--RECIBIO RICARDO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;-->                         RECIBIO ELVIN</p>
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
    
</body>
</html>

