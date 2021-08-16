

 <?php  $today = date("Y-m-d");
        $initDate = date("Y-m-d",strtotime($today."- 8 month"));
 ?> 
  
<form  action="/ventas/gridvolaris" name="FormFiltrosTours" method="POST" >
<table align="center" class="table-hover" >   
<tbody>		
 <TR>
  <TD><img  class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50">&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  <TD><br><a href="/ventas/altatoursss"><button disabled="disabled" type="button" class="btn btn-dark">Nuevo  P@quete</button></a></TD>
  <TD><br><a href="/ventas/altatoursss"><button disabled="disabled" type="button" class="btn btn-dark">Consultar Paquete</button></a></TD>
  <TD><br><a href="/ventas/altatoursss"><button disabled="disabled" type="button" class="btn btn-dark">Modificar P@quete</button></a></TD>
  <TD><br><a href="/ventas/altatoursss"><button disabled="disabled" type="button" class="btn btn-dark">Elliminar P@quete</button></a></TD>
  
  <TD><br><input disabled="disabled"  type="button" class="btn btn-dark" value="Filtrar" name="B11" onClick="ValidaCampos()"></TD>
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
