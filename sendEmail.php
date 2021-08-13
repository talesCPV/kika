<?php
	ini_set('error_reporting', E_ALL); // mesmo resultado de: error_reporting(E_ALL);
	ini_set('display_errors', 1);


	function smtpmailer( $para, $de_nome, $assunto, $corpo) { 
		$mail = new PHPMailer();
		$mail->IsSMTP();		// Ativar SMTP
		$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;		// Autenticação ativada
		$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
		$mail->Host = 'mylastpixel.com';	// SMTP utilizado
		$mail->Port = 465;  		// A porta 465 deverá estar aberta em seu servidor
		$mail->Username = 'noreply@mylastpixel.com';
		$mail->Password = 'Kika1990#';
		$mail->SetFrom('noreply@mylastpixel.com', $de_nome);
		$mail->Subject = $assunto;
		$mail->Body = $corpo;
		$mail->AddAddress($para);
		if(!$mail->Send()) {
			echo "erro ".$mail->ErrorInfo;
			return 'Houve um erro no envio, favor tentar mais tarde: '.$mail->ErrorInfo; 
		} else {
			echo "Email enviado com sucesso";
			return true;
		}

		echo "depois";
	}

		require_once("./assets/class.phpmailer.php");

//	smtpmailer("tales@flexibus.com.br", "cliente", "assunto", "Mensagem");



	if(isset($_POST["body"]) && isset($_POST["cli"]) && isset($_POST["email"]) && isset($_POST["assunto"])){

		$mensagem = $_POST["body"];
		$subject = $_POST["assunto"];		
		$email = $_POST["email"];
		$name = $_POST["cli"];
		smtpmailer($email, $name, $subject, $mensagem);

	}else{

		print (" Algum erro nos dados enviados. ");
		
	}


//	smtpmailer("talescd@gmail.com", "Tales", "Assunto", "Mensagem");

?>