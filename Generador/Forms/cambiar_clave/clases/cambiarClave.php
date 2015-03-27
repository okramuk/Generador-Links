<?php
session_start();
$s=session_name();
include '../../../lib/dbconfig.php';
include "../../../clases/cerrar_sesion.php";

//echo "session(username)=".$_SESSION["username"]. " ,password= ".$_SESSION["password"]."<br>";
$_SESSION["password"] = $pwd;

if ($accion=="cambiarClave")
{
	//echo $accion.' , '.$old_passwd.' , '.$new_passwd.' , '.$new_passwd_confirm.' , '.$_SESSION["password"].'<br>';
		//echo $accion.' , '.md5($old_passwd).' , '.$new_passwd.' , '.$new_passwd_confirm.' , '.$_SESSION["password"].'<br>';

		if(md5($old_passwd) == md5($_SESSION["password"]))
		{

			if($new_passwd==$new_passwd_confirm)
			{
				//$actualiza="update usuario set password = '".md5($new_passwd)."' where	user_name = '".$_SESSION["username"]."'";
				//$actualiza="update usuario set password='".md5($new_passwd)."', ingreso = 1 where cod_usuario='".$_SESSION["cod_usuario"]."'";
				$actualiza = "UPDATE usuarios SET password = '" . $new_passwd . "', ingreso = 1 WHERE usuario='" . $_SESSION['usuario'] . "'";
				
				if(query($actualiza))
				{	
					//echo $actualiza;
					cambioClaveCorrecto("La clave ha sido cambiada satisfactoriamente.");
					//session_destroy(); // destruyo la sesión
				}
			}
			else
			{
				daFormulario("La nueva clave no coincide.",$_SESSION["password"]);
			}
		}
		else
		{
			//$funcio = $_SESSION["password"];
			daFormulario("La clave anterior es incorrecta.",$_SESSION["password"]);
		}
}

function cambioClaveCorrecto($mensaje)
{
	//echo 'cambioClaveCorrecto='.$mensaje.' , '.$type_user;
	
echo'<div id="DivTablaFormulario" align="center" style="background-image:url(../../images/cambio_clave.jpg); background-repeat:no-repeat; background-position:center;>
	<form method="post" name="form1" >
	 	<table border="1" height="100">
	 		<tr>
				<td align="center"><strong><font face="Arial, Helvetica, sans-serif">CAMBIO DE CLAVE</font></strong></td>
			</tr>
			<tr height="30">
				<td></td>
			</tr>
			<tr height="30">
				<td></td>
			</tr>
			<tr height="30">
				<td></td>
			</tr>
			<tr>
				<td><center><input name="salir" type="button" value="Salir" onClick="regresar();"></center></td>
			</tr>
			<tr>
				<strong><font color="#0000FF" face="Arial, Helvetica, sans-serif"><b>'.$mensaje.'</b></font></strong></td>
			</tr>
		</table>
	</form>
</div>';
}


function daFormulario($mensaje,$funcio)
{
	//echo 'daFormulario='.$mensaje.' , '.$type_user;
	echo '<div id="DivTablaFormulario" align="center" style="background-image:url(../../images/Icono_usuario.jpg); background-repeat:no-repeat; background-position:center; >
	<form name="form1" method="post" >
	<table border="1">
	<tr>
		<td colspan="2" align="center"><strong><font color="#FF0000" size="+2" face="Arial, Helvetica, sans-serif">CAMBIO DE CLAVE</font></strong></td>
	</tr>
	<tr>
		<td><strong><font color="#0000FF" face="Arial, Helvetica, sans-serif">Ingrese su clave anterior:</font></strong></td>
		<td><input name="old_passwd"  id="old_passwd" type="password" size="20" maxlength="20"></td>
	</tr>
	<tr>
		<td><strong><font color="#0000FF" face="Arial, Helvetica, sans-serif">Ingrese la nueva clave:</font></strong></td>
		<td><input name="new_passwd" id="new_passwd" type="password"  size="20" maxlength="20"></td>
	</tr>
	<tr>
		<td><strong><font color="#0000FF" face="Arial, Helvetica, sans-serif">Confirme la nueva clave:</font></strong></td>
		<td><input name="new_passwd_confirm" id="new_passwd_confirm" type="password" size="20" maxlength="20"></td>
	</tr>
	<tr>
		<td colspan="2"><center><input name="clave" type="button" value="Cambiar Clave" onClick="cambiarClave2()"></center></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input name="pwd" id="pwd" type="hidden" value="'.$funcio.'" </td>
		<strong><font color="red" face="Arial, Helvetica, sans-serif">'.$mensaje.'</font></strong></td>
	</tr>
	
	</table>
	</form></div>';
}

?>