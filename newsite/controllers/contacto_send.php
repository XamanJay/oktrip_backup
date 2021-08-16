 <?php


 if($_POST){
 	if(isset($_POST["nombre"]) &&isset($_POST["email"]) &&isset($_POST["telefono"])&&isset($_POST["pais"])&&isset($_POST["ciudad"]))
 	{

 		try {

 			include_once("/class.phpmailer.php");

 			$reserva = "ninguno";
 			$mensaje = "ninguno";
 			if (isset($_POST['reserva'])) {
 				
 				$reserva = $_POST['reserva'];
 			}
 			if (isset($_POST['mensaje'])) {
 				
 				$mensaje = $_POST['mensaje'];
 			}


			$Host = "mail.oktravel.mx";
			$From = "info@oktravel.mx";
			$Username = "info@oktravel.mx";
			$Password = "q4t?)TyGX0y!";
			$Subject  =  "Mensaje de Contacto Oktrip";
			$FromName = "Oktrip";
			$To = "fabiola@oktravel.mx";

			$Message = "<!DOCTYPE html>
			<html>
			<head>
				<title>Mensaje Contacto</title>
				<meta charset='UTF-8'>
			</head>
			<body style='font-family: sans-serif;'>
				<div style='width: 400px;'>
					<p>Nombre: ".$_POST['nombre']."</p>
					<p>Email: ".$_POST['email']."</p>
					<p>Ciudad: ".$_POST['ciudad']."</p>
					<p>Pais: ".$_POST['pais']."</p>
					<p>Telefono: ".$_POST['telefono']."</p>
					<p>ID Reserva: ".$reserva."</p>
					<p>Mensaje: ".$mensaje."</p>
				</div>
			</body>
			</html>
			";

			$mail = new PHPMailer();
			$mail->SetLanguage('en');
			$mail->IsSMTP();
			$mail->Host     = $Host;
			$mail->SMTPAuth = true;
			$mail->Username = $Username;
			$mail->Password = $Password;
			$mail->From     = $From;
			$mail->FromName = $FromName;
			$mail->AddAddress($To);
			$mail->WordWrap = 50; 
			$mail->IsHTML(true);  
			$mail->Subject = $Subject;
			$mail->Body = $Message;
			$mail->Send();

			echo json_encode(array("type" => "success" , "message" => "Su mensaje se envio exitosamente!!" ));

 		} catch (Exception $e) {
 			echo json_encode(array("type" => "error" , "message" => "Hubo un problema al enviar su mensaje." ));
 			return false;
 		}
 	}

 }
 ?>