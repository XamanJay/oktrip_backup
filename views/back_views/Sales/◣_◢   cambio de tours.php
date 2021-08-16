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
							
							<form name="edicion___tours" id="formSale" method="POST" action="/ventas/cambiotoursss" >
								<div class="row">
                                    
 <?php                               
    $Id_xtours = $row['Id_xtours'];
	$titulo = $row['titulo'];
	$semblanza = $row['semblanza'];
	$descripcion = $row['descripcion'];
	$itinerario = $row['itinerario'];
	$incluye = $row['incluye'];
	$no_incluye = $row['no_incluye'];
	$precio_adulto_pesos = $row['precio_adulto_pesos'];
	$precio_infante_pesos = $row['precio_infante_pesos'];
	$sugerencias = $row['sugerencias'];
	$informacion_adicional = $row['informacion_adicional'];
	$transportacion = $row['transportacion'];

	$activo = $row['activo'];
	$paqueteable = $row['paqueteable'];
	
	$observaciones = $row['observaciones'];
	$Id_xtipotours = $row['Id_xtipotours'];
	$Id_xcategorias = $row['Id_xcategorias'];
	$Id_xproveedores = $row['Id_xproveedores'];
	$Id_xlocalidades = $row['Id_xlocalidades'];
	$path_imagen = $row['path_imagen'];
	$title = $row['title'];
	$semblance = $row['semblance'];
	$description = $row['description'];
	$itinerary = $row['itinerary'];
	$includes = $row['includes'];
	$without_include = $row['without_include'];
	$adult_price_dollars = $row['adult_price_dollars'];
	$infants_price_dollars = $row['infants_price_dollars'];
	$suggestions = $row['suggestions'];
	$additional_info = $row['additional_info'];
	$trasnportation = $row['trasnportation'];
	$observations = $row['observations'];
	$xtipotours = $row['xtipotours'];
	$xcategorias = $row['xcategorias'];
	$xproveedores = $row['xproveedores'];
	$xlocalidades = $row['xlocalidades'];
	
       // especial mes dia año   
                                   // echo $fecha_salida;

//if ($fecha_salida == '0000-00-00'  )
//                 { $m_d_a_fecha_salida = '' ;  } 
//    else {
//        $Objeto_DateFrom = date_create_from_format('Y-m-d', $fecha_salida); 
//        $m_d_a_fecha_salida = date_format($Objeto_DateFrom, "m/d/Y"); 
//    } 
                                  
                    
   
     ?>                                   
                                        
                                                    
                                  

				     			 
                                    <div class=" col-md-12" style="padding:5px;background-color: #d9edf7;margin-bottom: 20px;"> 
									    <div >
                                            <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                                <label><font color="000000" > ::::: EDICIÓN DE TOURS ::::: </font></label>
                                            </p>
									    </div>
									</div>
                                    
                                    
                                    	<div  class="col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     			   <div class="form-group  col-sm-6">
										<label for="titulo"><font color="000000" >Nombre/Título del Tour.  </font></label>
										   <input type="hidden" name="Id_xtours" value="<?php echo $Id_xtours; ?>">
                                           <input placeholder="Título completo del nuevo tour" autofocus id="titulo" name="titulo" class="form-control" type="text" value="<?php  echo $titulo; ?>"  required  >
								   </div>
								   <div class="col-md-6  form-group">
											<label for="semblanza"><font color="000000" >Semblanza. </font></label>
											<textarea id="semblanza" name="semblanza" class="form-control"  value=""  size=10 rows=2 cols=35  ><?php  echo $semblanza; ?> </textarea>
								   </div>
								</div>
								
								
								
								<div  class="col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     			   <div class="form-group  col-sm-6">
										<label for="descripcion"><font color="000000" >Descripción.  </font></label>
                                          <textarea id="descripcion" name="descripcion" class="form-control"  value=""  size=10 rows=4 cols=35  ><?php  echo $descripcion; ?> </textarea>
								   </div>
								   <div class="col-md-6  form-group">
											<label for="itinerario"><font color="000000" >Itinerario. </font></label>
											<textarea id="itinerario" name="itinerario" class="form-control"  value=""  size=10 rows=4 cols=35  ><?php  echo $itinerario; ?> </textarea>
								   </div>
								</div>
									
									
								<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                		<div class="form-group  col-sm-4">
											<label for="incluye"><font color="000000" >Incluye.</font></label>
										<textarea id="incluye" name="incluye" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $incluye; ?> </textarea>
										</div>
										<div class="form-group  col-sm-4">
											<label for="no_incluye" class="label-form"><font color="000000" >No Incluye.</font></label>
										<textarea id="no_incluye" name="no_incluye" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $no_incluye; ?> </textarea>
										</div>
										<div class="form-group  col-sm-2">
											<label for="precio_adulto_pesos"><font color="000000" >Precio Adulto.</font></label>   
                                            <input placeholder="Moneda Nacional" id="precio_adulto_pesos" name="precio_adulto_pesos" class="form-control" type="text" value="<?php  echo $precio_adulto_pesos; ?>">
										</div>
										<div class="form-group  col-sm-2">
											<label for="precio_infante_pesos"><font color="000000" >Precio Infante.</font></label>   
                                            <input placeholder="Moneda Nacional" id="precio_infante_pesos" name="precio_infante_pesos" class="form-control" type="text" value="<?php  echo $precio_infante_pesos; ?>">
										</div>
								</div>
								
								
								
								
								<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                		<div class="form-group  col-sm-4">
											<label for="sugerencias"><font color="000000" >Sugerencias.</font></label>
										<textarea id="sugerencias" name="sugerencias" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $sugerencias; ?> </textarea>
										</div>
										<div class="form-group  col-sm-4">
											<label for="informacion_adicional" class="label-form"><font color="000000" >Información Importante.</font></label>
										<textarea id="informacion_adicional" name="informacion_adicional" class="form-control"  value=""  size=10 rows=3 cols=35  > <?php  echo $informacion_adicional; ?></textarea>
										</div>
										<div class="form-group  col-sm-4">
											<label for="transportacion" class="label-form"><font color="000000" >Información Transportación.</font></label>
										<textarea id="transportacion" name="transportacion" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $transportacion; ?> </textarea>
										</div>
										
								</div>
								
								
									
									
								<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
								
								<div class="form-group  col-sm-1">
									      	<label for="activo" class="label-form"><font color="000000">Activo..</font></label>
											
											
												
										
												
											 <?php 
											    if ($activo == 1) { ?>
												<?php // echo $activo.'<----';?>
												 <input type="checkbox" name="activo" class="form-control" value="1" checked> 
												
												<?php
												}
												else {
												?>
												<?php // echo $activo.'<----';?>
												 <input type="checkbox" name="activo" class="form-control" value="1" > 
											  <?php
												}
											?>
											
											
											
											
											
											
    									       
									</div>
									   
									   <div class="form-group  col-sm-1">
											<label for="paqueteable" class="label-form"><font color="000000" >Paqueteable.</font></label>
											
                                          
										   
										   <?php 
											    if ($paqueteable == 1) { ?>
												
												 <input type="checkbox" name="paqueteable" class="form-control" value="1" checked> 
												
												<?php
												}
												else {
												?>
												 <input type="checkbox" name="paqueteable" class="form-control" value="1" > 
											  <?php
												}
											?>
										   
										   
				    			       </div>
								
                                        <div class="form-group  col-sm-10">
											<label for="observaciones" class="label-form"><font color="000000" >Observaciones.</font></label>
                                           <textarea id="observaciones" name="observaciones" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $observaciones; ?> </textarea>
				    			       </div>
                                </div>
									
									
									
									
																	
                                    
                    <?php
						$today = date("d-m-Y");
						$today1 = date("d-m-Y",strtotime($today."+ 1 day"));
					?>

									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
									
									
									<div class="form-group  col-sm-3">
											<label for="Id_xtipotours"><font color="000000" >Tipo de tour.</font></label>
											<select name="Id_xtipotours" class="form-control">
											  <option value="<?php echo $Id_xtipotours; ?>" selected><?php echo $xtipotours; ?></option>
											  <?php
											 foreach ($combo_xtipotours as $i_xtipotours) { ?>
											 <option value=<?php  print	$i_xtipotours->getId_xtipotours();?>><?php echo $i_xtipotours->getxtipotours();?></option>  
											 <?php  } ?>
										  </select>
											
											
											
										</div>
										<div class="form-group  col-sm-3">
											<label for="Id_xcategorias"><font color="000000" >Categoría.</font></label>
											<select name="Id_xcategorias" class="form-control">
											   <option value="<?php echo $Id_xcategorias; ?>" selected><?php echo $xcategorias; ?></option>
											  <?php
											 foreach ($combo_xcategorias as $i_xcategorias) { ?>
											 <option value=<?php  print	$i_xcategorias->getId_xcategorias();?>><?php echo $i_xcategorias->getxcategorias();?></option>  
											 <?php  } ?>
										  </select>
										</div>
									
											
										<div class="form-group  col-sm-2">
											<label for="Id_xproveedores"><font color="000000" >Proveedores.</font></label>
											<select name="Id_xproveedores" class="form-control">
											  <option value="<?php echo $Id_xproveedores; ?>" selected><?php echo $xproveedores; ?></option>
											  <?php
											 foreach ($combo_xproveedores as $i_xproveedores) { ?>
											 <option value=<?php  print	$i_xproveedores->getId_xproveedores();?>><?php echo $i_xproveedores->getxproveedores();?></option>  
											 <?php  } ?>
										  </select>
										</div>
										<div class="form-group  col-sm-2">
											<label for="Id_xlocalidades"><font color="000000" >Localidades. </font></label>
											<select name="Id_xlocalidades" class="form-control">
											   <option value="<?php echo $Id_xlocalidades; ?>" selected><?php echo $xlocalidades; ?></option>
											  <?php
											 foreach ($combo_xlocalidades as $i_xlocalidades) { ?>
											 <option value=<?php  print	$i_xlocalidades->getId_xlocalidades();?>><?php echo $i_xlocalidades->getxlocalidades();?></option>  
											 <?php  } ?>
										  </select>
										</div>
										<div class="form-group  col-sm-2">
											<label for="path_imagen" class="label-form"><font color="000000" >Imagen.</font></label>
											<input id="path_imagen" name="path_imagen" class="form-control"  type="file" value="" >
											
										</div>
					 </div>


					 <div class=" col-md-12" style="padding:5px;background-color: #d9edf7;margin-bottom: 20px;"> 
								<div >
									<p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
										<label><font color="000000" > ::::: English Version  ::::: </font></label>
									</p>
								</div>
		         	</div>				
									
									
								<div  class="col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     			   <div class="form-group  col-sm-6">
										<label for="title"><font color="000000" >Tour Title.  </font></label>
                                           <input placeholder="Full title of the new tour" autofocus id="title" name="title" class="form-control" type="text" value="<?php  echo $title; ?>" required  >
								   </div>
								   <div class="col-md-6  form-group">
											<label for="semblance"><font color="000000" >Semblance. </font></label>
											<textarea id="semblance" name="semblance" class="form-control"  value=""  size=10 rows=2 cols=35  ><?php  echo $semblance; ?> </textarea>
								   </div>
								</div>
								
								
								
								<div  class="col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     			   <div class="form-group  col-sm-6">
										<label for="description"><font color="000000" >Description.  </font></label>
                                          <textarea id="description" name="description" class="form-control"  value=""  size=10 rows=4 cols=35  ><?php  echo $description; ?> </textarea>
								   </div>
								   <div class="col-md-6  form-group">
											<label for="itinerary"><font color="000000" >Itinerary. </font></label>
											<textarea id="itinerary" name="itinerary" class="form-control"  value=""  size=10 rows=4 cols=35  ><?php  echo $itinerary; ?> </textarea>
								   </div>
								</div>
									
									
								<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                		<div class="form-group  col-sm-4">
											<label for="includes"><font color="000000" >Include.</font></label>
											<textarea id="includes" name="includes" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $includes; ?> </textarea>
										</div>
										<div class="form-group  col-sm-4">
											<label for="without_include" class="label-form"><font color="000000" >No Include.</font></label>
											<textarea id="without_include" name="without_include" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $without_include; ?> </textarea>
										</div>
										<div class="form-group  col-sm-2">
											<label for="adult_price_dollars"><font color="000000" >Adult Price.</font></label>   
                                            <input placeholder="Dollars" id="adult_price_dollars" name="adult_price_dollars" class="form-control" type="text" value="<?php  echo $adult_price_dollars; ?>">
										</div>
										<div class="form-group  col-sm-2">
											<label for="infants_price_dollars"><font color="000000" >Infant Price.</font></label>   
                                            <input placeholder="Dollars" id="infants_price_dollars" name="infants_price_dollars" class="form-control" type="text" value="<?php  echo $infants_price_dollars; ?>">
										</div>
								</div>
									
									
									
									<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
				                		<div class="form-group  col-sm-4">
											<label for="suggestions"><font color="000000" >Suggestions.</font></label>
										<textarea id="suggestions" name="suggestions" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $suggestions; ?> </textarea>
										</div>
										<div class="form-group  col-sm-4">
											<label for="additional_info" class="label-form"><font color="000000" >Important Info.</font></label>
										<textarea id="additional_info" name="additional_info" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $additional_info; ?> </textarea>
										</div>
										<div class="form-group  col-sm-4">
											<label for="trasnportation" class="label-form"><font color="000000" >Transportation Info..</font></label>
										<textarea id="trasnportation" name="trasnportation" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $trasnportation; ?> </textarea>
										</div>
										
								</div>
									
									
								<div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
                                        <div class="form-group  col-sm-12">
											<label for="observations" class="label-form"><font color="000000" >Observations.</font></label>
                                           <textarea id="observations" name="observations" class="form-control"  value=""  size=10 rows=3 cols=35  ><?php  echo $observations; ?> </textarea>
				    			       </div>
                                </div>
										
									
									
									
									
									
									
									
									
						
										
                                <div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
                                            <div class="form-group  col-sm-6" align="center">
											<label for="guardar" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											<input type="button" class="btn btn-primary" value=" ::::: M O D I F I C A R ::::: " name="B01" onClick="ValidaCampos()" >
								        </div>
                                                                           
                                            <div class="form-group  col-sm-6" align="center">
											<label for="reset" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											 <input type="reset" class="btn btn-primary"  value=" ::::: R E S E T ::::: ">
											</div>
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
	function ValidaCampos() {
       
         var jvi_texto_correcto = /[\d\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
		var jvi_numero_correcto = /[\D\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
		var jvi_textoynumero_correcto = /[\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
       
    //   if (in_out_volaris.nombre_completo.value  == "")   {
//              alert("El campo: Nombre, no debe estar vacío, favor de verificar ");    in_out_volaris.nombre_completo.focus(); return false;
//        }  
//       if (in_out_volaris.no_reserva.value  == "")   {
//              alert("El campo: Número de Reserva, no debe estar vacío, favor de verificar ");    in_out_volaris.no_reserva.focus(); return false;
//        }  
//        
		
     
	   
     
        edicion___tours.B01.disabled = true;
        alert("  Registro Modificado \n   ¡ Exitosamente ! ");
		document.edicion___tours.submit();	  
	}
        
        
        
        
           
        
        
        
        
        
   </script>


</body>
</html>
