<?php
include "conexion.php";

$query = "SELECT * FROM anio  ORDER BY anio.anio DESC";	

$result = mysqli_query($conexion, $query);

$message = "";
while($row = mysqli_fetch_row($result))
{
	$message = $message . "<option value=\"" . $row[1] . "\">" . $row[1] ."</option>";
}

echo $message;
?>