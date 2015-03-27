<?php
include "../../php/conexion.php";
session_start();
$codigoUser = $_POST['codigoUser'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$mail = $_POST['mail'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$id = $_SESSION['idusuario'];
//$fechaRegistro = date('Y-m-d');
$tipoUsuario = $_POST['tipoUsuario'];


$query1 = "SELECT * FROM usuarios WHERE usuario = '" . $usuario . "' AND habilitado=1";
$res = mysqli_query($conexion, $query1);
$numFilas = mysqli_num_rows($res);
if($numFilas > 0)
{
	$query = "UPDATE usuarios SET nombres ='" . $nombres . "', apellidos ='" . $apellidos ."', mail = '" . $mail ."', usuario = '" . $usuario ."', password = '" . $password ."', tipo_usuario=" . $tipoUsuario . 
		" WHERE id=" . $codigoUser;

	try
	{
		$result = mysqli_query($conexion, $query);
		$art = logs($query, $id, true, $conexion);
		echo "Se modifico la cuenta: " . $usuario;
	}
	catch(Exception $e)
	{
		echo "Error al modificar el usuario";
	}	
}

?>