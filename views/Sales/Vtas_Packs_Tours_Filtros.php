

 <?php  $today = date("Y-m-d");
        $initDate = date("Y-m-d",strtotime($today."- 8 month"));
 ?> 
  
<form  action="/ventas/gridvolaris" name="FormFiltrosTours" method="POST" >
<table align="center" class="table-hover" >   
<tbody>		
 <TR>
  <TD></TD>
  <TD><br> Etiqueta del Paquete</TD>
  <TD><br> Descripción del Paquete</TD>
  <TD><br> Paquete Activo </TD>
  <TD><br>   
	  
  <select name="Id_xtours" class="FieldTDBlue">
	  <option value=0 selected>-- Seleccione tour para formar paquete --</option>
	  <?php
	 foreach ($combo_xtours as $i_xtours) { ?>
	 <option value=<?php  print	$i_xtours->getId_xtours();?>><?php echo $i_xtours->gettitulo().' '.$i_xtours->getsemblanza();?></option>  
	 <?php  } ?>
  </select>  
  
  </TD>
  
  <TD><br><input disabled="disabled"  type="button" class="btn btn-dark" value="Agregar Tour :)" name="B11" onClick="ValidaCampos()"></TD>
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
