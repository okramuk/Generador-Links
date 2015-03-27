<?php
include "../lib/dbconfig.php";
//include("../lib/dbremota.php");

session_start(); 
$username=$_POST['username'];
$password=$_POST['password'];
//echo "Hola:".$username."---".md5($password);

/*$conex_remota = conectar(); 
if (!($conex_remota))
{ 
   echo"<script language=javascript>
       alert('No existe Conexion al Servidor Intentelo mas tarde!!!.') 
</script>";
   exit();
}*/

/*$consulta="select u.cod_usuario, u.cod_tipo_usuario, u.nombre_usuario, u.user_name, u.password , t.usuario as tipo_usuario,u.cod_provincia
           from usuario u inner join tipo_usuario t  on (u.cod_tipo_usuario = t.cod_tipo_usuario) 
			where u.user_name='".$username."' and u.password='".md5($password)."'";*/
$consulta = "SELECT u.codigo_upi, u.usuario, u.password, u.tipo_usuario, t.tipo_usuario, u.nombres, u.apellidos, u.ingreso, u.id 
			FROM usuarios u 
			INNER JOIN tipo_usuario t on (u.tipo_usuario = t.id and u.usuario = '" . $username . "' AND u.password = '" . $password . "') 
			group by t.id";
			
	echo $consulta."<br>";
	$result=query($consulta);
	//Si no se autoriza el ingreso regresa a la pantalla de validación
	if(!isset($result))
	{
		
		header('Location: ../../index.html');
	}
	
	else
	{
		$numFilas = mysql_num_rows($result);
		if($numFilas < 1 || $numFilas > 1)
		{
			header('Location: ../index.html');
		}
		else
		{
			/* row:
			*	0: codigo_upi
			*	1: usuario
			*	2: password
			*	3: tipo_usuario
			*	4: tipo_usuario
			*	5: nombres
			*	6: apellidos
			*	7: ingreso
			*	8: id(usuario)
			*/
			while($fila=mysql_fetch_row($result))
			{	
				$_SESSION['usuario'] = $fila[1];
				$_SESSION['codigoUpi'] = $fila[0];
				$_SESSION['password'] = $fila[2];
				$_SESSION['codigoTipoUsuario'] = $fila[3];
				$_SESSION['tipo_usuario'] = $fila[4];
				$_SESSION['nombres'] = $fila[5];
				$_SESSION['apellidos'] = $fila[6];
				$_SESSION['ultimoacceso'] = date("Y-n-j H:i:s");
				$_SESSION['idusuario']	= $fila[8];
				$ingreso = $fila[7];
							
			}
			if($ingreso == 0)
			{
				header('Location: ../Forms/cambiar_clave/clave.php');
			}
			else
			{
				header('Location: ../menu/mainMenu.php');	
			}
			
			
		}
		
	}
?>
