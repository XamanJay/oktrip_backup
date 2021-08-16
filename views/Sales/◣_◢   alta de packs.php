<!DOCTYPE html>
<html lang="en">

<head>
    
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Alta de (((Tours))) oktrip! </title>
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
							
							<form name="nuevos___packs" id="formSale" method="POST" action="/ventas/altapacksss" >
								<div class="row">

				     			 
                                    
                                    <div class=" col-md-12" style="padding:5px;background-color: #d9edf7;margin-bottom: 20px;"> 
									    <div >
                                            <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                                <label><font color="000000" > ::::: ALTA DE PAQUETES ::::: </font></label>
                                            </p>
									    </div>
									</div>
                                    
                                    
                                    
				     			<div  class="col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
				     			   <div class="form-group  col-sm-5">
										<label for="xpaquetes"><font color="000000" >Título del Paquete. </font></label>
                                           <input placeholder="Título completo del nuevo paquete" autofocus id="xpaquetes" name="xpaquetes" class="form-control" type="text" value="" required  >
								   </div>
								   <div class="col-md-6  form-group">
											<label for="descripcion"><font color="000000" >Descripción. </font></label>
											<textarea id="descripcion" name="descripcion" class="form-control"  value=""  size=10 rows=2 cols=35  > </textarea>
								   </div>
								    
									<div class="form-group  col-sm-1">
									      	<label for="activo" class="label-form"><font color="000000" >Activo.</font></label>
    									       <input type="checkbox"  name="activo" class="form-control" value="1" checked> 
									</div>
									
									
								</div>
								
								
								
									
                                <div class=" col-md-12" style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;"> 
                                            <div class="form-group  col-sm-6" align="center">
											<label for="guardar" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											<input type="button" class="btn btn-primary" value=" ::::: G U A R D A R ::::: " name="B01" onClick="ValidaCampos()" >
								        </div>
                                                                           
                                            <div class="form-group  col-sm-6" align="center">
											<label for="reset" class="label-form"><font color="000000" >&nbsp;</font></label><br>
											 <input type="reset" class="btn btn-primary"  value=" ::::: R E S E T ::::: ">
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
	//	$(document).ready(function(){
//
//			$("#myInput").on("keyup", function() {
//			    var value = $(this).val().toLowerCase();
//			    $("#myTable tr").filter(function() {
//			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//			    });
//			});
//
//			var dateFormat = "mm/dd/yy",
//			from = $( "#fecha_llegada" ).datepicker({
//				defaultDate: "null",
//				changeMonth: true,
//				numberOfMonths: 1
//			})
//			.on( "change", function() {
//				to.datepicker( "option", "minDate", getDate( this ) );
//			}),
//			to = $( "#fecha_salida" ).datepicker({
//				defaultDate: "null",
//				changeMonth: true,
//				numberOfMonths: 1
//			})
//			.on( "change", function() {
//				from.datepicker( "option", "maxDate", getDate( this ) );
//			});
//
//			function getDate( element ) {
//				var date;
//				try {
//					date = $.datepicker.parseDate( dateFormat, element.value );
//				} catch( error ) {
//					date = null;
//				}
//				return date;
//			}
//		});
//        
        
            
        
	</script>
    
    <script> 
	function ValidaCampos()  {
        
        var jvi_texto_correcto = /[\d\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
		var jvi_numero_correcto = /[\D\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
		var jvi_textoynumero_correcto = /[\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
       
      if (nuevos___packs.xpaquetes.value  == "")   {
              alert("El campo: Titulo del Paquete, no debe estar vacío, favor de verificar ");    nuevos___packs.xpaquetes.focus(); return false;
        }  
//       if (nuevos___packs.no_reserva.value  == "")   {
//              alert("El campo: Número de Reserva, no debe estar vacío, favor de verificar ");    nuevos___packs.no_reserva.focus(); return false;
//        }  
//        if (nuevos___packs.empresa.value  == "")   {
//              alert("El campo: Empresa, no debe estar vacío, favor de verificar ");    nuevos___packs.empresa.focus(); return false;
//        }  
//        if (nuevos___packs.paxxx.value  == "")   {
//              alert("El campo: PAX, no debe estar vacío, favor de verificar ");    nuevos___packs.paxxx.focus(); return false;
//        }  
//         if (nuevos___packs.fecha_llegada.value  == "")   {
//              alert("El campo: Fecha llegada, no debe estar vacío, favor de verificar ");    nuevos___packs.fecha_llegada.focus(); return false;
//        }  
//        if(jvi_texto_correcto.test(nuevos___packs.nombre_completo.value)) {
//       alert('Ha escrito un caracter no valido en el campo Nombre, verifique por favor.');  nuevos___packs.nombre_completo.focus(); return false;    
//       }
//        if(jvi_numero_correcto.test(nuevos___packs.no_reserva.value)) {
//       alert('Ha escrito un caracter no valido en el campo Número de Reserva, verifique por favor.');  nuevos___packs.no_reserva.focus(); return false;    
//       }
//        if(jvi_numero_correcto.test(nuevos___packs.paxxx.value)) {
//       alert('Ha escrito un caracter no valido en el campo Pax, verifique por favor.');  nuevos___packs.paxxx.focus();       return false;    
//       }
        

         
        alert(" Registro de Nuevo Paquete Grabado \n  ¡ Exitosamente :)  ! ");
        nuevos___packs.B01.disabled = true; 
		document.nuevos___packs.submit();	  
	                                              
    }
        
        
        
          
        
        
   </script>


</body>
</html>
