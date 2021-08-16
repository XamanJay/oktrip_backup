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
								<?php  include "◣_◢-Graficas_Filtros.php";  ?>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="controlPanel"></div>
								<div class="clear"></div>
								<?php 
										
								
									
									
								
                                
                             
                                
                                
                                
                               
                                
                                
                                
                                  
                                
                                
                               
                                
                                
                              
                                
                                
                                 
                                
                                
                                
                                
                                 
                                
                                
                                
                                
                                
                               
                                
                                
                                
                                
                                
                                
                         
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                               
                                
                                
                                
                                
                                
                                
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

