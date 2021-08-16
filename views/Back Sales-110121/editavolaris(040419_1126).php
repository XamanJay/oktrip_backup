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

			<?php include("views/partialViews/_adminPanelSidebar.php"); ?>
			<?php // include("views/partialViews/_adminPanelTopNav.php"); ?>

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="x_panel">
							
							<form name="in_out_volaris" id="formSale" method="POST" action="/ventas/cambiovolaris" >
								<div class="row">
                                    
 <?php                               
    $Id_Volaris = $row['Id_Volaris'];
    $nombre_completo = $row['nombre_completo'];
 //  echo $nombre_completo.'<-----  Nombre completo' ;                                      
    $fecha_llegada = $row['fecha_llegada'];
    $servicio_llegada = $row['servicio_llegada'];
    $no_vuelo_llegada = $row['no_vuelo_llegada'];
    $hora_vuelo_llegada = $row['hora_vuelo_llegada'];
    $hora_pickup_llegada = $row['hora_pickup_llegada'];
    $paxxx = $row['paxxx'];
    $empresa = $row['empresa'];
    $unidad_llegada = $row['unidad_llegada'];
    $operador_llegada = $row['operador_llegada'];
    $no_reserva = $row['no_reserva'];
    $fecha_salida = $row['fecha_salida'];
    $servicio_salida = $row['servicio_salida'];
    $no_vuelo_salida = $row['no_vuelo_salida'];
    $hora_vuelo_salida = $row['hora_vuelo_salida'];
    $hora_pickup_salida = $row['hora_pickup_salida'];
    $unidad_salida = $row['unidad_salida'];
    $operador_salida = $row['operador_salida'];
     $comentarios = $row['comentarios'];       
                                    
    $Objeto_DateTo = date_create_from_format('Y-m-d',  $fecha_llegada); 
     $m_d_a_fecha_llegada = date_format($Objeto_DateTo, "m/d/Y");
                                    
    
       // especial mes dia año   
                                   // echo $fecha_salida;

if ($fecha_salida == '0000-00-00'  )
                 { $m_d_a_fecha_salida = '' ;  } 
    else {
        $Objeto_DateFrom = date_create_from_format('Y-m-d', $fecha_salida); 
        $m_d_a_fecha_salida = date_format($Objeto_DateFrom, "m/d/Y"); 
    } 
                                  
                    
   
     ?>                                   
                                        
                                                    
                                  

				     			 
                                    
                                    <div class=" col-md-12" style="padding:5px;background-color: #d9edf7;margin-bottom: 20px;"> 
									    <div >
                                            <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                                <label><font color="000000" > MODIFICACIÓN LLEGADAS. / SALIDAS.  </font></label>
                                            </p>
									    </div>
									</div>
                                    
                                    
                                    
				     				<div  class="  col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     				
				     				  <div class="form-group  col-sm-5">
										<label for="nombre_completo"><font color="000000" >Nombre.  </font></label>
                                            <input type="hidden" name="Id_Volaris" value="<?php echo $Id_Volaris; ?>">
											<input placeholder="Nombre completo" autofocus id="nombre_completo" name="nombre_completo" class="form-control" type="text" value="<?php  echo $nombre_completo; ?>" required>
										</div>
										<div class="col-md-2  form-group">
											<label for="no_reserva"><font color="000000" >Número de Reserva. </font></label>
											<input id="no_reserva" name="no_reserva" class="form-control" type="text" value="<?php echo $no_reserva; ?>" required>
										</div>
										<div class="col-md-2  form-group">
											<label for="empresa"><font color="000000" >Empresa.</font></label>
											<input id="empresa" name="empresa" class="form-control" type="text" value="<?php  echo $empresa;    ?>" required>
										</div>
										<div class="col-md-1  form-group">
											<label for="paxxx"><font color="000000" >"Pax".</font></label>
											<input id="paxxx" name="paxxx" class="form-control" type="text" value="<?php echo $paxxx ?>" required>
										</div>
										
									</div>									
                                    
                    <?php
						$today = date("d-m-Y");
						$today1 = date("d-m-Y",strtotime($today."+ 1 day"));
					?>

									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
											
										<div class="form-group  col-sm-2">
											<label for="fecha_llegada"><font color="000000" >Fecha llegada.</font></label>
											<input  id="fecha_llegada"  name="fecha_llegada" class="form-control" type="text" value="<?php echo  $m_d_a_fecha_llegada; ?>" >
										</div>
										<div class="form-group  col-sm-2">
											<label for="servicio_llegada"><font color="000000" >Servicio llegada. </font></label>
											<input id="servicio_llegada" name="servicio_llegada" class="form-control" type="text" value="<?php echo $servicio_llegada; ?>" >
										</div>
										<div class="form-group  col-sm-2">
											<label for="no_vuelo_llegada" class="label-form"><font color="000000" >No. Vuelo.</font></label>
											<input id="no_vuelo_llegada" name="no_vuelo_llegada" class="form-control" type="text" value="<?php echo $no_vuelo_llegada; ?>" >
											
										</div>
										<div class="form-group  col-sm-1">
											<label for="hora_vuelo_llegada"><font color="000000" >HoraVuelo.</font></label>
											<input placeholder="00:00" id="hora_vuelo_llegada" name="hora_vuelo_llegada" class="form-control" type="text" value="<?php echo $hora_vuelo_llegada; ?>" >
										</div>
										<div class="form-group  col-sm-1">
											<label for="hora_pickup_llegada"><font color="000000" >PickUp.</font></label>
											<input placeholder="00:00" id="hora_pickup_llegada" name="hora_pickup_llegada" class="form-control" type="text" value="<?php echo $hora_pickup_llegada; ?>" >
										</div>
										
                                        
                                         <div class="form-group  col-sm-2">
											<label for="uni_llegada"><font color="000000" >Unidad.</font></label>
											<select id="uni_llegada"  name="uni_llegada" class="form-control">
                                                <option value="<?php echo $unidad_llegada; ?>" selected><?php echo $unidad_llegada; ?> </option>
                                                <option value="0">0</option>
                                                <option value="1" >1</option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                            </select>
										</div>
                                        
                                        
										<div class="form-group  col-sm-2">
											<label for="operador_llegada"><font color="000000" >Operador.</font></label>
											<select  id="operador_llegada" name="operador_llegada" class="form-control">
                                                <option value="<?php echo $operador_llegada; ?>" selected><?php echo $operador_llegada; ?></option>
                                                <option value="NINGUNO"> Seleccionar.</option>
                                                <option value="JOAZ">JOAZ</option>
                                                <option value="RIKI"> RIKI </option>
                                                <option value="RICARDO"> RICARDO </option>
                                                <option value="SANTOS"> SANTOS </option>
                                                <option value="APOYO"> APOYO </option>
                                                <option value="SANTOS/RICARDO"> SANTOS/RICARDO </option>
                                               </select>
										</div>
				    </div>

									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                        
										<div class="form-group  col-sm-2">
											<label for="fecha_salida"><font color="000000" >Fecha salida.</font></label>
											<input id="fecha_salida" name="fecha_salida" class="form-control" type="text" value="<?php echo $m_d_a_fecha_salida; ?>" >
										</div>
										<div class="form-group  col-sm-2">
											<label for="servicio_salida"><font color="000000" >Servicio salida. </font></label>
											<input id="servicio_salida" name="servicio_salida" class="form-control" type="text" value="<?php echo $servicio_salida; ?>" >
										</div>
										<div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >No. Vuelo.</font></label>
											<input id="no_vuelo_salida" name="no_vuelo_salida" class="form-control" type="text" value="<?php echo $no_vuelo_salida; ?>" >
											
										</div>
										<div class="form-group  col-sm-1">
											<label for="hora_vuelo_salida"><font color="000000" >HoraVuelo.</font></label>
											<input placeholder="00:00" id="hora_vuelo_salida" name="hora_vuelo_salida" class="form-control" type="text" value="<?php echo $hora_vuelo_salida; ?>" >
										</div>
										<div class="form-group  col-sm-1">
											<label for="hora_pickup_salida"><font color="000000" >PickUp.</font></label>
											<input placeholder="00:00"  id="hora_pickup_salida" name="hora_pickup_salida" class="form-control" type="text" value="<?php echo $hora_pickup_salida; ?>" >
										</div>
										
                                        
                                        <div class="form-group  col-sm-2">
											<label for="uni_salida"><font color="000000" >Unidad.</font></label>
											<select id="uni_salida"  name="uni_salida" class="form-control">
                                                <option value="<?php echo $unidad_salida;  ?>" selected><?php echo $unidad_salida;  ?></option>
                                                <option value="0"> 0</option>
                                                <option value="1" >1</option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                            </select>
										</div>
                                        
                                        
										<div class="form-group  col-sm-2">
											<label for="operador_salida"><font color="000000" >Operador.</font></label>
											<select id="operador_salida"  name="operador_salida" class="form-control">
                                                <option value="<?php echo $operador_salida; ?>" selected><?php echo $operador_salida; ?></option>
                                                <option value="NINGUNO">Seleccionar.</option>
                                                <option value="JOAZ">JOAZ</option>
                                                <option value="RIKI"> RIKI </option>
                                                <option value="RICARDO"> RICARDO </option>
                                                <option value="SANTOS"> SANTOS </option>
                                                <option value="APOYO"> APOYO </option>
                                                <option value="SANTOS/RICARDO"> SANTOS/RICARDO </option>
                                            </select>
										</div>
									</div>
						
									
                                    
                                     <div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
                                        <div class="form-group  col-sm-8">
											<label for="comentarios" class="label-form"><font color="000000" >Comentarios.</font></label>
											<!--<input id="comentarios" name="comentarios" class="form-control" type="text" value="<?php // echo $comentarios; ?>" >-->
                                             <textarea id="comentarios" name="comentarios" class="form-control"  value=""  size=10 rows=3 cols=35   > <?php echo $comentarios; ?></textarea>
								       </div>
                                    
                                            <div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											<input type="button" class="btn btn-primary" value=" :: M O D I F I C A R :: " name="B01" onClick="ValidaCampos()" >
								        </div>
                                            
                                       
                                            <div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											 <input type="reset" class="btn btn-primary"  value=" :: R E S E T :: ">
											</div>
                                    
                                    </div>
                                    
                                    
                                    
                                    	<!--<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
                                            
                                            
                                            
									    <div>
                                             <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                              
                                                <input type="button" class="btn btn-primary" value=" :: G U A R D A R :: " name="B01" onClick="ValidaCampos()" >
                                                <input type="reset" class="btn btn-primary"  value=" :: R E S E T :: ">
                                            </p>
									    </div>
									</div>-->

								</div> <!-- class="row" -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer content -->
		<footer>
			<div class="pull-right">  <!--<a href="https://colorlib.com"> Colorlib</a>-->	</div>
			<div class="clearfix"></div>
		</footer>
	</div>

<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/icheck.min.js"></script>
<script type="text/javascript" src="/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/moment/moment.min.js"></script>
<script type="text/javascript" src="/js/moment/locale/es.js"></script>
<script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/SweetAlert/sweetalert2.min.js"></script>

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

<!-- Choosen -->
<script type="text/javascript" src="/js/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="/js/chosen/prism.js" charset="utf-8"></script>
<script type="text/javascript" src="/js/chosen/init.js" charset="utf-8"></script>

<script type="text/javascript" src="/js/scripts-admin.js"></script>
    
    
    
    
    
    <script>
		$(document).ready(function(){

			$("#myInput").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#myTable tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			});

			var dateFormat = "mm/dd/yy",
			from = $( "#fecha_llegada" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on( "change", function() {
				to.datepicker( "option", "minDate", getDate( this ) );
			}),
			to = $( "#fecha_salida" ).datepicker({
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
    
    <script> 
	function ValidaCampos() {
       
         var jvi_texto_correcto = /[\d\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
		var jvi_numero_correcto = /[\D\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
		var jvi_textoynumero_correcto = /[\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
       
       if (in_out_volaris.nombre_completo.value  == "")   {
              alert("El campo: Nombre, no debe estar vacío, favor de verificar ");    in_out_volaris.nombre_completo.focus(); return false;
        }  
       if (in_out_volaris.no_reserva.value  == "")   {
              alert("El campo: Número de Reserva, no debe estar vacío, favor de verificar ");    in_out_volaris.no_reserva.focus(); return false;
        }  
        if (in_out_volaris.empresa.value  == "")   {
              alert("El campo: Empresa, no debe estar vacío, favor de verificar ");    in_out_volaris.empresa.focus(); return false;
        }  
        if (in_out_volaris.paxxx.value  == "")   {
              alert("El campo: PAX, no debe estar vacío, favor de verificar ");    in_out_volaris.paxxx.focus(); return false;
        }  
        if (in_out_volaris.fecha_llegada.value  == "")   {
              alert("El campo: Fecha llegada, no debe estar vacío, favor de verificar ");    in_out_volaris.fecha_llegada.focus(); return false;
        }  
        if(jvi_texto_correcto.test(in_out_volaris.nombre_completo.value)) {
       alert('Ha escrito un caracter no valido en el campo Nombre, verifique por favor.');  in_out_volaris.nombre_completo.focus(); return false;    
       }
        if(jvi_numero_correcto.test(in_out_volaris.no_reserva.value)) {
       alert('Ha escrito un caracter no valido en el campo Número de Reserva, verifique por favor.');  in_out_volaris.no_reserva.focus(); return false;    
       }
        if(jvi_numero_correcto.test(in_out_volaris.paxxx.value)) {
       alert('Ha escrito un caracter no valido en el campo Pax, verifique por favor.');  in_out_volaris.paxxx.focus();       return false;    
       }
     
        in_out_volaris.B01.disabled = true;
        alert("  Registro Modificado \n   ¡ Exitosamente ! ");
		document.in_out_volaris.submit();	  
	}
   </script>


</body>
</html>
