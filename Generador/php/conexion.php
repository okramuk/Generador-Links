<?php
$server = "10.2.74.36";
$user = "root";
$pass = "namd0gma1";
$baseDatos = "generadorlinks";

$conexion = mysqli_connect($server, $user, $pass, $baseDatos) or die("No se puede conectar: " . mysql_error());

if(!isset($conexion))
	echo "fallo en la conexion";
else
	mysqli_set_charset($conexion,"utf8");	


function logs($query, $ci, $type, $con)
{	

	if (buscarEvento($query) || $type == true)
	{
	   //echo "logs = $query , $ci , $type <br>";
	   $xtransaccion = "SELECT * FROM usuarios WHERE id=" . $ci;	  
	   //echo "xtransaccion= $xtransaccion<br>";
	   //HACE UN SUBSTRING DE LOS PRIMEROS 40 CARACTERES
	   //$xtransaccion_old = substr($query, 0, 40).'....';
	   $xtransaccion_old = $query;
	   $remote_addr = $_SERVER['REMOTE_ADDR'];
	   $http_host = $_SERVER['HTTP_HOST'];
	   $http_referer = $_SERVER['HTTP_REFERER'];
	   /***************************inicio programa*********************************/
	   $request_uri = $_SERVER['REQUEST_URI'];
	   /*$posicion_coincidencia = 0;
	   $posicion_coincidencia = strrpos($request_uri, '?');
	   if($posicion_coincidencia > 0)
		   $request_uri = substr($request_uri, 0, $posicion_coincidencia+20).'....';*/		  
	   /****************************fin programa***********************************/
		//path de logs
	   $xcarpetaLogs = 'logs_app_ieps.txt';
	   $posicion_ini = 0;
	   $posicion_fin = 0;
	   $posicion_ini = strpos($_SERVER['PHP_SELF'], '/');
	   $posicion_fin = strpos($_SERVER['PHP_SELF'], '/',$posicion_ini+1);
	   $app_name = substr($_SERVER['PHP_SELF'], $posicion_ini+1, $posicion_fin-1);	
	   //para el servidor windows
	   //$xcarpetaLogs = $_SERVER['DOCUMENT_ROOT']."logs/logs_".$app_name."_ieps.txt";	   
	   //para el servidor linux
	   $xcarpetaLogs = $_SERVER['DOCUMENT_ROOT']."/logs/logs_".$app_name."_ieps.txt";	   
	   
	   //echo "xcarpetaLogs = $xcarpetaLogs<br>"; 	   

	   /*if ($_SERVER['HTTP_HOST'] != '127.0.0.1')
		{
			$xcarpetaLogs = '/var/www/code/libs/logs/';
			$xcarpetaErrs = '/var/www/code/libs/errors/';
		}*/
	   
	   //Ejecutar transaccion
	   $xresult_sql = mysqli_query($con, $xtransaccion);
	   if(isset($xresult_sql))
	   {
		//Registra las variables de la sesiÃ³n y direcciona al menÃº principal
			while($usuario=mysqli_fetch_row($xresult_sql))
			{	
				$cod_usuario=$usuario[0];
				$cod_tipo_usuario=$usuario[8];
				if($cod_tipo_usuario == 1)
					$perfil = "Administrador";
				else
					$perfil = "Registrado";
				
				$nombres_usuario=$usuario[2] . " " . $usuario[3];
				$username=$usuario[5];
				//$_SESSION["password"]=$usuario->password;
			}				
		   //$xlast_error = pg_last_error($xconn);
		   $xfecha = date("Y-m-d");
		   $xhora = date("H:i:s");
		   
		   // Generacion del log
		   $xcadenota =$remote_addr." -- [".date("d/m/Y").":".date("H:i:s")."]";
		   $xcadenota.= ",[usuario:".$cod_usuario."-".$nombres_usuario."]";
		   $xcadenota.= ",[host:".$http_host."]";
		   //$xcadenota.= "\t,CLIENTE:".$_SERVER['REMOTE_ADDR'];
		   $xcadenota.= ",[perfil:".$cod_tipo_usuario."-".$perfil."]";
		   // Coloca el nombre del programa que hizo la llamada al programa que se ejecutï¿½
		   $xcadenota.= ",[llamada:".$http_referer."]"; 
		   // Coloca el nombre del programa que se ejecutï¿½ mï¿½s sus variables trasferidas por la URL
		   $xcadenota.= ",[programa:".$request_uri."]";		  
		   /***********************/
		  //$xcadenota.= ",[xcarpetaLogs:".$xcarpetaLogs."]";
		   /***********************/
		   //if ($xlast_error)
			  //$xcadenota.= "\r\n\t".$xlast_error; // En caso de haber error, coloca el mensaje de error del manejador de la BD
		  // Coloca la transacci?n o la consulta tal cual sucedi? en la BD
		   $xcadenota.= ",[evento:".$xtransaccion_old."]\r\n\r\n"; 
		   //echo $xcadenota . "<br>";
		   //echo $xcarpetaLogs . "<br>";
		   $arch = fopen($xcarpetaLogs, "a+");
		   
		   fwrite($arch, $xcadenota);
		   fclose($arch);
		}
		//echo "xresult_sql = $xresult_sql <br>";
		//return $xresult_sql;
		return $xcarpetaLogs;
	}
} // END FUNCTION

function buscarEvento($cadena_de_texto)
{
	//echo "buscarEvento:".$cadena_de_texto."<br>";
	$evento_clave = false;
	//EVENTO INSERT
	$cadena_insert = strtolower('insert into');
	if (strstr(strtolower($cadena_de_texto),$cadena_insert) == true) 
		{    
			$evento_clave = true;
			//echo "Ã‰xito!!! El evento es ".$cadena_insert."<br>";
			return $evento_clave;
		} 
	
	//EVENTO UPDATE
	$cadena_update = strtolower('update');
	if (strstr(strtolower($cadena_de_texto),$cadena_update) == true) 
		{
			$evento_clave = true;    
			//echo "Ã‰xito!!! El evento es ".$cadena_update."<br>";            
			return $evento_clave;
		} 
		
	//EVENTO DELETE
	$cadena_delete = strtolower('delete');
		if (strstr(strtolower($cadena_de_texto),$cadena_delete) == true) 
		{  
			$evento_clave = true;  
			//echo "Ã‰xito!!! El evento es".$cadena_delete."<br>";            
			return $evento_clave;
		}
	//EVENTO SELECT
	$cadena_select = strtolower('select');
		if (strstr(strtolower($cadena_de_texto),$cadena_select) == true) 
		{  
			$evento_clave = true;  
			//echo "Ã‰xito!!! El evento es".$cadena_delete."<br>";            
			return $evento_clave;
		} 

	//echo "buscarEvento:".$evento_clave."<br>";
	return $evento_clave;
}

?>


