<?php
session_start();
$s=session_name();
include '../../lib/dbconfig.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Cambiar Clave</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script type="text/javascript" src="js/cambiarClave.js"></script>

<body>
<div id="DivTablaFormulario" align="center" style="background-image:url(../../images/Icono_usuario.jpg); background-repeat:no-repeat; background-position:center; opacity:80); ">
<form name="form1" method="post" >
<table border="1">
<tr>
	<td colspan="2" align="center"><strong><font color="#FF0000" size="+2" face="Arial, Helvetica, sans-serif">CAMBIO DE CLAVE</font></strong></td>
</tr>
<tr>
	<td><strong><font color="#0000FF" face="Arial, Helvetica, sans-serif">Ingrese su clave anterior:</font></strong></td>
	<td><input name="old_passwd" type="password" size="20" maxlength="20" value=""></td>
</tr>
<tr>
	<td><strong><font color="#0000FF" face="Arial, Helvetica, sans-serif">Ingrese la nueva clave:</font></strong></td>
	<td><input name="new_passwd" type="password" size="20" maxlength="20"></td>
</tr>
<tr>
	<td><strong><font color="#0000FF" face="Arial, Helvetica, sans-serif">Confirme la nueva clave:</font></strong></td>
	<td><input name="new_passwd_confirm" type="password" size="20" maxlength="20"></td>
</tr>
<tr>
<?php
	echo '<td colspan="2"><input name="pwd" id="pwd" type="hidden" value="'.$_SESSION["password"].'" </td>'
?>
</tr>

<tr>
	<td colspan="2"><center><input name="clave" type="button" value="Cambiar Clave" onClick="cambiarClave(document.form1.old_passwd.value, document.form1.new_passwd.value, document.form1.new_passwd_confirm.value)"></center></td>
</tr>
</table>
</form>
</div>
</body>
</html>
