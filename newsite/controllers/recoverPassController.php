<?php 

require(realpath($_SERVER['DOCUMENT_ROOT'])."/models/db.php");
require(realpath($_SERVER['DOCUMENT_ROOT'])."/class.phpmailer.php");


if ($_POST) {
	if (isset($_POST['correoPass'])) {
		
		try {

			$db = new db();
			$conn = $db->conn_local_clubestrella();
			$query = "SELECT AES_DECRYPT(Password,'test')  FROM users WHERE Email = ?;";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$_POST['correoPass']);
			$stmt->execute();
			$count = $stmt->rowCount();
			if ($count > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$recoveryPass=$row["AES_DECRYPT(Password,'test')"];

				$Host = "mail.oktravel.mx";
				$From = "info@oktravel.mx";
				$Username = "info@oktravel.mx";
				$Password = "q4t?)TyGX0y!";
				$Subject  =  "Recuperacion de Password Clubestrella";
				$FromName = "Clubestrella";
				$To = $_POST['correoPass'];
				//$To = "juan.alucard.02@gmail.com";

				$Message = "<!DOCTYPE html>
				<html>
				<head>
					<title>clubestrella</title>
					<meta charset='UTF-8'>
				</head>
				<body style='font-family: sans-serif;'>
					<div style='width: 400px;'>
						<p>
						<h4 style='text-align: center; width: 100%;'>Recuperacion de Contraseña</h4>
						</p>
						<p>
							Su Password es: ".$recoveryPass."
						</p>
						
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

				echo 1;
				
			}
			else{
				echo 0;
			}

		} catch (Exception $e) {
			echo "Error al recuperar la contraseña";
			print_r($e);
		}
	}
}

?>