<?php
include "conexion.php";
session_start();
$codigoUpi = $_POST['upi'];
$matriz = $_POST['matriz'];
$anio = $_POST['anio'];
$mes = $_POST['mes'];
$id = $_SESSION['idusuario'];

$mensaje = "<h3>Informe</h3>
			<table>";

$mensaje1 = "<h3>Links</h3>
			<table>";

$server = "http://181.112.162.59/Generador/archivos/";
$contador = 0;

//revisamos si la carpeta del año existe
if(!is_dir('../archivos/' . $anio))
{
	//si no existe
	mkdir('../archivos/' . $anio, 0777);
	mkdir('../archivos/' . $anio . '/' . $mes);
	mkdir('../archivos/' . $anio. '/' . $mes . '/' . $codigoUpi, 0777);

}
else
{
	//revisamos si la carpeta del mes existe
	if(!is_dir('../archivos/' . $anio. '/' . $mes))
	{
		mkdir('../archivos/' . $anio. '/' . $mes, 0777);
		mkdir('../archivos/' . $anio. '/' . $mes . '/' . $codigoUpi, 0777);
	}
	else
	{
		if(!is_dir('../archivos/' . $anio. '/' . $mes . '/' . $codigoUpi))
		{
			mkdir('../archivos/' . $anio. '/' . $mes . '/' . $codigoUpi, 0777);
		}
	}
}

foreach ($_FILES as $key) 
{
	$ruta = "../archivos/";
	$nombreOriginal = $key['name'];
	$temporal = $key['tmp_name'];

	
	$ruta = $ruta . $anio. '/' . $mes . '/' . $codigoUpi . '/';
	$destino = $ruta . $nombreOriginal;

	if($key['error'] == UPLOAD_ERR_OK)
	{
		move_uploaded_file($temporal, $destino);
		$contador++;
	}

	if($key['error'] == '')
	{

		$query = "INSERT INTO documentos(id_UPI, id_matriz, id_usuario, nombre_archivo, anio, id_mes, ubicacion, link_generado, estado) " .
				"VALUES (" . $codigoUpi . ", " . $matriz . ", 1, '" . $nombreOriginal . "', " . $anio . ", " . $mes . ", '" . $ruta . $nombreOriginal . "', '" . $server . $anio . "/" . $mes . "/" . $codigoUpi . "/" .$nombreOriginal . "', 1)";
		
		try 
		{
			$res = mysqli_query($conexion, $query);
			$art = logs($query, $id, true, $conexion);
		 	
		} catch (Exception $e) 
		{
			echo "Error al ingresar en la base de datos, tabla Documentos";
		 	
	 	} 

	 	if(strlen($nombreOriginal) > 50)
	 	{
	 		$mensaje = $mensaje . "<tr><td>" . $contador . "</td><td class=\"estiloLink\">" . $nombreOriginal . "</td><td><a href=\"" . $server . $anio . "/" . $mes . "/" . $codigoUpi . "/" . $nombreOriginal . "\" target=\"_blank\">Link</a></td></tr>";
	 	}	 			
	 	else
	 	{
	 		$mensaje = $mensaje . "<tr><td>" . $contador . "</td><td>" . $nombreOriginal . "</td><td><a href=\"" . $server . $anio . "/" . $mes . "/" . $codigoUpi . "/" . $nombreOriginal . "\" target=\"_blank\">Link</a></td></tr>";
	 	}

		$mensaje1 = $mensaje1 ."<tr><td>" . $contador ."</td><td class=\"estiloLink\">" . $server . $anio . "/" . $mes . "/" . $codigoUpi . "/" . $nombreOriginal . "</td></tr>";

	}

	if($key['error'] != '')
		$mensaje = $mensaje . "<tr><td>" . $contador . "</td><td>" . $nombreOriginal . "</td><td><a href=\"#\">Error</a></td></tr>";
}

$mensaje = $mensaje . "</table>";
$mensaje1 = $mensaje1 . "</table>";
echo $mensaje;
echo $mensaje1;
?>