<?php
include "conexion.php";
$codigoUpi = $_POST['upi'];

$query = "SELECT * FROM matrices 
		INNER JOIN upi_matrices ON (matrices.id = upi_matrices.id_matrices)
		INNER JOIN upi ON (upi_matrices.id_upi =" . $codigoUpi . ") 
		GROUP BY matrices.id";
$result = mysqli_query($conexion, $query);
$mensaje = "<option value=\"0\" selected>Seleccione una matriz</option>";

while($row = mysqli_fetch_row($result))
{
	$mensaje = $mensaje . "<option value=" . $row[0] . ">" . $row[1] ."</option>";
}
echo $mensaje;
?>