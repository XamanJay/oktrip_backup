<table align="center" class="table-hover" >   
		
	
		<tbody>		
            <TR>
            <form  action="/ventas/gridvolaris" name="FormFiltrosVolaris" method="POST" >
                <TD><img  class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50">&nbsp;&nbsp;&nbsp;&nbsp;
              </TD>
                
                <TD>
              </TD>
                
                <TD><?php  $today = date("Y-m-d");
						     $initDate = date("Y-m-d",strtotime($today."- 8 month"));
                          // $initDate = date("Y-m-d");
					?>
                    
					
				</TD>
                
                <TD><strong><b>Rango de Fechas  Inicial y Final :</b></strong><br>
                    <input class="FieldTDBlue" type="text" id="from" autocomplete="off" name="Fecha_1" size="8" value="<?php echo (isset($_POST['Fecha_1'])) ? $_POST['Fecha_1'] : $initDate;  ?>">
                    <input class="FieldTDBlue" type="text" id="to" autocomplete="off" name="Fecha_2" size="8" value="<?php echo (isset($_POST['Fecha_2'])) ? $_POST['Fecha_2'] : $today;  ?>">
                          <input type="button" class="btn btn-dark" value="Filtrar" name="B11" onClick="ValidaCampos()" >
                                <input type="reset" class="btn btn-dark" value="Reset" name="B2" >
                    
    		  </TD>
                
                 <TD><br>
              </TD>
              </form>
                
                <TD>
                
        <form target="_blank"  action="/ventas/imprimirtrip" name="FormImprimir" method="POST">
        <?php
				       $today = date("Y-m-d");
				       $initDate = date("Y-m-d",strtotime($today."- 8 month"));
                        $Fecha_I = date("Y-m-d",strtotime($today."+ 1 days "));
                        $Fecha_II = date("Y-m-d",strtotime($today."+ 1 days "));
                       // $initDate = date("Y-m-d");
					?>
        <input type="hidden"  name="Fecha_1" value="<?php echo  $Fecha_I; ?>">
        <input type="hidden"  name="Fecha_2" value="<?php echo $Fecha_II; ?>">
           <b>Fecha llegadas :</b><br>
            <input class="FieldTDBlue"  type="text" id="datepicker" name="Fecha_3" size="8">
             <input type="button" class="btn btn-dark" value="Imp. Llegadas" name="D11" onClick="ValidarImprimir()" >
            </form>
                    </TD>
                <TD>
                   
                    </TD>
                
               
                
            </TR>
         </tbody>
    
</table>   
            
    <table align="center" class="table-hover" >   
		
	
		<tbody>	        
        <TR>
            <TD><br> <a href="/ventas/altavolaris"><button type="button" class="btn btn-dark">N u e v o </button></a>
                    </TD>
                <TD> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </TD>
                    
                <TD> 
                    <form target="_blank"  action="/ventas/imprimirtripout" name="Formprintout" method="POST"> 
                            <?php    $todayout     = date("Y-m-d");
                                           $Fecha_Iout  = date("Y-m-d",strtotime($todayout."+ 2 days "));
                                           $Fecha_IIout = date("Y-m-d",strtotime($todayout."+ 2 days "));
                            ?>
                            <input type="hidden"  name="Fecha_1out" value="<?php echo  $Fecha_Iout;?>">
                            <input type="hidden"  name="Fecha_2out" value="<?php echo $Fecha_IIout;?>">

                                <b>Fecha Salidas :</b><br>
                                <input class="FieldTDBlue"  type="text" id="datepicker_s" size="8" name="Fecha_3out" >
                                <input type="button" class="btn btn-dark"  value="Imp. Salidas" name="D12" onClick="ValidarImprimirout()" > 
                            </form>
                    </TD>
            
            
                <TD>
                     <form target="_blank"  action="/ventas/imprimiroperador" name="FormImpOperador" method="POST">
          
                          <b>Fecha Operadores :</b><br>
                        <input class="FieldTDBlue"  type="text" id="datepicker_o" size="8" name="Fecha_3">
                          
                          <select class="FieldTDBlue"  id="operador" name="operador" >
                                                <option value="90" selected>OPERADORES.</option>
                                                <option value="JOAZ">JOAZ</option>
                                                <option value="RICARDO"> RICARDO </option>
                                                <option value="SANTOS"> SANTOS </option>
												<option value="ELVIN"> ELVIN </option>
                                                <option value="APOYO"> APOYO </option>
                                                <option value="SANTOS/RICARDO"> SANTOS/RICARDO </option>
                     </select>
                         
                         
                          <?php
				       $today = date("Y-m-d");
				       $initDate = date("Y-m-d",strtotime($today."- 8 month"));
                        $Fecha_I = date("Y-m-d",strtotime($today."+ 1 days "));
                        $Fecha_II = date("Y-m-d",strtotime($today."+ 1 days "));
                       // $initDate = date("Y-m-d");
					?>
                        <input type="hidden"  name="Fecha_1" value="<?php echo  $Fecha_I; ?>">
                        <input type="hidden"  name="Fecha_2" value="<?php echo $Fecha_II; ?>">
                     <input type="button" class="btn btn-dark" value="Imp. Operador" name="D11" onClick="ValidarImprimiroperador()" > 
                     </form>
                    </TD>
                    
                <TD>
                     
                    </TD>
                <TD>
                   
                    </TD>
                <TD>
                    
                    </TD>
                
            </TR>
            
    
    
    
    </tbody>
    
</table>
											

<script Language="JavaScript"> 
    
	function ValidaCampos()
	{
     if (FormFiltrosVolaris.Fecha_1.value  == "")   {
              alert("El campo: Fecha Inicial, no debe estar vacío, favor de verificar ");    FormFiltrosVolaris.Fecha_1.focus(); return false;
        }     
    if (FormFiltrosVolaris.Fecha_2.value  == "")   {
              alert("El campo: Fecha Final, no debe estar vacío, favor de verificar ");    FormFiltrosVolaris.Fecha_2.focus(); return false;
        }
        
		document.FormFiltrosVolaris.submit();	  
	}
    
    
    function ValidarImprimir()
	{
     if (FormFiltrosVolaris.Fecha_1.value  == "")   {
              alert("El campo: Fecha Inicial, no debe estar vacío, favor de verificar ");    FormFiltrosVolaris.Fecha_1.focus(); return false;
        }     
    if (FormFiltrosVolaris.Fecha_2.value  == "")   {
              alert("El campo: Fecha Final, no debe estar vacío, favor de verificar ");    FormFiltrosVolaris.Fecha_2.focus(); return false;
        }
        
		document.FormImprimir.submit();	  
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
