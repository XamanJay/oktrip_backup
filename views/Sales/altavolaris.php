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

            <?php include("views/partialViews/_adminPanelSidebar.php"); ?>
            <?php // include("views/partialViews/_adminPanelTopNav.php"); ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="clear"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">

                            <form name="in_out_volaris" id="formSale" method="POST" action="/ventas/altavolaris">
                                <div class="row">



                                    <div class=" col-md-12"
                                        style="padding:5px;background-color: #d9edf7;margin-bottom: 20px;">
                                        <div>
                                            <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                                <label>
                                                    <font color="000000"> REGISTRO DE LLEGADAS. / SALIDAS. </font>
                                                </label>
                                            </p>
                                        </div>
                                    </div>



                                    <div class="col-md-12"
                                        style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">

                                        <div class="form-group  col-sm-3">
                                            <label for="nombre_completo">
                                                <font color="000000">Nombre.</font>
                                            </label>
                                            <input placeholder="Nombre completo" autofocus id="nombre_completo"
                                                name="nombre_completo" class="form-control" type="text" value=""
                                                required>
                                        </div>
                                        <div class="col-md-2  form-group">
                                            <label for="no_reserva">
                                                <font color="000000">Número de Reserva. </font>
                                            </label>
                                            <input id="no_reserva" name="no_reserva" class="form-control" type="text"
                                                value="" required>
                                        </div>
                                        <div class="col-md-2  form-group">
                                            <label for="Id_productos">
                                                <font color="000000">Transportación.</font>
                                            </label>
                                            <!--<input id="empresa" name="empresa" class="form-control" type="text" value="VOLARIS" required >-->

                                            <select class="form-control" autofocus name="Id_productos">
                                                <optgroup label="TRANSPORTACIÓN OKTRIP">
                                                    <option value="270" selected>VOLARIS</option>
                                                    <option value="233">GRATIS/ADHARA</option>
                                                    <option value="232">7 USD</option>
                                                    <option value="316">12 USD</option>
                                                    <option value="235">PRIVADA</option>

                                                </optgroup>
                                                <optgroup label="TRANSPORTACIÓN EXTERNA">
                                                    <option value="206">HOTELDO</option>
                                                    <option value="208">HOTELBEDS</option>
                                                    <option value="209">CEGAPER</option>
                                                    <option value="271">MAYA TOURS</option>
                                                </optgroup>
                                            </select>



                                        </div>
                                        <div class="col-md-1  form-group">
                                            <label for="paxxx">
                                                <font color="000000">"Pax".</font>
                                            </label>
                                            <input id="paxxx" name="paxxx" class="form-control" type="text" value="1"
                                                required>
                                        </div>

                                        <div class="col-md-2  form-group">
                                            <label for="total_publico">
                                                <font color="000000">Total Público.</font>
                                            </label>
                                            <input id="total_publico" name="total_publico" class="form-control"
                                                type="text" value="" placeholder="$$$">
                                        </div>

                                        <div class="col-md-2  form-group">
                                            <label for="total_neto">
                                                <font color="000000">Total Neto.</font>
                                            </label>
                                            <input id="total_neto" name="total_neto" class="form-control" type="text"
                                                value="" placeholder="$$$">

                                        </div>

                                    </div>

                                    <?php
						$today = date("d-m-Y");
						$today1 = date("d-m-Y",strtotime($today."+ 1 day"));
					?>


                                    <div class=" col-md-12"
                                        style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">

                                        <div class="form-group  col-sm-2">
                                            <label for="fecha_llegada">
                                                <font color="000000">Fecha llegada.</font>
                                            </label>
                                            <input id="fecha_llegada" name="fecha_llegada" class="form-control"
                                                type="text" value="">
                                        </div>
                                        <div class="form-group  col-sm-2">
                                            <label for="servicio_llegada">
                                                <font color="000000">Servicio llegada. </font>
                                            </label>
                                            <input id="servicio_llegada" name="servicio_llegada" class="form-control"
                                                type="text" value="APTO-ADHARA">
                                        </div>
                                        <div class="form-group  col-sm-1">
                                            <label for="no_vuelo_llegada" class="label-form">
                                                <font color="000000">No. Vuelo.</font>
                                            </label>
                                            <input id="no_vuelo_llegada" name="no_vuelo_llegada" class="form-control"
                                                type="text" value="">

                                        </div>
                                        <div class="form-group  col-sm-2">
                                            <label for="hora_vuelo_llegada">
                                                <font color="000000">HoraVuelo.</font>
                                            </label>
                                            <input placeholder="00:00" id="hora_vuelo_llegada" name="hora_vuelo_llegada"
                                                class="form-control" type="time" value=""
                                                onBlur="pickupllegada(this.value)">
                                        </div>
                                        <div class="form-group  col-sm-2">
                                            <label for="hora_pickup_llegada">
                                                <font color="000000">PickUp.</font>
                                            </label>
                                            <input placeholder="00:00" id="hora_pickup_llegada"
                                                name="hora_pickup_llegada" class="form-control" type="time" value="">
                                        </div>


                                        <div class="form-group  col-sm-1">
                                            <label for="uni_llegada">
                                                <font color="000000">Unidad.</font>
                                            </label>
                                            <select id="uni_llegada" name="uni_llegada" class="form-control">
                                                <option value="0" selected>Seleccionar.</option>
                                                <option value="1">1</option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                            </select>
                                        </div>


                                        <div class="form-group  col-sm-2">
                                            <label for="operador_llegada">
                                                <font color="000000">Operador.</font>
                                            </label>
                                            <select id="operador_llegada" name="operador_llegada" class="form-control">
                                                <option value="NINGUNO" selected>Seleccionar.</option>
                                                <option value="JOAZ">JOAZ</option>
                                                <option value="RICARDO"> RICARDO </option>
                                                <option value="SANTOS"> SANTOS </option>
                                                <option value="ELVIN"> ELVIN </option>
                                                <option value="APOYO"> APOYO </option>
                                                <option value="SANTOS/RICARDO"> SANTOS/RICARDO </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class=" col-md-12"
                                        style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">

                                        <div class="form-group  col-sm-2">
                                            <label for="fecha_salida">
                                                <font color="000000">Fecha salida.</font>
                                            </label>
                                            <input id="fecha_salida" name="fecha_salida" class="form-control"
                                                type="text" value="">
                                        </div>
                                        <div class="form-group  col-sm-2">
                                            <label for="servicio_salida">
                                                <font color="000000">Servicio salida. </font>
                                            </label>
                                            <input id="servicio_salida" name="servicio_salida" class="form-control"
                                                type="text" value="ADHARA-APTO">
                                        </div>
                                        <div class="form-group  col-sm-1">
                                            <label for="no_vuelo_salida" class="label-form">
                                                <font color="000000">No. Vuelo.</font>
                                            </label>
                                            <input id="no_vuelo_salida" name="no_vuelo_salida" class="form-control"
                                                type="text" value="">

                                        </div>
                                        <div class="form-group  col-sm-2">
                                            <label for="hora_vuelo_salida">
                                                <font color="000000">HoraVuelo.</font>
                                            </label>
                                            <input placeholder="00:00" id="hora_vuelo_salida" name="hora_vuelo_salida"
                                                class="form-control" type="time" value=""
                                                onBlur="pickupsalida(this.value)">
                                        </div>
                                        <div class="form-group  col-sm-2">
                                            <label for="hora_pickup_salida">
                                                <font color="000000">PickUp.</font>
                                            </label>
                                            <input placeholder="00:00" id="hora_pickup_salida" name="hora_pickup_salida"
                                                class="form-control" type="time" value="">
                                        </div>


                                        <div class="form-group  col-sm-1">
                                            <label for="uni_salida">
                                                <font color="000000">Unidad.</font>
                                            </label>
                                            <select id="uni_salida" name="uni_salida" class="form-control">
                                                <option value="0" selected>Seleccionar.</option>
                                                <option value="1">1</option>
                                                <option value="2"> 2 </option>
                                                <option value="3"> 3 </option>
                                                <option value="4"> 4 </option>
                                                <option value="5"> 5 </option>
                                                <option value="6"> 6 </option>
                                            </select>
                                        </div>


                                        <div class="form-group  col-sm-2">
                                            <label for="operador_salida">
                                                <font color="000000">Operador.</font>
                                            </label>
                                            <select id="operador_salida" name="operador_salida" class="form-control">
                                                <option value="NINGUNO" selected>Seleccionar.</option>
                                                <option value="JOAZ">JOAZ</option>
                                                <option value="RICARDO"> RICARDO </option>
                                                <option value="SANTOS"> SANTOS </option>
                                                <option value="ELVIN"> ELVIN </option>
                                                <option value="APOYO"> APOYO </option>
                                                <option value="SANTOS/RICARDO"> SANTOS/RICARDO </option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class=" col-md-12"
                                        style="padding:10px;background-color: #d9edf7;margin-bottom: 20px;">
                                        <div class="form-group  col-sm-8">
                                            <label for="comentarios" class="label-form">
                                                <font color="000000">Comentarios.</font>
                                            </label>

                                            <textarea id="comentarios" name="comentarios" class="form-control" value=""
                                                size=10 rows=3 cols=35> </textarea>

                                        </div>

                                        <div class="form-group  col-sm-2">
                                            <label for="no_vuelo_salida" class="label-form">
                                                <font color="000000">&nbsp;</font>
                                            </label><br>
                                            <input type="button" class="btn btn-primary" value=" :: G U A R D A R :: "
                                                name="B01" onClick="ValidaCampos()">
                                        </div>


                                        <div class="form-group  col-sm-2">
                                            <label for="no_vuelo_salida" class="label-form">
                                                <font color="000000">&nbsp;</font>
                                            </label><br>
                                            <input type="reset" class="btn btn-primary" value=" :: R E S E T :: ">
                                        </div>

                                    </div>
                                    <!--<div>
                                             <p style="text-align: center;margin-bottom: 2px;margin-top: 2px;">
                                                                                                                                                                                    <!--  <input type="submit" class="btn btn-primary"  value=":: G U A R D A R :: "> -->
                                    <!--       <input type="button" class="btn btn-primary" value=" :: G U A R D A R :: " name="B01" onClick="ValidaCampos()" >
                                                <input type="reset" class="btn btn-primary"  value=" :: R E S E T :: ">
                                            </p>
									    </div>-->


                                </div>

                        </div> <!-- class="row" -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer content -->
    <footer>
        <div class="pull-right">
            <!--<a href="https://colorlib.com"> Colorlib</a>-->
        </div>
        <div class="clearfix"></div>
    </footer>
    </div>

    <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/nprogress/nprogress.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/icheck.min.js"></script>
    <script type="text/javascript" src="/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="/js/jquery-validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/moment/moment.min.js"></script>
    <script type="text/javascript" src="/js/moment/locale/es.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/js/SweetAlert/sweetalert2.min.js"></script>

    <script type="text/javascript" src="/js/dataTables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/responsive/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/responsive/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/buttons/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/buttons/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/buttons/jszip.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js	"></script>
    <script type="text/javascript" src="/js/dataTables/buttons/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/buttons/buttons.print.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/buttons/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/select/dataTables.select.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/editor/dataTables.editor.min.js"></script>
    <script type="text/javascript" src="/js/dataTables/editor/editor.bootstrap.min.js"></script>

    <!-- Choosen -->
    <script type="text/javascript" src="/js/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/chosen/prism.js" charset="utf-8"></script>
    <script type="text/javascript" src="/js/chosen/init.js" charset="utf-8"></script>

    <script type="text/javascript" src="/js/scripts-admin.js"></script>





    <script>
    $(document).ready(function() {

        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        var dateFormat = "mm/dd/yy",
            from = $("#fecha_llegada").datepicker({
                defaultDate: "null",
                changeMonth: true,
                numberOfMonths: 1
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#fecha_salida").datepicker({
                defaultDate: "null",
                changeMonth: true,
                numberOfMonths: 1
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }
    });
    </script>

    <script>
    function ValidaCampos() {

        var jvi_texto_correcto = /[\d\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
        var jvi_numero_correcto = /[\D\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
        var jvi_numero_correcto1 = /[\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/
        var jvi_textoynumero_correcto = /[\'\"\(\)\%\$\!\#\&\<\>\+\*\=\?\¿\¡\[\]\{\}\/\@]/

        if (in_out_volaris.nombre_completo.value == "") {
            alert("El campo: Nombre, no debe estar vacío, favor de verificar ");
            in_out_volaris.nombre_completo.focus();
            return false;
        }
        if (in_out_volaris.no_reserva.value == "") {
            alert("El campo: Número de Reserva, no debe estar vacío, favor de verificar ");
            in_out_volaris.no_reserva.focus();
            return false;
        }
        //if (in_out_volaris.empresa.value  == "")   {
        //              alert("El campo: Empresa, no debe estar vacío, favor de verificar ");    in_out_volaris.empresa.focus(); return false;
        //        }  
        if (in_out_volaris.paxxx.value == "") {
            alert("El campo: PAX, no debe estar vacío, favor de verificar ");
            in_out_volaris.paxxx.focus();
            return false;
        }
        //if (in_out_volaris.fecha_llegada.value  == "")   {
        //					  alert("El campo: Fecha llegada, no debe estar vacío, favor de verificar ");    in_out_volaris.fecha_llegada.focus(); return false;
        //				}  
        if (jvi_texto_correcto.test(in_out_volaris.nombre_completo.value)) {
            alert('Ha escrito un caracter no valido en el campo Nombre, verifique por favor.');
            in_out_volaris.nombre_completo.focus();
            return false;
        }
        if (jvi_numero_correcto.test(in_out_volaris.no_reserva.value)) {
            alert('Ha escrito un caracter no valido en el campo Número de Reserva, verifique por favor.');
            in_out_volaris.no_reserva.focus();
            return false;
        }
        if (jvi_numero_correcto.test(in_out_volaris.paxxx.value)) {
            alert('Ha escrito un caracter no valido en el campo Pax, verifique por favor.');
            in_out_volaris.paxxx.focus();
            return false;
        }
        if (jvi_textoynumero_correcto.test(in_out_volaris.total_publico.value)) {
            alert('Ha escrito un caracter no valido en el campo Total público, verifique por favor.');
            in_out_volaris.total_publico.focus();
            return false;
        }
        if (jvi_textoynumero_correcto.test(in_out_volaris.total_neto.value)) {
            alert('Ha escrito un caracter no valido en el campo Total neto, verifique por favor.');
            in_out_volaris.total_neto.focus();
            return false;
        }



        alert(" Registro Grabado \n  ¡ Exitosamente ! ");
        in_out_volaris.B01.disabled = true;
        document.in_out_volaris.submit();

    }


    function pickupllegada(val) {

        var x = document.getElementById("hora_vuelo_llegada").value;
        var h1 = x.charAt(0);
        var h2 = x.charAt(1);
        var m1 = x.charAt(3);
        var m2 = x.charAt(4);
        var horas = h1.concat(h2);
        var horas = horas * 3600;
        var minutos = m1.concat(m2);
        var minutos = minutos * 60;
        var treinta = 1800;
        var segundos = horas + minutos + treinta;
        var puntos = ':';
        var hora = h1.concat(h2, puntos, m1, m2);
        var hours = Math.floor(segundos / 3600);
        var minutes = Math.floor((segundos % 3600) / 60);
        var seconds = segundos % 60;
        var hours = hours < 10 ? '0' + hours : hours;
        var minutes = minutes < 10 ? '0' + minutes : minutes;
        var seconds = seconds < 10 ? '0' + seconds : seconds;
        var result = hours + ":" + minutes;
        document.getElementById("hora_pickup_llegada").value = result;
        in_out_volaris.uni_llegada.focus();
    }

    function pickupsalida(val) {
        var x = document.getElementById("hora_vuelo_salida").value;
        var h1 = x.charAt(0);
        var h2 = x.charAt(1);
        var m1 = x.charAt(3);
        var m2 = x.charAt(4);
        var horas = h1.concat(h2);
        var horas = horas * 3600;
        var minutos = m1.concat(m2);
        var minutos = minutos * 60;


        /*var cuarenta =  2400;*/
        var treinta = 1800;
        /*var segundos = horas + minutos - cuarenta  ;*/
        var segundos = horas + minutos - treinta;


        var puntos = ':';
        var hora = h1.concat(h2, puntos, m1, m2);

        var hours = Math.floor(segundos / 3600);
        var minutes = Math.floor((segundos % 3600) / 60);
        var seconds = segundos % 60;

        var hours = hours < 10 ? '0' + hours : hours;
        var minutes = minutes < 10 ? '0' + minutes : minutes;
        var seconds = seconds < 10 ? '0' + seconds : seconds;
        var result = hours + ":" + minutes;

        document.getElementById("hora_pickup_salida").value = result;
        in_out_volaris.uni_salida.focus();
    }
    </script>


</body>

</html>