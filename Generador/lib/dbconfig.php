<?php
$dbhost="10.2.74.50";  // host del MySQL (generalmente localhost)
$db="generadorlinks";        // Seleccionamos la base con la cual trabajar
$dbusuario="root"; // aqui debes ingresar el nombre de usuario
$dbpassword="namd0gma1"; // password de acceso para el usuario de la
$conexion = mysql_connect($dbhost, $dbusuario, $dbpassword);
mysqli_set_charset($conexion,"utf8");

mysql_select_db($db, $conexion);
	//Conexión a la BDD del sistema de Conciliación
	function query($sql)
	{
		$server = "10.2.74.50";//Dirección del servidor
		$basedatos = "generadorlinks";//Base de datos a ser utilizada
		$user = "root"; //usuario
		$pass = "namd0gma1";//namd0gma1
		$connect = mysql_connect($server, $user, $pass);//Establesco la conexión al servidor de la BDD
		mysql_set_charset($connect,"utf8");
		mysql_select_db ($basedatos, $connect);//Selecciono la BDD
		$result=mysql_query ($sql,$connect);//Realizo el query		
		return ($result);//Retorno el resultado del query
	}
	
?>