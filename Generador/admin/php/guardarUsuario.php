<?php
include "../../php/conexion.php";
session_start();
$codigoUpi = $_POST['codigoUpi'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$mail = $_POST['mail'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$fechaRegistro = date('Y-m-d');
$tipoUsuario = $_POST['tipoUsuario'];
$id = $_SESSION['idusuario'];

$query = "SELECT * FROM usuarios WHERE habilitado = 1 AND usuario = '" . $usuario . "'";

$result = mysqli_query($conexion, $query);

$numFilas = mysqli_num_rows($result);

if($numFilas == 0)			//no existen usuarios iguales
{
	$query = "INSERT INTO usuarios (codigo_upi, nombres, apellidos, mail, usuario, password, fecha_registro, tipo_usuario) 
		VALUES (" . $codigoUpi .", '" . $nombres . "', '" . $apellidos . "', '" . $mail . "', '" . $usuario . "', '" . $password . "', '" . $fechaRegistro ."', " . $tipoUsuario . ")";

	try
	{
		$result = mysqli_query($conexion, $query);
		$art = logs($query, $id, true, $conexion);
		echo "Se creo el usuario: " . $usuario;
	}
	catch(Exception $e)
	{
		echo "Error al crear el usuario";
	}

}
else
{
	echo 0;
}
 
?>