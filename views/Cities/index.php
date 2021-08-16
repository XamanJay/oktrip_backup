<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panel administrativo Oktrip! </title>
    <?php include("views/partialViews/_adminPanelStyles.html"); ?>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <!-- sidebar -->
            <?php include("views/partialViews/_adminPanelSidebar.php"); ?>

            <!-- top navigation -->
            <?php include("views/partialViews/_adminPanelTopNav.php"); ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="clear"></div>
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li><a href="/home">Home</a></li>
                            <li class="active">Ciudades</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Tabla de ciudades <small></small></h2>
                                <form id='updateCities' action="/ciudades/update" method="POST">
                                    <button class="btn btn-default btn-sm pull-right">Cargar ciudades</button>
                                </form>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="controlPanel"></div>
                                <div class="clear"></div>
                                <table id='cities' class="dataTable table table-striped table-bordered table-responsive wrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Id ciudad</th>
                                            <th>Nombre</th>
                                            <th>Id país</th>
                                            <th>País</th>
                                            <th>Ruta</th>
                                            <th>Longitud</th>
                                            <th>Latitud</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id ciudad</th>
                                            <th>Nombre</th>
                                            <th>Id país</th>
                                            <th>País</th>
                                            <th>Ruta</th>
                                            <th>Longitud</th>
                                            <th>Latitud</th>
                                        </tr>
                                    </tfoot>
                                    <!--tbody>
                                        <?php
                                        /*foreach ($arrayCities as $city) {
                                            echo "<tr>
                                            <td>".$city->getIdCity()."</td>
                                            <td>".$city->getName()."</td>
                                            <td>".$city->getIdCountry()."</td>
                                            <td>".$city->getCountry()."</td>
                                            <td>".$city->getPath()."</td></tr>";
                                        }*/


                                        ?>

                                    </tbody-->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>
    

    <div class="wall-ok">
        <div class="loanding-page">
            <div class="middle-page">
                <img src="/img/iconos/spin.svg" alt="">
            </div>
        </div>
    </div>

    <?php include("views/partialViews/_adminPanelScripts.html"); ?>

</body>
</html>
