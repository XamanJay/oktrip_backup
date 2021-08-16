<?php 
						$today = date("Y-m-d");
						
					?>

<table align="center" class="table-hover" >   

<form  action="/ventas/gridvolaris" name="FormGraficas" method="POST" >
<tbody>											
<tr>
<td><a  href="" ><img  class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50"></a>&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td><br> <a href="/ventas/echarts"><button type="button" class="btn btn-dark"><i  class="fa fa-line-chart"></i>&nbsp;Vtas. Web/Offline. </button></a></td>
<td><br> <a href="/ventas/echartsoff"><button type="button" class="btn btn-dark"><i  class="fa fa-line-chart"></i>&nbsp;Vtas. --Offline--</button></a></td>
<td><br> <a href="/ventas/echartsweb"><button type="button" class="btn btn-dark"><i  class="fa fa-line-chart"></i>&nbsp;Vtas. --Web-- </button></a></td>
<td><br> <a href="/ventas/echartspax"><button type="button" class="btn btn-dark"><i  class="fa fa-line-chart"></i>&nbsp;Pax.</button></a></td>

</tr>
</tbody>
</form>
</table>
											

<script Language="JavaScript"> 
	function ValidaCampos()
	{
      
    
        
		document.FormGraficas.submit();	  
	}
</script>
