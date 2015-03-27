<?php
include "../../php/conexion.php";
session_start();
$codigoUser = $_POST['codigoUser'];

$id = $_SESSION['idusuario'];
//$fechaRegistro = date('Y-m-d');
$tipoUsuario = $_POST['tipoUsuario'];

$consulta = "SELECT * FROM usuarios WHERE id = " . $codigoUser;
$res = mysqli_query($conexion, $consulta);
$nombreUsuario = "";

while($row = mysqli_fetch_row($res))
{
	$nombreUsuario = $row[2] . " " . $row[3];
}


$query = "UPDATE usuarios SET habilitado = 0 WHERE id = " . $codigoUser;

try
{
	$result = mysqli_query($conexion, $query);
	$art = logs($query, $id, true, $conexion);
	echo "Se borró la cuenta: " . $nombreUsuario;
}
catch(Exception $e)
{
	echo "Error al modificar el usuario";
}
?>