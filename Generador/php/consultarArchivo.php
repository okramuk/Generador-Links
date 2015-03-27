<?php
include "conexion.php";
session_start();
$codigoUpi = $_POST['upi'];
$matriz = $_POST['matriz'];
$anio = $_POST['anio'];
$mes = $_POST['mes'];
$id = $_SESSION['idusuario'];
$mensaje = "Desea sobreescribir los archivos:\n";
$contador = 0;

foreach ($_FILES as $key) 
{
	$ruta = "../archivos/";
	$nombreOriginal = $key['name'];
	$temporal = $key['tmp_name'];

	$query = "SELECT * FROM documentos WHERE id_UPI = " . $codigoUpi . " AND id_matriz =" . $matriz . " AND anio=" . $anio . " AND id_mes=" . $mes . " AND estado=1 AND nombre_archivo = '" . $nombreOriginal . "'";

	$result = mysqli_query($conexion, $query);
	$numFilas = mysqli_num_rows($result);

	if($numFilas > 0)
	{
		$contador++;
		$mensaje = $mensaje . $nombreOriginal ."\n";
	}

	
}

if($contador > 0)
{
	echo $mensaje;
}
else
{
	echo $contador;
}

?>