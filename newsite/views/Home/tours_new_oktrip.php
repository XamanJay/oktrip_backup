<!DOCTYPE html>
<html lang="en">

<head>
    <title> Project Title 141220 </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="/img/iconos/favicon.png" />
    <link rel="stylesheet" href="../../css/animate/carrusel.css">





</head>

<body>

    <div class="container-fluid" align="center">
        <h3 class="tomato">Bienvenidos a Ok trip &nbsp; <i class="fas fa-hand-holding-heart"></i> </h3>
        <p>La mejor opción que encontraras en la Riviera Maya para guiarte en tu satisfacción. </p>
    </div>






    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">

        <a class="navbar-brand" href="#"> <img src="../../img/Reportes_Vtas/LogoOkTripSuperior.png" width="90"
                height="38"> </a>
        <a class="navbar-brand" href="#"> TOURS... </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">ARQUEOLOGÍA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">PARQUES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">DEPORTES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">AVENTURA</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        VARIOS
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>

            </ul>
        </div>
    </nav>








    <div class="container-fluid header">
        <br>
        <h4>Tu agencia de confianza </h4>
        <!-- <p>La mejor opción que encontraras en la Riviera Maya para guiarte en tu satisfacción.</p>
  <p>Navega nuestros tours y disfrutalo. <strong>Nota:</strong> se aplican restricciones.</p>-->
        <BR>
        <HR>
    </div>




















    <div id="TablasTours" class="container" style="margin-top:10px">

        <div class="row">

            <div class="col-sm-2" align="center">
                <img src="../../img/Reportes_Vtas/jungle-maya-main-th.jpg" width="180" height="110">
            </div>

            <div class="col-sm-6">
                <p>Xplor Tour This park has become in a short time a must-do for visitors to Cancun.
                    Have a day full of adventure activities surrounded by incredible underground formations
                    like cenotes, caves and rivers. Come to see why Xplor is the park where everyone wants to go </p>
            </div>

            <div class="col-sm-2" align="center">
                <?php echo '<a href="/toursdetails/'.$GLOBALS['lang'].'"> <button type="button" class="btn btn-secondary">Reserva Ahora...</button> </a>';?>
            </div>


            <div class="col-sm-2" align="center">
                <img src="../../img/IMAGENES_TOURS/Anotación 2019-08-22 123247.png" width="150" height="97">
            </div>

        </div>



















        <div class="row" align="center">

            <div class="col-sm-2 ">
                <img src="../../img/Reportes_Vtas/th-ekbalam-cenote-maya-main.jpg" width="180" height="110">
            </div>

            <div class="col-sm-6 align-items-center">
                <p>Xplor Tour This park has become in a short time a must-do for visitors to Cancun.
                    Have a day full of adventure activities surrounded by incredible underground formations
                    like cenotes, caves and rivers. Come to see why Xplor is the park where everyone wants to go </p>
            </div>

            <div class="col-sm-2 ">
                <div align="center">


                    <?php echo '<a href="/toursdetails/'.$GLOBALS['lang'].'"> <button type="button" class="btn btn-secondary">Reserva Ahora...</button> </a>';?>
                </div>
            </div>


            <div class="col-sm-2 ">
                <img src="../../img/IMAGENES_TOURS/Anotación 2019-08-22 123247.png" width="150" height="97">
            </div>
        </div>










        <div id="carrusell" class="container" style="margin-top:10px">
            <div class="row">
                <div class="col-sm-12">

                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                        </ul>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../img/Reportes_Vtas/carrusel1/img1.jpg" alt="Los Angeles" width="1100"
                                    height="500">

                                <div class="carousel-caption">
                                    <h3>Los Angeles</h3>
                                    <p>We had such a great time in LA!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/Reportes_Vtas/carrusel1/img2.jpg" alt="Chicago" width="1100"
                                    height="500">
                                <div class="carousel-caption">
                                    <h3>Chicago</h3>
                                    <p>Thank you, Chicago!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="../../img/Reportes_Vtas/carrusel1/img3.jpg" alt="New York" width="1100"
                                    height="500">
                                <div class="carousel-caption">
                                    <h3>New York</h3>
                                    <p>We love the Big Apple!</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>

                </div>
            </div>
        </div>














        <div id="TablasToursII" class="container" style="margin-top:10px">

            <div class="row" align="center">

                <div class="col-sm-2 ">
                    <img src="../../img/Reportes_Vtas/th-coba-maya-encounter-main.jpg" width="180" height="110">
                </div>

                <div class="col-sm-6 align-items-center">
                    <p>Xplor Tour This park has become in a short time a
                        must-do for visitors to Cancun. Have a day full of adventure activities surrounded by incredible
                        underground formations like cenotes, caves and rivers. Come to see why Xplor is the park where
                        everyone wants to go </p>
                </div>

                <div class="col-sm-2 ">
                    <div align="center">


                        <?php echo '<a href="/toursdetails/'.$GLOBALS['lang'].'"> <button type="button" class="btn btn-secondary">Reserva Ahora...</button> </a>';?>
                    </div>
                </div>


                <div class="col-sm-2 ">
                    <img src="../../img/IMAGENES_TOURS/Anotación 2019-08-22 123247.png" width="150" height="97">
                </div>
            </div>


        </div>






        <BR>
        <BR>

        <div id="carrusell" class="container-fluid" style="margin-top:1px">
            <div class="row">
                <div class="col-sm-12">

                    <div class="content-all">
                        <div class="content-carrousel">
                            <figure><img src="../../img/IMAGENES_TOURS/2_Holbox.png"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/6_ElUnico.jpg"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/7_Tulum.png"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/1_TulumActual.png"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/3_Kukulkan.jpg"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/9_BlvrdKukulka.jpg"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/10_GrandMaya.png"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/4_Bacalar.png"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/5_Cenote.png"></figure>
                            <figure><img src="../../img/IMAGENES_TOURS/8_Xcaret.png"></figure>
                        </div>
                    </div>



                </div>
            </div>
        </div>












        <div class="jumbotron text-center" style="margin-bottom:1">
            <img src="../../img/Reportes_Vtas/LogoOkTripSuperior.png">
            <p>2019</p>
        </div>











        <div style="margin-bottom:5px">
            <img src="../../img/Reportes_Vtas/carrusel1/img44.jpg" style="width:100%">
        </div>








        <div class="jumbotron text-center" style="margin-bottom:1">
            <img src="../../img/Reportes_Vtas/LogoOkTripSuperior.png">
            <p>2019</p>
        </div>





































        <footer class="container-fluid text-center footer-style">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 footer-col">
                        <h3>Dirección</h3>
                        <p>
                            Nader México
                            <video width="320" height="240" controls>
                                <source src="../../img/IMAGENES_TOURS/movie.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>


                        </p>
                    </div>
                    <div class="col-md-4 footer-col">
                        <h3>Nuestras redes</h3>
                        <ul class="list-inline">
                            <li>
                                <a target="_blank" href="#" class="btn-social btn-outline"><i
                                        class="fas fa-cloud"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="#" class="btn-social btn-outline"><i
                                        class="fas fa-coffee"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="#" class="btn-social btn-outline"><i
                                        class="fas fa-car"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="#" class="btn-social btn-outline"><i
                                        class="fas fa-file"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="#" class="btn-social btn-outline"><i
                                        class="fas fa-bars"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-col">
                        <h3>Tours </h3>
                        <p>Tenemos más de X años de experiencia en hoteleria y tours </p>



                        <audio controls autoplay>

                            <source src="../../img/IMAGENES_TOURS/30 - Castlevania - Track 30.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                    </div>
                </div>
            </div>
        </footer>











        <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
            <!-- fixed-bottom -->

            <a class="navbar-brand" href="#"> <img src="../../img/Reportes_Vtas/LogoOkTripSuperior.png" width="90"
                    height="38"> </a>
            <a class="navbar-brand" href="#"> TOURS OK TRIP </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Z. A.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">E. P.</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">D. A.</a>
      </li>    
	  <li class="nav-item">
	    <a class="nav-link" href="#">A. A.</a>
	  </li>
    </ul>
  </div>  -->
        </nav>







</body>

</html>




















<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>