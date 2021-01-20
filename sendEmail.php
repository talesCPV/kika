<?php

	function smtpmailer( $para, $de_nome, $assunto, $corpo) { 
		include "./assets/class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsSMTP();		// Ativar SMTP
		$mail->SMTPDebug = 1;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;		// Autenticação ativada
		$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
		$mail->Host = 'br610.hostgator.com.br';	// SMTP utilizado
		$mail->Port = 465;  		// A porta 465 deverá estar aberta em seu servidor
		$mail->Username = 'noreply@flexibus.com.br';
		$mail->Password = 'Flex1234#';
		$mail->SetFrom('noreply@flexibus.com.br', $de_nome);
		$mail->Subject = $assunto;
		$mail->Body = $corpo;
		$mail->AddAddress($para);
		if(!$mail->Send()) {
			print "erro ".$mail->ErrorInfo;
			return 'Houve um erro no envio, favor tentar mais tarde: '.$mail->ErrorInfo; 
		} else {
			print "Email enviado com sucesso";
			return true;
		}
	}


//	smtpmailer("tales@flexibus.com.br", "cliente", "assunto", "Mensagem");



	if(isset($_POST["body"]) && isset($_POST["cli"]) && isset($_POST["email"])){

		$mensagem = $_POST["body"];
		$subject = "Cartas Selecionadas de ".$_POST["cli"];
		$email = $_POST["email"];
		$name = $_POST["cli"];
		smtpmailer($email, $name, $subject, $mensagem);

	}else{

		print (" Algum erro nos dados enviados. ");
		
	}


?>