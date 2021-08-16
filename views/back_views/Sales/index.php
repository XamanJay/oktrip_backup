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

<body class="nav-md">
	<div class="container body">
		<div class="main_container">

			<!-- sidebar -->
			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>

			<!-- top navigation -->
			<?php include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<ol class="breadcrumb">
							<li><a href="/ventas/es">Home</a></li>
							<li class="active">Ventas</li>
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Tabla de ventas <small></small></h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="controlPanel"></div>
								<div class="clear"></div>
								<table id='sales' class="dataTable table table-striped table-bordered table-responsive wrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Estado</th>
											<th>Clave</th>
											<th>Fecha</th>
											<th>Cliente</th>
											<th>Email</th>
											<th>Country</th>
											<th>City</th>
											<th>Servicio</th>
											<th>Tipo de servicio</th>
											<th>Llegada</th>
											<th>Salida</th>
											<th>Publico</th>
											<th>Neto</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Estado</th>
											<th>Clave</th>
											<th>Fecha</th>
											<th>Cliente</th>
											<th>Email</th>
											<th>Country</th>
											<th>City</th>
											<th>Servicio</th>
											<th>Tipo de servicio</th>
											<th>Llegada</th>
											<th>Salida</th>
											<th>Publico</th>
											<th>Neto</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
				</div>
				<div class="clearfix"></div>
			</footer>
		</div>
	</div>

	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
	<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/SweetAlert/sweetalert2.min.js"></script>

	<!-- Datatables -->
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

	<script type="text/javascript" src="/js/scripts-admin.js"></script> 

</body>
</html>