<?php
session_start();
$root = $_SERVER['HTTP_REFERER'];
include "conexion.php";
//include ($root . "crearLogs.php");


$codigoUpi = $_POST['upi'];
$matriz = $_POST['matriz'];
$anio = $_POST['anio'];
$mes = $_POST['mes'];
$id = $_SESSION['idusuario'];

$query = "SELECT * FROM documentos 
		WHERE id_upi =" . $codigoUpi . 
		" AND id_matriz =" . $matriz .
		" AND anio =" . $anio .
		" AND estado = 1 " .
		" AND id_mes =" . $mes .
		" GROUP BY nombre_archivo";
$result = mysqli_query($conexion, $query);
$mensaje = "<h3>Consulta Archivos</h3>
			<table>";
$mensaje1 = "<h3>Links de los Archivos</h3>
			<table>";
$contador = 0;
$numFilas = mysqli_num_rows($result);
if($numFilas > 0)
{
	while($row = mysqli_fetch_row($result))
	{
		/*
		*	rows:
		*	0: id
		*	1: id_UPI
		*	2: id_matriz
		*	3: id_usuario
		*	4: nombre_archivo
		*	5: anio (año)
		*	6: id_mes
		*	7: ubicacion
		*	8: link_generado
		*	9: estado
		*/
		$contador++;

		if(strlen($row[4]) > 50)
		{
			$mensaje = $mensaje . "<tr><td>" . $contador . "</td><td id=\"archivoSubido" . $contador . "\" class=\"estiloLink\">" . $row[4] . "</td><td><a href=\"" . $row[8] . "\" target=\"_blank\">Ver Link</a></td><td><button class=\"archivos\" id=\"botonArchivo" . $contador . "\" name=\"botonArchivo" . $contador . "\" onclick=\"borrarArchivo('botonArchivo" . $contador ."');\">Borrar Archivo</button></td></tr>";	
		}
		else
		{
			$mensaje = $mensaje . "<tr><td>" . $contador . "</td><td id=\"archivoSubido" . $contador . "\" >" . $row[4] . "</td><td><a href=\"" . $row[8] . "\" target=\"_blank\">Ver Link</a></td><td><button class=\"archivos\" id=\"botonArchivo" . $contador . "\" name=\"botonArchivo" . $contador . "\" onclick=\"borrarArchivo('botonArchivo" . $contador ."');\">Borrar Archivo</button></td></tr>";
		}
		
		$mensaje1 = $mensaje1 . "<tr><td>" . $contador ."</td><td class=\"estiloLink\">" . $row[8] ."</td></tr>";

		//echo "va a entrar a logs";
		try
		{
			$art = logs($query, $id, true, $conexion);	
			//echo $art . "///////////<br>";
		}
		catch(Exception $e)
		{
			echo "error al generar el log";	
		}
		
		
		
	}
	
}
else
{
	$mensaje = $mensaje . "<tr><td>No existen archivos subidos.</td></tr>";
	$mensaje1 = $mensaje1 . "<tr><td>No existen links asociados.</td></tr>";
}

$mensaje = $mensaje . "</table>";
$mensaje1 = $mensaje1 . "</table>";
echo $mensaje;
echo $mensaje1;
//echo $query;
//echo $numFilas . "XXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
?>