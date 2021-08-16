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
							
							<form name="in_out_volaris" id="formSale" method="POST" action="/ventas/altavolaris" >
								<div class="row">

				     			 
                                    
                                    <div class=" col-md-12" style="padding:5px;background-color: #d9edf7;margin-bottom: 20px;"> 
									    <div >
                                            <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                                <label><font color="000000" >-- ALTA DE REGISTRO DE TOURS. --</font></label>
                                            </p>
									    </div>
									</div>
                                    
                                    
                                    
				     				<div  class="  col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     				
				     				  <div class="form-group  col-sm-6">
										<label for="nombre_completo"><font color="000000" >Título.  </font></label>
                                           <input placeholder="Título completo del nuevo tour" autofocus id="nombre_completo" name="nombre_completo" class="form-control" type="text" value="" required  >
										</div>
										<div class="col-md-6  form-group">
											<label for="no_reserva"><font color="000000" >Semblanza. </font></label>
											<textarea id="comentarios" name="comentarios" class="form-control"  value=""  size=10 rows=2 cols=35  > </textarea>
										</div>
										
										
									</div>									
                                    
                    <?php
						$today = date("d-m-Y");
						$today1 = date("d-m-Y",strtotime($today."+ 1 day"));
					?>

									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
									
									
									<div class="form-group  col-sm-3">
											<label for="empresa"><font color="000000" >Tipo de tour.</font></label>
											
											<select id="uni_llegada"  name="uni_llegada" class="form-control">
                                                <option value="0" selected>Seleccionar.</option>
                                                <option value="1" >Tour 1</option>
                                                <option value="2"> Tour 2 </option>
                                                <option value="3"> Tour 3 </option>
                                                <option value="4"> Tipo 4 </option>
                                                
                                            </select>
											
											
										</div>
										<div class="form-group  col-sm-3">
											<label for="paxxx"><font color="000000" >Categoría.</font></label>
											<select id="uni_llegada"  name="uni_llegada" class="form-control">
                                                <option value="0" selected>Seleccionar.</option>
                                                <option value="1" >Categoria 1</option>
                                                <option value="2"> Categoria 2 </option>
                                                <option value="3"> Categoria 3 </option>
                                                <option value="4"> Categoria 4 </option>
                                                
                                            </select>
										</div>
									
											
										<div class="form-group  col-sm-2">
											<label for="fecha_llegada"><font color="000000" >Proveedores.</font></label>
											<select id="uni_llegada"  name="uni_llegada" class="form-control">
                                                <option value="0" selected>Seleccionar.</option>
                                                <option value="1" >Proveedor 1</option>
                                                <option value="2"> Proveedor 2 </option>
                                                <option value="3"> Proveedor 3 </option>
                                                <option value="4"> Proveedor 4 </option>
                                                
                                            </select>
										</div>
										<div class="form-group  col-sm-2">
											<label for="servicio_llegada"><font color="000000" >Localidades. </font></label>
											<select id="uni_llegada"  name="uni_llegada" class="form-control">
                                                <option value="0" selected>Seleccionar.</option>
                                                <option value="1" >Localidad 1</option>
                                                <option value="2"> Localidad 2 </option>
                                                <option value="3"> Localidad 3 </option>
                                                <option value="4"> Localidad 4 </option>
                                                
                                            </select>
										</div>
										<div class="form-group  col-sm-2">
											<label for="no_vuelo_llegada" class="label-form"><font color="000000" >Imagen.</font></label>
											<input id="no_vuelo_llegada" name="no_vuelo_llegada" class="form-control" type="text" value="" >
											
										</div>
										
										
                                        
				    </div>


									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                        
										<div class="form-group  col-sm-6">
											<label for="fecha_salida"><font color="000000" >Descripción.</font></label>
											 <textarea id="comentarios" name="comentarios" class="form-control"  value=""  size=10 rows=4 cols=35  > </textarea>
										</div>
										<div class="form-group  col-sm-2">
											<label for="servicio_salida"><font color="000000" >Incluye.</font></label>
											<input id="servicio_salida" name="servicio_salida" class="form-control" type="text" value=""  >
										</div>
										<div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >Inf. Adicional.</font></label>
											<input id="no_vuelo_salida" name="no_vuelo_salida" class="form-control" type="text" value="" >
											
										</div>
										<div class="form-group  col-sm-2">
											<label for="hora_vuelo_salida"><font color="000000" >Precio Pesos.</font></label>   
                                            <input placeholder="" id="hora_vuelo_salida" name="hora_vuelo_salida" class="form-control" type="text" value="">
										</div>
										
										
                                        
									</div>
									
									
									
									
									
									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                        
										<div class="form-group  col-sm-6">
											<label for="fecha_salida"><font color="000000" >Description.</font></label>
											<textarea id="comentarios" name="comentarios" class="form-control"  value=""  size=10 rows=4 cols=35  > </textarea>
										</div>
										<div class="form-group  col-sm-2">
											<label for="servicio_salida"><font color="000000" >Includes.</font></label>
											<input id="servicio_salida" name="servicio_salida" class="form-control" type="text" value=""  >
										</div>
										<div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >Additional info.</font></label>
											<input id="no_vuelo_salida" name="no_vuelo_salida" class="form-control" type="text" value="" >
											
										</div>
										<div class="form-group  col-sm-2">
											<label for="hora_vuelo_salida"><font color="000000" >Precio dollars.</font></label>   
                                            <input placeholder="" id="hora_vuelo_salida" name="hora_vuelo_salida" class="form-control" type="text" value="">
										</div>
										
										
                                        
									</div> 
									
									
									
						
										
                                <div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
                                        <div class="form-group  col-sm-8">
											<label for="comentarios" class="label-form"><font color="000000" >Comentarios.</font></label>
                                            
                                <textarea id="comentarios" name="comentarios" class="form-control"  value=""  size=10 rows=3 cols=35  > </textarea>
										
								       </div>
                                    
                                            <div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											<input type="button" class="btn btn-primary" value=" :: G U A R D A R :: " name="B01" onClick="ValidaCampos()" >
								        </div>
                                            
                                       
                                            <div class="form-group  col-sm-2">
											<label for="no_vuelo_salida" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											 <input type="reset" class="btn btn-primary"  value=" :: R E S E T :: ">
											</div>
                                    
                                    </div>
									    
									
                                
                                   </div>

								</div> <!-- class="row" -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- footer content -->
		<footer>
			<div class="pull-right">  	</div>
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
				defaultDate: "null",
				changeMonth: true,
				numberOfMonths: 1
			})
			.on( "change", function() {
				to.datepicker( "option", "minDate", getDate( this ) );
			}),
			to = $( "#fecha_salida" ).datepicker({
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
        
        
            
        
	</script>
    
    <script> 
	function ValidaCampos()  {
        
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
        

        
        alert(" Registro Grabado \n  ¡ Exitosamente ! ");
        in_out_volaris.B01.disabled = true; 
		document.in_out_volaris.submit();	  
	                                              
    }
        
        
        
          
        
        
   </script>


</body>
</html>
