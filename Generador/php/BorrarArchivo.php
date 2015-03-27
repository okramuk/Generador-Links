<?php
include "conexion.php";
session_start();
$codigoUpi = $_POST['upi'];
$matriz = $_POST['matriz'];
$anio = $_POST['anio'];
$mes = $_POST['mes'];
$nombreArchivo = $_POST['nombreArchivo'];
$id = $_SESSION['idusuario'];

$host = "../archivos/";
$ruta = "";
$ruta = $host . $anio . "/" . $mes . "/" . $codigoUpi . "/" . $nombreArchivo;
$mensaje = "";
try
{
	unlink($ruta);
	$query = "UPDATE documentos SET estado = 2 WHERE nombre_archivo = '" . $nombreArchivo . "' AND id_UPI=" . $codigoUpi . " AND id_matriz=" . $matriz . " AND anio=" . $anio . " AND id_mes=" . $mes;
	$result = mysqli_query($conexion, $query);
	$mensaje = $nombreArchivo;
	$art = logs($query, $id, true, $conexion);
}
catch(Exception $e)
{
	echo "Error en el borrado del archivo";
}
echo $mensaje;
?>