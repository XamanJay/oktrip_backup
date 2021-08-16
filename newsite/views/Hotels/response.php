<!DOCTYPE html>
<html lang="es">
<head>
	<title>Oktrip!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include("views/partialViews/_landingStyles.html"); ?>
</head>
<body id="response">
	<?php include("views/partialViews/_header.php"); ?>
	<div class="container-fluid banner">
		<div class="container">
            <?php
            if($response["success"])
            {
                $urlReturn = "/home/es";
                if(isset($_COOKIE['urlReturn'])){
                     $urlReturn = $_COOKIE['urlReturn'];
                }

                if(strcmp($response["nbResponse"], "Aprobado") == 0 )
                {
                    //print_r($response);
                    echo '<div class="col-md-8 col-md-push-2">
                    <img src="/img/iconos/ok.svg" class="img-responsive center-block" alt="" style="width: 200px;">
                    <img src="/img/iconos/line-error.svg" class="img-responsive center-block" alt="">
                    <p class="text-center cl-ok">';

                    if(strcmp($_COOKIE["Lang"], "en") == 0 )
                    {
                        echo 'Payment status: <b>'.$response["nbResponse"].' </b><br>
                        Authorization number: <b>'.$response["nuAut"].'</b><br>
                        Reference number: <b>'.$response["referenciaPayment"].'</b></br></br>
                        We have received your request, you will receive an email shortly with detailed information about your reservation.</br>
                        <a href="/es" class="btn btn-ok">Back to home</a></div>';
                    }
                    else if(strcmp($_COOKIE["Lang"], "es") == 0)
                    {
                        echo 'Estado de pago: <b>'.$response["nbResponse"].' </b><br>
                        Número de autorización: <b>'.$response["nuAut"].'</b><br>
                        El número de referencia de pago es: <b>'.$response["referenciaPayment"].'</b></br></br>
                        Hemos recibido su solicitud, en breve recibirá un correo con información detallada sobre su reservación.</br>
                        <a href="/en" class="btn btn-ok">Regresar</a></div>';
                    }
                    else
                    {
                        echo 'Estado de pago: <b>'.$response["nbResponse"].' </b><br>
                        Número de autorización: <b>'.$response["nuAut"].'</b><br>
                        El número de referencia de pago es: <b>'.$response["referenciaPayment"].'</b></br></br>
                        Hemos recibido su solicitud, en breve recibirá un correo con información detallada sobre su reservación.</br>
                        <a href="/en" class="btn btn-ok">Regresar</a></div>';
                    }

                }
                else
                {
                    echo '<div class="col-md-8 col-md-push-2">
                    <img src="/img/iconos/caution-error.svg" class="img-responsive center-block" alt="" style="width: 200px;">
                    <img src="/img/iconos/line-error.svg" class="img-responsive center-block" alt="">
                    <p class="text-center cl-ok">';
                    if(strcmp($_COOKIE["Lang"], "en") == 0 )
                    {
                        echo 'A problem has occurred: <b>'.$response["cdResponse"].'</b></br>';
                        if(isset($response['nb_error']))
                        {
                            echo $response['nb_error'].'</br>';
                        }
                        else
                        {
                            echo 'The charge to your card was rejected by the bank, please verify your data and try again.</br>';
                        }
                        echo '</br>
                        <a href="'.$urlReturn.'" class="btn btn-ok">Try again</a></div>';
                    }
                    else if(strcmp($_COOKIE["Lang"], "es") == 0)
                    {

                        echo 'Ha ocurrido un problema: <b>'.$response["cdResponse"].'</b></br>';
                        if(isset($response['nb_error']))
                        {
                            echo $response['nb_error'].'</br>';
                        }
                        else
                        {
                            echo 'El cargo a su tarjeta fue rechazado por el banco, por favor verifique sus datos e intente de nuevo.</br>';
                        }
                        echo '</br>
                        <a href="'.$urlReturn.'" class="btn btn-ok">Regresar</a></div>';

                    }
                    else
                    {
                        echo 'Ha ocurrido un problema: <b>'.$response["cdResponse"].'</b></br>';
                        if(isset($response['nb_error']))
                        {
                            echo $response['nb_error'].'</br>';
                        }
                        else
                        {
                            echo 'El cargo a su tarjeta fue rechazado por el banco, por favor verifique sus datos e intente de nuevo.</br>';
                        }
                        echo '</br>
                        <a href="'.$urlReturn.'" class="btn btn-ok">Regresar</a></div>';
                    }

                }
            }

            ?>
        </div>
    </div><!-- Fin del container-->
</div>
<?php include("views/partialViews/_footer.php"); ?>
<?php include("views/partialViews/_landingScripts.html"); ?>
</body>
</html>