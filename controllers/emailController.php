<?php 
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;*/
include_once("class.phpmailer.php");

class emailController{
	
	public function allotmentOut($cuarto,$idReserva){

		$mensaje = '
			<!DOCTYPE html>
			<html>
				<head>
				<meta charset="utf-8">
					<title></title>
				</head>
				<body>
					<table width="600">
			          <tr>
			            <td>
			            	<img src="https://adharacancun.com/img/mail/header.jpg" width="600">
			            </td>
			          </tr>
			          <tr>
			            <td>
			            	<div style="width:80%; min-height:150px; margin:20px auto 20px; ">
			            		<b>El cuarto: '.$cuarto.'</b></br>
			            		<p>Se quedo sin Allotment</p><br>
			                </div>
			            </td>
			          </tr>
			          <tr>
			            <td colspan="2" height="40" style="background:#000" >
			                <p style="text-align: center; height:20px; color: #ffffff; font-size: 12px; width:100%; background:#000000; margin:0px;">Adhara Cancun, Copyright 2016</p>
			            </td>
			          </tr>
			        </table>
				</body>
			</html>';
		$mailenviado = 0;
		
		$mailSubject  =  "Allotment Adhara";  // mensaje Subject
		$mailFromName = "Hotel Adhara Cancun"; // Nombre del remitente
		$mail1="revenue@gphoteles.com";
		$mail2="programacionweb@gphoteles.com";
		$mail = new PHPMailer(true);
		try {
			
			$mail->isSMTP(); // send via SMTP
			$mail->Host     = 'okcloud.arvixecloud.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'noreply@animate.adharacancun.com';
			$mail->Password = 'Na_xJiira3$.';
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 587;  
			$mail->setFrom('noreply@animate.adharacancun.com',$mailFromName);
			$mail->addAddress($mail1,'Reservation');
			$mail->addAddress($mail2,'Reservation');
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true);       // send as HTML
			$mail->Subject  =  $mailSubject;
			$mail->Body    =  $mensaje;
			if(!$mail->Send()){
		    	//echo "Message was not sent <p>";
		        //echo "Mailer Error: " . $mail->ErrorInfo;
		        $mailenviado=0;
		    }else{

				$textInicio = "\n\n--------------- Se envió el email al cliente de la reserva ".$idReserva." PayPal ".date("Y/m/d")."--------------\n\n";
				file_put_contents ("emailsSend.txt",$textInicio ,FILE_APPEND);
		    }

	    } catch (Exception $e) {
			echo "ERROR FATAL: ".$e;
		}

	}

	public function emailBancario($lastservice,$pagoBancario,$currency,$nombre,$apellidos,$detalles,$email){
		$mensaje = '
		<!DOCTYPE html>
		<html>
			<head>
			<meta charset="utf-8">
				<title></title>
			</head>
			<body>
				<table width="600">
		          <tr>
		            <td>
		            	<img src="https://adharacancun.com/img/mail/header.jpg" width="600">
		            </td>
		          </tr>
		          <tr>
		            <td>
		            	<div style="width:80%; min-height:150px; margin:20px auto 20px; ">
		            		<b>NÚMERO DE RESERVACIÓN: '.$lastservice.'</b></br>
		            		<p>Impuestos incluidos</p><br>
							<b>TOTAL A PAGAR: $'.number_format($pagoBancario, 2, '.', ',').' '.$currency.'</b></br>
							<b>Nombre: </b>'.$nombre.' '.$apellidos.'<br>
							<b>Tiene un plazo máximo de 48hrs. para realizar el deposito bancario de lo contrario su reservaci&oacute;n ser&aacute; cancelada.</b></br>
							'.$detalles.'<br><br>
							<b style="font-size:16px">Reservación Pendiente de Pago</b></br>
							
							<p>Muchas gracias por reservar con nosotros. Para poder hacer efectiva su reservaci&oacute;n es necesario hacer el depósito o transferencia por el total de la reservación.</p></br>
							
							<b>Transferencia, SPEI, Depósito en cheque en efectivo</b></br>
							
							<b>BANAMEX </b></br>
							<p>Raz&oacute;n social: OKTRAVEL SA DE CV</p>
							<p>Sucursal: 7006</p>
							<p>Cuenta: 5731817</p>
							<p>CLABE: 002691700657318179</p>
							<p>Referencia: N&uacute;mero de Reservaci&oacute;n (ver arriba)</p>
							<hr>
							<b>BANCOMER</b></br>
							<p>Raz&oacute;n social: OKTRAVEL SA DE CV</p>
							<p>Cuenta: 0194639928</p>
							<p>CLABE: 012691001946399284</p>
							<p>Referencia: N&uacute;mero de Reservaci&oacute;n (ver arriba)</p>
							<hr>
							<b>BANCO INBURSA</b></br>
							<p>Raz&oacute;n social: OKTRAVEL SA DE CV</p>
							<p>Cuenta: 50022357519</p>
							<p>CLABE: 036691500223575198</p>
							<p>Referencia: N&uacute;mero de Reservación (ver arriba)</p>
							<hr>
							<p>TIENDAS SANBORNS (S&oacute;lo dep&oacute;sito en efectivo)</p>
							<p>Raz&oacute;n social: OKTRAVEL SA DE CV</p>
							<p>Cuenta: 50022357519</p>
							<p>Referencia: N&uacute;mero de Reservaci&uacute;n (ver arriba)</p>
							<hr>
							<b><p>Importante: Es necesario enviar el comprobante de pago al correo fabiola@oktravel.mx</p>
							<hr>
							<p>Para cualquier pregunta referente a su reservaci&oacute;n favor de contactarnos</p>
							<p>Llamada sin costo al: 01 800 711-15-31 (M&eacute;xico)</p>
							<p>Tel&eacute;fono: +52 (998) 881 65 00</p>
							<p>Fax: +52 (998) 884 83 76</p>
							<p>reservaciones@gphoteles.com</p></b>
		                </div>
		            </td>
		          </tr>
		          <tr>
		            <td colspan="2">
		                <table>
		                    <tr>
		                        <td style="float: left;" width="100" height="75px">&nbsp;
		                            
		                        </td>
		                        <td style="float: left;" width="160">
		                            <a style=" text-decoration: none; color: #000; margin-top: 20px; display: block;" href="https://www.facebook.com/HotelAdharaCancun" target="_blank">
		                                <img src="https://adharacancun.com/img/mail/icon_fb.jpg" style="float: left; margin:0 auto;" height="" align="top" width="">
		                                <span style="font-size: 12px; margin-top: 8px; float: left; vertical-align:top;">HotelAdharaCancun</span>
		                            </a>
		                        </td>
		                        <td style="float: left;" width="160">
		                            <a style=" text-decoration: none; color: #000; margin-top: 20px; display: block;" href="https://twitter.com/adharacancun" target="_blank">
		                                <img src="https://adharacancun.com/img/mail/icon_tw.jpg" style="float: left; margin:0 auto;" height="" align="top" width="">
		                                <span style="font-size: 12px;  margin-top: 8px; float: left; vertical-align:top;">@AdharaCancun</span>
		                            </a>
		                        </td>
		                        <td style="float: left;" width="160">
		                            <a style=" text-decoration: none; color: #000; margin-top: 20px; display: block;" href="https://www.instagram.com/explore/locations/257244026/" target="_blank">
		                                <img src="https://adharacancun.com/img/mail/icon_insta.jpg" style="float: left; margin:0 auto;" height="" align="top" width="">
		                                <span style="font-size: 12px;  margin-top: 8px; float: left; vertical-align:top;">AdharaCancun</span>
		                            </a>
		                        </td>
		                    </tr>
		                </table>
		            </td>
		          </tr>
		          <tr>
		            <td colspan="2" height="40" style="background:#000" >
		                <p style="text-align: center; height:20px; color: #ffffff; font-size: 12px; width:100%; background:#000000; margin:0px;">Adhara Cancun, Copyright 2016</p>
		            </td>
		          </tr>
		        </table>
			</body>
		</html>';
		$mailenviado = 0;
		$mailSubject  =  "Reservacion Adhara";  // mensaje Subject
		$mailFromName = "Hotel Adhara Cancun"; // Nombre del remitente
		$to = $email;
		$mail1="reservaciones@gphoteles.com";
		$mail2="asistente1.reservaciones@gphoteles.com";
	    $mail3="gerenteenturno@gphoteles.com";
	    $mail4="reservaciones3@gphoteles.com";
	    $mail5="programacionweb@gphoteles.com";
		$mail = new PHPMailer(true);
		try {

			/*$mail->SMTPOptions = array(
						    'ssl' => array(
						        'verify_peer' => false,
						        'verify_peer_name' => false,
						        'allow_self_signed' => true
						    )
			); */
			$mail->isSMTP(); // send via SMTP
			$mail->Host     = 'okcloud.arvixecloud.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'noreply@animate.adharacancun.com';
			$mail->Password = 'Na_xJiira3$.';
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 587; 
			$mail->setFrom('noreply@animate.adharacancun.com',$mailFromName);
			$mail->FromName = $mailFromName;
			$mail->addAddress($to,'Reservation');
			$mail->addBCC($mail1);
			$mail->addBCC($mail2);
			$mail->addBCC($mail3);
			$mail->addBCC($mail4);
			$mail->addBCC($mail5);
			
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true);       // send as HTML
			$mail->Subject  =  $mailSubject;
			$mail->Body    =  $mensaje;
			return $mailenviado = (!$mail->Send()) ? 0 : 1;
		} catch (Exception $e) {
			echo "ERROR FATAL: ".$e;
		}
	}

	public function emailHotel($setReserva,$pagoHotel,$currency,$nombre,$apellidos,$detalles,$email){

		$mensaje = '<!DOCTYPE html>
		<html>
			<head>
			<meta charset="utf-8">
				<title></title>
			</head>
			<body>
				<table width="600">
		          <tr>
		            <td>
		            	<img src="https://adharacancun.com/img/mail/header.jpg" width="600">
		            </td>
		          </tr>
		          <tr>
		            <td>
		            	<div style="width:80%; min-height:150px; margin:20px auto 20px; ">
		            		N&Uacute;MERO DE RESERVACI&Oacute;N: '.$setReserva.'<br>
		            		TOTAL A PAGAR: $'.number_format($pagoHotel, 2, '.', ',').' '.$currency.'<br> 
		            		Impuestos incluidos<br><br>
		            		<b>Nombre: </b>'.$nombre.' '.$apellidos.'<br>
		            		'.$detalles.'<br>
	                        <b>Reservaci&oacute;n (pago a la llegada)</b><br><br>
	                        Muchas gracias por reservar con nosotros. Por favor imprima este correo y tra&iacute;galo con usted junto con una identificaci&oacute;n v&aacute;lida con fotograf&iacute;a. Es necesario pagar la totalidad de la reservaci&oacute;n a su llegada.<br><br>
	                        Para cualquier pregunta referente a su reservaci&oacute;n favor de contactarnos.<br>
	                        Llamada sin costo al: 01 800 711-15-31 (M&eacute;xico)<br>
	                        Tel&eacute;fono: +52 (998) 8881 65 00<br>
	                        Fax: +52 (998) 884 83 76<br>
		                </div>
		            </td>
		          </tr>
		          <tr>
		            <td colspan="2">
		                <table>
		                    <tr>
		                        <td style="float: left;" width="100" height="75px">&nbsp;
		                            
		                        </td>
		                        <td style="float: left;" width="160">
		                            <a style=" text-decoration: none; color: #000; margin-top: 20px; display: block;" href="https://www.facebook.com/HotelAdharaCancun" target="_blank">
		                                <img src="https://adharacancun.com/img/mail/icon_fb.jpg" style="float: left; margin:0 auto;" height="" align="top" width="">
		                                <span style="font-size: 12px; margin-top: 8px; float: left; vertical-align:top;">HotelAdharaCancun</span>
		                            </a>
		                        </td>
		                        <td style="float: left;" width="160">
		                            <a style=" text-decoration: none; color: #000; margin-top: 20px; display: block;" href="https://twitter.com/adharacancun" target="_blank">
		                                <img src="https://adharacancun.com/img/mail/icon_tw.jpg" style="float: left; margin:0 auto;" height="" align="top" width="">
		                                <span style="font-size: 12px;  margin-top: 8px; float: left; vertical-align:top;">@AdharaCancun</span>
		                            </a>
		                        </td>
		                        <td style="float: left;" width="160">
		                            <a style=" text-decoration: none; color: #000; margin-top: 20px; display: block;" href="https://www.instagram.com/explore/locations/257244026/" target="_blank">
		                                <img src="https://adharacancun.com/img/mail/icon_insta.jpg" style="float: left; margin:0 auto;" height="" align="top" width="">
		                                <span style="font-size: 12px;  margin-top: 8px; float: left; vertical-align:top;">AdharaCancun</span>
		                            </a>
		                        </td>
		                    </tr>
		                </table>
		            </td>
		          </tr>
		          <tr>
		            <td colspan="2" height="40" style="background:#000" >
		                <p style="text-align: center; height:20px; color: #ffffff; font-size: 12px; width:100%; background:#000000; margin:0px;">Adhara Cancun, Copyright 2016</p>
		            </td>
		          </tr>
		        </table>
			</body>
		</html>';
		$mailenviado = 0;
		$mailSubject  =  "Reservacion Adhara";  // mensaje Subject
		$mailFromName = "Hotel Adhara Cancun"; // Nombre del remitente
		$to = $email;
		$mail1="reservaciones@gphoteles.com ";
		$mail2="asistente1.reservaciones@gphoteles.com ";
		$mail4="reservaciones3@gphoteles.com";
		
		$mail = new PHPMailer(true);
		try {
			
			$mail->Username = 'noreply@animate.adharacancun.com';
			$mail->Password = 'Na_xJiira3$.';
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 587;  
			$mail->setFrom('noreply@animate.adharacancun.com',$mailFromName);
			$mail->AddAddress($to);
			$mail->addBCC($mail1);
			$mail->addBCC($mail2);
			$mail->addBCC($mail4);
			
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true);       // send as HTML
			$mail->Subject  =  $mailSubject;
			$mail->Body    =  $mensaje;
		    return $mailenviado = (!$mail->Send()) ? 0 : 1;
	    } catch (Exception $e) {
			echo "ERROR FATAL: ".$e;	
		}
	}

	public function paypalConfirm($filename,$item_number,$ciudad,$pais,$email,$total,$detalles,$payer_email){
		$mensaje     = "<HTML>
		<BODY>
		<img src='https://adharacancun.com/img/logotipo.png' /><br>
		<font face='Arial, Helvetica, sans-serif'>";
		$mensaje = $mensaje."<p><strong>RESERVACION HOTEL ADHARA CANCÚN</strong></p>
		<p><strong>ID: ".$item_number."</strong></p>";
		$mensaje = $mensaje."<p>";
		$mensaje = $mensaje."<strong>Cliente: </strong>".$cliente."<br>
		<strong>Ciudad:</strong> ".$ciudad."<br>
		<strong>Pais:</strong> ".$pais."<br>
		<strong>Email:</strong> ".$email."<br>
		<strong>Total:</strong> ".$total."<br>
		<br>";
		$mensaje = $mensaje.$detalles."<br><br>";
		$mensaje = $mensaje."</p><hr>";
		$mensaje = $mensaje."</font></BODY></HTML>";

		$mailSubject  =  "Reservacion PAYPAL - ".$item_number;  // mensaje Subject
		$mailFromName = "Adhara Reservaciones"; // Nombre del remitente
		$emailinterno="reservaciones@adharacancun.com";
		$mimail="programacionweb@gphoteles.com";
		$mail1="reservaciones@gphoteles.com ";
		$mail2="asistente1.reservaciones@gphoteles.com "; 
		$mail3="gerenteenturno@gphoteles.com";
		$mail = new PHPMailer(true);
		
		try {
			
			$mail->isSMTP(); // send via SMTP
			$mail->Host     = 'okcloud.arvixecloud.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'noreply@animate.adharacancun.com';
			$mail->Password = 'Na_xJiira3$.';
			$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port       = 587;  
			$mail->setFrom('noreply@animate.adharacancun.com',$mailFromName);
			$mail->AddAddress($payer_email); 
			$mail->addBCC($emailinterno); 
			$mail->addBCC($mimail); 
			$mail->addBCC($mail1); 
			$mail->addBCC($mail2); 
			$mail->addBCC($mail3); 
			$mail->WordWrap = 50;     // set word wrap
			$mail->IsHTML(true);     // send as HTML
			$mail->Subject  =  $mailSubject;
			$mail->Body    =  $mensaje;
			if(!$mail->Send()){

				$message = "\nError al enviar el correo: ".$mail->ErrorInfo."\n";
				file_put_contents ($filename,$message ,FILE_APPEND); 

			}else{
				$message = "\nEl correo se envió correctamente.\n";
				file_put_contents ($filename,$message ,FILE_APPEND); 
			}
		} catch (Exception $e) {
			echo "ERROR FATAL: ".$e;
		}
	}
}

?>