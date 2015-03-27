<?php
include '../../php/conexion.php';
session_start();

$codigoUpi = $_POST['codigoUpi'];
$id = $_SESSION['idusuario'];


$query = "SELECT * FROM usuarios WHERE habilitado = 1 AND codigo_upi =" . $codigoUpi;

$result = mysqli_query($conexion, $query);

$numFilas = mysqli_num_rows($result);
//echo $numFilas . "--------------";
$mensaje = "<h3>Usuarios Creados</h3>
			<table>";
$contador = 0;
if($numFilas > 0)
{
	$art = logs($query, $id, true, $conexion);
	while($fila = mysqli_fetch_row($result))
	{
		$contador++;
		$mensaje = $mensaje . "<tr><td>" . $contador ."</td><td>" . $fila[2] . " " . $fila[3] . "</td><td><button id=\"verPerfil\" onclick=\"verPerfil(" . $fila[0] .");\">Ver Pefil</button></td></tr>";

		
	}
}
else
{
	$mensaje = $mensaje . "<tr><td>No existen usuarios creados para la UPI seleccionada</td></tr>";
}

$mensaje = $mensaje . "</table>";
echo $mensaje;
?>