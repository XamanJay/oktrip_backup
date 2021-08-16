<?php
						$today = date("Y-m-d");
						$initDate = date("Y-m-d",strtotime($today."- 8 month"));
					?>

<table align="center" class="table-hover">
    <form action="/ventas/gridvolaris" name="FormFiltrosVolaris" method="POST">
        <tbody>
            <tr>
                <td>     <a href="/ventas/mesesweb">     <img class="MOVIMIENTO_DESCENDIENDO" src="../../img/Reportes_Vtas/oktrip.png" wight="70" height="50"></a>&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td><br> <a href="/ventas/enero21">      <button type="button" class="btn btn-dark">Enero</button> </a></td>
                <td><br> <a href="/ventas/febrero21">    <button type="button" class="btn btn-dark">Febrero</button> </a></td>
                <td><br> <a href="/ventas/marzo21">      <button type="button" class="btn btn-dark">Marzo</button> </a></td>
                <td><br> <a href="/ventas/abril21">      <button type="button" class="btn btn-dark">Abril</button> </a></td>
                <td><br> <a href="/ventas/mayo21">       <button type="button" class="btn btn-dark">Mayo</button> </a></td>
                <td><br> <a href="/ventas/junio21">      <button type="button" class="btn btn-dark">Junio</button> </a></td>
                <td><br> <a href="/ventas/julio21">      <button type="button" class="btn btn-dark">Julio</button> </a></td>
                <td><br> <a href="/ventas/agosto21">     <button type="button" class="btn btn-dark">Agosto</button> </a></td>
                <td><br> <a href="/ventas/septiembre21"> <button type="button" class="btn btn-dark">Septiembre</button></a></td>
                <td><br> <a href="/ventas/octubre21">    <button type="button" class="btn btn-dark">Octubre</button> </a></td>
                <td><br> <a href="/ventas/noviembre21">  <button type="button" class="btn btn-dark">Noviembre</button></a></td>
                <td><br> <a href="/ventas/diciembre21">  <button type="button" class="btn btn-dark">Diciembre</button></a></td> 
                <td><br> <a href="/ventas/diciembre20">  <button type="button" class="btn btn-dark">Dic-2020</button></a></td>
            </tr>
        </tbody>
    </form>
</table>

<script Language="JavaScript">
function ValidaCampos()
{
    if (FormFiltrosVolaris.Fecha_1.value == "") {
        alert("El campo: Fecha Inicial, no debe estar vacío, favor de verificar ");
        FormFiltrosVolaris.Fecha_1.focus();
        return false;
    }
    if (FormFiltrosVolaris.Fecha_2.value == "") {
        alert("El campo: Fecha Final, no debe estar vacío, favor de verificar ");
        FormFiltrosVolaris.Fecha_2.focus();
        return false;
    }
    document.FormFiltrosVolaris.submit();
}
</script>