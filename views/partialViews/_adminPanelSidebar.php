<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="/home" class="site_title"><img src="/img/iconos/favicon.png" style="width: 30px; height: auto;">
                <span>Panel OkTrip! </span></a>
        </div>
        <div class="clearfix"></div>
        <link href="../../css/animate/Ollin.css" rel="stylesheet">

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <?php //◣_◢-Vtas_Octubre2019.php
          date_default_timezone_set("America/Cancun");  /*echo  date("d/m/Y");*/ $anio = date("y"); $mes = date("m");  //echo $anio.$mes;
          
          switch ($mes){
                  case  "1"; $mes = "enero";      break;  case  "2"; $mes = "febrero";    break;   case  "3"; $mes = "marzo";      break;
                  case  "4"; $mes = "abril";      break;  case  "5"; $mes = "mayo";       break;   case  "6"; $mes = "junio";      break;
                  case  "7"; $mes = "julio";      break;  case  "8"; $mes = "agosto";     break;   case  "9"; $mes = "septiembre"; break;
                  case "10"; $mes = "octubre";    break;  case "11"; $mes = "noviembre";  break;   case "12"; $mes = "diciembre";  break;
                      }
          $liga = $mes.$anio ; ?>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><i class="fa fa-dollar"></i><strong> V E N T A S </strong></font><br><br>
                <div class="btn-group">
                    <a href="/ventas"> <button class="reservasweb"> <i class="fa fa-globe"></i>&nbsp;&nbsp;<strong>RESERVAS WEB </strong> </button></a>
                    <a href="/ventas/reservas"> <button class="reservasoff"> <i class="fa fa-building"></i>&nbsp;&nbsp;<strong>RESERVAS OFF </strong> </button></a>
                    <a href="/ventas/<?php echo  $liga;  ?>"> <button class="mensuales"> <i class="fa fa-calendar"></i>&nbsp;&nbsp;<strong>M E N S U A L E S</strong></button></a>
                    <a href="/ventas/consolidado"> <button class="consolidado"> <i class="fa fa-cubes"></i>&nbsp;&nbsp;<strong>CONSOLIDADO</strong> </button></a>
                    <a href="/ventas/gridvolaris"> <button class="opediaria "> <i class="fa fa-fighter-jet"></i>&nbsp;<strong>OPE. DIARIA </strong> </button></a>
                    <a href="/ventas/reporte"> <button class="totales"> <strong><i class="fa fa-rocket"></i></strong>&nbsp;<strong>TOTALES WEB/OFF</strong> </button></a>
                    <a href="/ventas/dashboardoktrip" target="_blank"> <button class="dashboard"> <i class="fa fa-dashboard"></i> &nbsp;&nbsp;<strong>DASHBOARD </strong> </button></a>
                    <a href="/ventas/dashboard_indicators_oktrip" target="_blank"> <button class="dashboard"> <i class="fa fa-dashboard"></i> &nbsp;&nbsp;<strong>DASH 2020 </strong> </button></a>
                    <a href="/ventas/echarts"> <button class="graficas"> <i class="fa fa-line-chart"></i> &nbsp;&nbsp;<strong>G R A F I C A S</strong> </button></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF"><i class="fa fa-dollar"></i><strong> T O U R S </strong></font><br><br>
                    <a href="/ventas/tourscontenedor"> <button class="tours"><i class="fa fa-paw"></i>&nbsp;&nbsp;<strong>T O U R S</strong> </button></a>
                    <a href="/ventas/packscontenedor"> <button class="tours"><i class="fa fa-sitemap"></i>&nbsp;&nbsp;<strong>PAQUETES</strong> </button></a>
                    
                </div>
              <!-- <li><a><i class="fa fa-desktop"></i> CATALOGOS<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
              <li><a href="/ciudades"><button type="button" class="btn btn-dark">Ciudades. </button></a></li>
              <li><a href="/hoteles-destinos"><button type="button" class="btn btn-dark">Hoteles. </button></a></li>
              <li><a href="/claves"><button type="button" class="btn btn-dark">Claves. </button></a></li> </ul></li>
              
              -->

            </div>
        </div>

    </div>
</div>