<?php

	function smtpmailer($user, $pass, $para, $de, $de_nome, $assunto, $corpo) { 
		$mail = new PHPMailer();
		$mail->IsSMTP();		// Ativar SMTP
		$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
		$mail->SMTPAuth = true;		// Autenticação ativada
		$mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
		$mail->Host = 'mail.flexibus.com.br';	// SMTP utilizado
		$mail->Port = 465;  		// A porta 465 deverá estar aberta em seu servidor
		$mail->Username = $user;
		$mail->Password = $pass;
		$mail->SetFrom($de, $de_nome);
		$mail->Subject = $assunto;
		$mail->Body = $corpo;
		$mail->AddAddress($para);
		if(!$mail->Send()) {
			return 'Houve um erro no envio, favor tentar mais tarde: '.$mail->ErrorInfo; 
		} else {
			return true;
		}
	}



	require_once("./assets/class.phpmailer.php");

	smtpmailer('noreply@flexibus.com.br', 'Flex1234#', 'tales@flexibus.com.br', 'tales@flexibus.com.br', 'Tales C. Dantas', 'Email teste', 'blablabla blobloblo');


/*
	if(isset($_POST["body"]) && isset($_POST["cli"])){
		$host = "mail.flexibus.com.br"; 
		$usuario = 'noreply@flexibus.com.br';
		$senha = 'Flex1234#';

		$mensagem = $_POST["body"];
		$subject = "Cartas Selecionadas de ".$_POST["cli"];
		$email = $usuario;
		$fromaddr = "tales@flexibus.com.br";
		$name = $_POST["cli"];



		//	echo('usuario:'.$usuario.' senha:'.$senha.' para:'.$fromaddr.' de:'.$email. ' nome:'.$name.' assunto:'.$subject.' mss:'.$mensagem);
		smtpmailer($usuario, $senha, $fromaddr, $email, $name, $subject, $mensagem);
	}
*/

?>