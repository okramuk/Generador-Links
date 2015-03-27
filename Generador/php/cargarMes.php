<?php
include "conexion.php";

$query = "SELECT * FROM mes";	

$result = mysqli_query($conexion, $query);

$message = "";
$myDate = getdate(date("U"));
$mes = $myDate[month];
$mesNum = 0;
switch ($mes) {
	case 'January':
		# code...
		$mesNum = 1;
		break;
	case 'February':
		# code...
		$mesNum = 2;
		break;
	case 'March':
		# code...
		$mesNum = 3;
		break;
	case 'April':
		# code...
		$mesNum = 4;
		break;
	case 'May':
		# code...
		$mesNum = 5;
		break;
	case 'June':
		# code...
		$mesNum = 6;
		break;
	case 'July':
		# code...
		$mesNum = 7;
		break;
	case 'August':
		# code...
		$mesNum = 8;
		break;
	case 'September':
		# code...
		$mesNum = 9;
		break;
	case 'October':
		# code...
		$mesNum = 10;
		break;
	case 'November':
		# code...
		$mesNum = 11;
		break;
	case 'December':
		# code...
		$mesNum = 12;
		break;
	
}
while($row = mysqli_fetch_row($result))
{
	if($mesNum == $row[0])
		$message = $message . "<option value=\"" . $row[0] . "\" selected>" . $row[1] ."</option>";
	else	
		$message = $message . "<option value=\"" . $row[0] . "\">" . $row[1] ."</option>";
}
echo $message;
?>