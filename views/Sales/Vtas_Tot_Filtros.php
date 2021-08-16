<table align="center" > 
		
	<form  action="/ventas/reporte" name= "FormAltas" method="post" >
		<thead>
			<tr class="table-primary">
				<td align="center" colspan="10">
					<!--<b> REPORTE TOTAL DE VENTAS </b>-->
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</thead>
		<tbody>											
			<tr>
                <td><img class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50">&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
               	<td>&nbsp;&nbsp;
                </td>
                <td> 
                    <b>Ventas:</b><br>
					<select name="Id_type_vending" autofocus >
						<option value=".9" selected>-- T O D O S --</option>
						<?php
						foreach ($lista_vending as $vending) {
							echo "<option value='".$vending->getId()."'>".$vending->getNombre()."</option>";
						}
						
						?>                                          
					</select>
				</td>
                <td>
					&nbsp;&nbsp;
				</td>
				
				<td> 
                    <b>Status:</b><br>
					<select name="Id_Status">
						<option value=".9" selected>-- T O D O S --</option>
						<?php  
							foreach ($lista_estatus as $estatus) {
								echo "<option value='".$estatus->getId()."'>".$estatus->getNombre()."</option>";
							}
						?>
					</select>
				</td>
				<td>
					&nbsp;&nbsp;&nbsp;
				</td>
				<td>
				
					<?php
						$today = date("Y-m-d");
						$initDate = date("Y-m-d",strtotime($today."- 8 month"));
					?>
                    <b>Fecha Inicial:</b><br>
					<input type="text" id="from" autocomplete="off" name="Fecha_1" value="<?php echo (isset($_POST['Fecha_1'])) ? $_POST['Fecha_1'] : $initDate;  ?>">

				</td>
				<td>
					&nbsp;&nbsp;&nbsp;
				</td>
				<td>
                    <b>Fecha Final:</b><br>
					<input type="text" id="to" autocomplete="off" name="Fecha_2" value="<?php echo (isset($_POST['Fecha_2'])) ? $_POST['Fecha_2'] : $today;  ?>">
 	    		</td>
                <td>
					&nbsp;&nbsp;&nbsp;
				</td>
				<td>
                     <b>Excel :</b><br>
                    <INPUT TYPE="checkbox"  NAME="exxxcel" value="100"> &nbsp; <img src="../../img/Reportes_Vtas/logo_mini_excel.PNG " height="25">&nbsp;&nbsp;&nbsp;
                </td>
                    <td>
					&nbsp;&nbsp;&nbsp;
				</td>
                <td> 
					<input type="button" class="btn btn-dark" value="Filtrar" name="B11" onClick="ValidaCampos()" >
                </td>
                <td>
					<input type="reset" class="btn btn-dark" value="Reset" name="B2" >
				</td>
				<td>
					<a  href="/ventas/crear"><button type="button" class="btn btn-dark"><i  class="fa fa-laptop"></i> Nuevo</button> </a>
				</td>
			</tr>
            
			
		</tbody>
	</form>
</table>
											

<script Language="JavaScript"> 
	function ValidaCampos()
	{
		document.FormAltas.submit();	  
	}
</script>
