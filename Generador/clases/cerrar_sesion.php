<?php
    $fechaOld= $_SESSION["ultimoacceso"];
    $ahora = date("Y-n-j H:i:s");
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaOld));
 	//echo 'fechaOld= '.$fechaOld.'<br>';
	//echo 'ahora= '.$ahora.'<br>';
	//echo 'tiempo_transcurrido= '.$tiempo_transcurrido .'<br>';
	
    if($tiempo_transcurrido>= 600) { // 60 comparamos el tiempo y verificamos si pasaron 10 minutos o más por segundos (60 segundos)
      session_destroy(); // destruimos la sesión
	  	echo'<script type="text/javascript">alert("Su sesion ha expirado por inactividad';
	    echo', vuelva a logearse para continuar");window.parent.location.href="../index.html";</script>'; 
    }else {       //sino, actualizo la fecha de la sesión
    $_SESSION["ultimoacceso"] = $ahora;
   } 
 ?> 