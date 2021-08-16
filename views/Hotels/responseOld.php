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
            if(isset($_GET['vpc_OrderInfo'])){

                $db = new db();
                $conn = $db->conn_local();
                $statusCancelado = 5;
                $statusAutorizado = 3;

                $idReserva = $_GET['vpc_OrderInfo'];
                $query = "UPDATE Reservations SET estatus = ? WHERE idres = '".$idReserva."';";

                if($authorizeID !=""  && $error != "Error " && $authorizeID !="000000" && $message!="Rechazado"){ 
                    //actualizo reserva aceptada 
                    // Actualización del estado y consulta de HotelDo
                    $xmldata = "";

                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(1,$statusAutorizado);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if($count > 0) echo "actualizado correctamente db old<br>";
                    else echo "no se actualizó db old<br>";

                    $query = "SELECT (xmldata) FROM WHERE idres = '".$idReserva."';";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(1,$statusAutorizado);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if($count > 0) 
                    {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $xmldata = $row["xmldata"];

                        $URL = "http://testxml.e-tsw.com/AffiliateService/AffiliateService.svc/restful/Book";
                        $ch = curl_init($URL);
                        curl_setopt($ch, CURLOPT_MUTE, 1);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmldata");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);
                    }
                    else 
                    {
                        echo "No se obtuvo el XML";
                    }


                    $valsxml = simplexml_load_string($output);
                    $confirmationid= (string) $valsxml->confirmationid;
                    $totalcosto= (string) $valsxml->total;
                    $statusbooking= (string) $valsxml->statusbooking;
                    $statuspayment= (string) $valsxml->statuspayment;
                    $HotelID= (string) $valsxml->hotelid;

                    ?>
                    <div class="resultado_banamex_title">¡Gracias!</div>
                    <div class="resultado_banamex_text">Hemos recibido su solicitud, en breve recibirá un correo con información detallada sobre su reservación.</div>
                    <div class="resultado_banamex_text">Referencia: <?php #echo $confirmationid; ?></div>
                    <div class="resultado_banamex_text">Nº de reservación: <?php echo($orderInfo); ?></div>
                    <div class="resultado_banamex_text">Mensaje: <?php echo($message); ?></div>
                    <?php
                    // only display the following fields if not an error condition
                    if($txnResponseCode!="7" && $txnResponseCode!="No Value Returned") { 
                        ?>
                        <div class="resultado_banamex_text">Número de autorización: <?php echo($authorizeID); ?></div>
                        <?php
                    }
                    ?>
                    <div class="resultado_banamex_back"> <a href="/home" class="redprice">Regresar</a></div>
                    <?php
                }
                else
                {

                    // Actualización del estado y consulta de HotelDo 

                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(1,$statusCancelado);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if($count > 0) 
                        {echo "actualizado correctamente db old<br>";}
                    else 
                        {echo "no se actualizó db old: ".$idReserva."<br>";}

                    ?>
                    <div class="col-md-8 col-md-push-2">
                        <img src="/img/iconos/caution-error.svg" class="img-responsive center-block" alt="" style="width: 200px;">
                        <img src="/img/iconos/line-error.svg" class="img-responsive center-block" alt="">
                        <p class="text-center cl-ok">
                            Ha ocurrido un problema</br>
                            El cargo a su tarjeta fue rechazado por el banco, por favor verifique sus datos e intente de nuevo.</br>
                            <?php echo($message); ?></br>
                            <a href="" class="btn btn-ok">Regresar</a>
                            <a href="/home" class="btn btn-ok">Cancelar</a>
                        </p>
                    </div>

            <?php
        }
    }
    ?>

</div><!-- Fin del container-->
</div>
<?php include("views/partialViews/_footer.php"); ?>
<?php include("views/partialViews/_landingScripts.html"); ?>
</body>
</html>