<table align="center" >   
	         <tr>
                <td rowspan="4"> <a href="javascript:imprimir()">  <img   src="../../img/Reportes_Vtas/oktrip.png" wight="80" height="60" >  </a>    </td>
                </tr>
	         <tr>
                <td>OK TRAVEL SA DE CV</td>  
                <td></td>
                <td></td>
                </tr>
        <tr>
                <td>OPERACIÓN DE SERVICIO DE LLEGADAS. TRIPULACIÓN VOLARIS.</td>
                <td></td>
                <td class="" > RFC: OKT130624DUA</td>
                </tr>
        <tr> 
                <td>APTO-ADHARA.&nbsp;&nbsp; <strong><u> <font  size="+1">LLEGADAS DEL: &nbsp;  
                    <?php
                       date_default_timezone_set("America/Cancun");  
                       // $today = date("Y-m-d");
						//$Fecha_1 = date("Y-m-d",strtotime($today."+ 1 days "));
                        $Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
                        $d1 = substr($Fecha_1,8,2);   $m1 = substr($Fecha_1,5,2);  $a1 = substr($Fecha_1,0,4);
                        $Fecha_1 = $d1." / ".$m1." / ".$a1; 
                        echo   $Fecha_1; 
                    ?> </font></u></strong>
                      &nbsp;&nbsp;&nbsp; <font size="+1">
                    <?php
                       	//$Fecha_2 = date("Y-m-d",strtotime($today."+ 2 days "));
//                        $d2 = substr($Fecha_2,8,2);   $m2 = substr($Fecha_2,5,2);  $a2 = substr($Fecha_2,0,4);
//                        $Fecha_2 = $d2." / ".$m2." / ".$a2; 
//                        echo   $Fecha_2; 
                    ?>
                    </font>  </td>
                <td></td>
                <td>PERMISO SCT:22440KT250520150419010000</td>
                </tr>
            </table>
											

<script > 

       function imprimir() {
  if (window.print)
    window.print()
  else
    alert("Disculpe, su navegador no soporta esta opción.");
}
  
    
</script>
