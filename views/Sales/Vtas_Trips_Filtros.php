<table align="center" class="table-hover" >  
		
	<form  action="/ventas/trips" name="FormAltass" method="POST" >
		<thead>
			<tr class="table-primary">
                <td></td>
				<td align="center" colspan="10"> <!--<b> VENTAS DE TRASLADOS </b>--> </td>
				<td>&nbsp;  </td> 
			</tr>
		</thead>
		<tbody>											
			<tr>
                <td><img class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50">&nbsp;&nbsp;&nbsp;&nbsp;
                
                </td>
               	<td>&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
				<td> 
					<b>T r a n s p o r t a c i ó n :</b><br>
                    
                    <select  autofocus name="Id_productos">
                    <optgroup label=":: G E N E R A L ::">
                       <option value="999" selected>  T O D O S </option>
                    </optgroup>
                      <optgroup label=" TRANSPORTACIÓN OKTRIP ! ">
                        <option value="233" >Transportación Gratis/adhara.com</option>
                        <option value="232">Transportación 7USD</option>
                        <option value="235">Transportación Privada</option>
                        <option value="270">Transportación Volaris Tripulación</option>
                      </optgroup>
                      <optgroup label=" TRANSPORTACIÓN EXTERNA ">
                        
                        <option value="206">TRANSPORTACIÓN HOTELDO</option>
                        <option value="208">TRANSPORTACIÓN HOTELBEDS</option>
                        <option value="209">TRANSPORTACIÓN CEGAPER</option>
                        <option value="271">TRASNPORTACIÓN MAYA TOURS</option>
                        
                      </optgroup>
                         
                    </select>
                    
				</td>
                
                
				
                
				<td>
					&nbsp;&nbsp;
				</td>
				<td>
				
					<?php
						$today = date("Y-m-d");
						$initDate = date("Y-m-d",strtotime($today."- 8 month"));
					?>
                    <b>Fecha Inicial :</b><br>
					<input type="text" id="from" autocomplete="off" name="Fecha_1" value="<?php echo (isset($_POST['Fecha_1'])) ? $_POST['Fecha_1'] : $initDate;  ?>">

				</td>
				<td>
					&nbsp;&nbsp;
				</td>
				<td>
                     <b>Fecha Final :</b><br>
					<input type="text" id="to" autocomplete="off" name="Fecha_2" value="<?php echo (isset($_POST['Fecha_2'])) ? $_POST['Fecha_2'] : $today;  ?>">
 	    		</td>
                
                <td>
					&nbsp;&nbsp;
				</td>
				<td>
                     <b>Excel :</b><br>
                    <INPUT TYPE="checkbox"  NAME="exxxcel" value="100"> &nbsp; <img src="../../img/Reportes_Vtas/logo_mini_excel.PNG " height="25">&nbsp;&nbsp;&nbsp;
                </td>
                
                <td align="center"><br><input type="button" class="btn btn-dark" value="F i l t r a r" name="B11" onClick="ValidaCampos()" ></td>
			   <td>&nbsp;&nbsp;
                </td>
                <td><br><input type="reset" class="btn btn-dark" value="Reiniciar" name="B2" ></td>
            </tr>
			
		</tbody>
	</form>
</table>
											

<script Language="JavaScript"> 
	function ValidaCampos()
	{
		document.FormAltass.submit();	  
	}
</script>
