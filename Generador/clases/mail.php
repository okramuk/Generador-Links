<?php
include_once('class.phpmailer.php');

function enviarMailDetalle($mail_custodio,$mail_encargado,$body){
	//echo "enviarMailDetalle= $mail_custodio , $mail_encargado , $body<br>";
	//servidor de correo
	$email_host = "mail.ieps.gob.ec";
	$email_port = 587;
	$email_tipo = "smtp";
	//informacion de la cuenta
	$email_remintente = "transporte@ieps.gob.ec";
	$email_remintente_nombre = "IEPS";
	$email_remintente_usuario = "transporte"; 
	$email_remintente_contrasena = "namd0gma1";
	$email_asunto = "Solicitud de Mantenimiento";
	//bandera
	$bandera = false;
	
	//echo "$email_host , $email_port , $email_tipo , $email_remintente ,	$email_remintente_nombre , $email_remintente_usuario , $email_remintente_contrasena , $email_asunto <br>";

	$mail = new PHPMailer();
	//$body = $mail->getFile('contents.html');
	//$body = eregi_replace("[\]",'',$body);
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Mailer   = $email_tipo;//"smtp";
	$mail->Host     = $email_host;//"mail.ieps.gob.ec"; // SMTP server
	$mail->Port     = $email_port;//587;
	$mail->SMTPAuth = true;
	$mail->Username = $email_remintente_usuario;//"conductores";//"compras"; 
	$mail->Password = $email_remintente_contrasena;//"ieps000"; 
	$mail->From     = $email_remintente;//"conductores@ieps.gob.ec";//"compras@ieps.gob.ec";
	$mail->FromName = $email_remintente_nombre;//"IEPS compras";
	$mail->Subject  = $email_asunto;//"PHPMailer Test Subject via smtp";
	$mail->MsgHTML($body);
		
	$mail->ClearAddresses();	
	
	$mail->AddAddress($mail_custodio, "Custodio");
	$mail->AddAddress($mail_encargado, "Encargado");
	//agrega copia a administradores
	/*if ($email_ieps_recibe01!="") $mail-> AddAddress($email_ieps_recibe01);
	if ($email_ieps_recibe02!="") $mail-> AddAddress($email_ieps_recibe02);*/
	//Adjunta una imagen
	//$mail->AddAttachment("images/phpmailer.gif");   // attachment
		
	if(!$mail->Send()) 
	{
	  echo "Mailer Error: " . $mail->ErrorInfo;
	  $bandera = false;
	} else 
	{
	  echo "Message sent!";
	  $bandera = true;
	}
	
	return $bandera;
}
?>