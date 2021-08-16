

 <?php  $today = date("Y-m-d");
        $initDate = date("Y-m-d",strtotime($today."- 8 month"));
 ?> 
  
<form  action="/ventas/gridvolaris" name="FormFiltrosTours" method="POST" >
<table align="center" class="table-hover" >   
<tbody>		
 <TR>
  <TD><img  class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50">&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  <TD><br><a href="/ventas/altatoursss"><button type="button" class="btn btn-dark">Nuevo Tour</button></a></TD>
  <TD>
  <strong><b>Titulo Tour:</b></strong><br>
  <input class="FieldTDBlue" type="text" id="from" autocomplete="off" name="Titulo" size="30" value="">
  </TD>
  <TD><strong><b>Localidad</b></strong><br>
	  
	  
  <select name="Id_xlocalidades" class="FieldTDBlue">
	  <option value=0 selected>-- Seleccione Localidad --</option>
	  <?php
	 foreach ($combo_xlocalidades as $i_xlocalidades) { ?>
	 <option value=<?php  print	$i_xlocalidades->getId_xlocalidades();?>><?php echo $i_xlocalidades->getxlocalidades();?></option>  
	 <?php  } ?>
  </select>
									   
									   
									   

  </TD>
  <TD><br><input type="button" class="btn btn-dark" value="Filtrar" name="B11" onClick="ValidaCampos()"></TD>
  <TD><br><input type="reset" class="btn btn-dark" value="Reset" name="B2"></TD>
 </TR>
 </tbody>
</form>    




											

<script Language="JavaScript"> 
    
	function ValidaCampos()
	{
	 if (FormFiltrosTours.Fecha_1.value  == "")   {
		  alert("El campo: Fecha Inicial, no debe estar vacío, favor de verificar "); FormFiltrosTours.Fecha_1.focus(); return false;
		}     
	if (FormFiltrosTours.Fecha_2.value  == "")   {
		  alert("El campo: Fecha Final, no debe estar vacío, favor de verificar "); FormFiltrosTours.Fecha_2.focus(); return false;
		}

		document.FormFiltrosTours.submit();	  
	}
    
    
    
    
    
    
    function ValidarImprimirout()
    {
        document.Formprintout.submit();
    }
    
    
     function ValidarImprimiroperador()
    {
        
        if (FormImpOperador.operador.value  == 90)   {
              alert("Debe seleccionar un operador valido, favor de verificar ");    FormImpOperador.operador.focus(); return false;
        } 
        
        
        
        document. FormImpOperador.submit();
    }
    
    
    
    
    
    
</script>
