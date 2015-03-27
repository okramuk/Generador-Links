<?php
require("class.phpmailer.php");

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['mail'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$tipoUsuario = $_POST['tipoUsuario'];

echo $nombres . "<br>";
echo $apellidos . "<br>";
echo $mail . "<br>";
echo $usuario . "<br>";
echo $password . "<br>";
echo $tipoUsuario . "<br>";

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 2;
$mail->Mailer="smtp";



$mail->Port = 587;
$mail->Host = "mail.ieps.gob.ec";
$mail->Username = "marco.alvarez@ieps.gob.ec";
$mail->Password = "Mar11alv";

$mail->From = "marco.alvarez@ieps.gob.ec";
//$mail->FromName = "Generador de Links";

$mail->AddAddress($correo, $nombres . " " . $apellidos);

$mail->Subject = "Generador de links - Credenciales";

$body = "<html>
		<head>
			
		    <title>Cuenta de Usuario - Generador de Links</title>
		    <style>
		    	table {
					   width: 100%;
					   border: 1px solid #000;
					}
					th, td {
					   width: 25%;
					   text-align: left;
					   vertical-align: top;
					   border: 1px solid #000;
					   border-collapse: collapse;
					   padding: 0.3em;
					   caption-side: bottom;
					}
					caption {
					   padding: 0.3em;
					   color: #fff;
					    background: #000;
					}
					th {
					   background: #eee;
					}
		    </style>
		</head>
		<body>
			<img src=\"cid:testpicture\">
			<h1>Generador de Links</h1>
			<p>Credenciales de: " . strtoupper($nombres) . " " . strtoupper($apellidos) . "</p>
		    <table>	
		    	<tbody>	        
		        <tr>
		            <td>Usuario</td>
		            <td>Password</td>
		        </tr>
		        <tr>
		            <td>".$usuario."</td>
		            <td>" .$password."</td>
		        </tr>
		        </tbody>			        
		    </table>
		</body>
		</html>";
$mail->AddEmbeddedImage("../images/IEPS-listo.png", "testpicture", "IEPS-listo.png");
$mail->MsgHtml($body);
//echo $mail->ErrorInfo;

if(!$mail->Send())
{
	echo "Mailer error" . $mail->ErrorInfo;
}
else
{
	echo "message send";
}

	


?>