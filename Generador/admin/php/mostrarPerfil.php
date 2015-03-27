<?php
include '../../php/conexion.php';
session_start();

$codigoUsuario = $_POST['codigoUsuario'];
$id = $_SESSION['idusuario'];

$query = "SELECT * FROM usuarios WHERE id =" . $codigoUsuario;

$result = mysqli_query($conexion, $query);

$numFilas = mysqli_num_rows($result);
//echo $numFilas . "--------------";
$mensaje = "";
$contador = 0;
if($numFilas > 0)
{
	$art = logs($query, $id, true, $conexion);
	while($fila = mysqli_fetch_row($result))
	{
		$contador++;
		$mensaje = "
						<div class=\"nombres\">
							<label for=\"nombre\">Nombres</label>
							<input class=\"nombre\" id=\"nombre\" name=\"nombre\" type=\"text\" placeholder=\"Ingrese un nombre\" value=\"".$fila[2]."\"></input>
							<label for=\"apellido\">Apellidos</label>
							<input class=\"apellido\" id=\"apellido\" name=\"apellido\" type=\"text\" placeholder=\"Ingrese un apellido\" value=\"".$fila[3]."\"></input>
						</div><!-- end nombres -->
						<div class=\"mail\">
							<label for=\"email\">E-mail</label>
							<input class=\"email\" id=\"email\" name=\"email\" type=\"email\" placeholder=\"example@host.com\" value=\"".$fila[4]."\"></input>
						</div><!-- end mail -->
						<div class=\"cuenta\">
							<label for=\"usuario\">Nombre de Usuario</label>
							<input class=\"usuario\" id=\"usuario\" name=\"usuario\" type=\"text\" placeholder=\"nombre.apellido\" value=\"".$fila[5]."\" disabled></input>
							<label for=\"password\">Password</label>
							<input class=\"password\" id=\"password\" name=\"password\" type=\"password\" placeholder=\"123456\" value=\"".$fila[6]."\"></input>
							<label for=\"tipoUser\">Tipo de Usuario</label>
							<select class=\"tipoUser\" id=\"tipoUser\">
								<option value=\"0\">Seleccione el tipo de Usuario</option>";
								
								$query1 = "SELECT * FROM tipo_usuario";
								$result1 = mysqli_query($conexion, $query1);

								while($row = mysqli_fetch_row($result1))
								{
									if($fila[8] == $row[0])
										$mensaje = $mensaje . "<option value=\"" . $row[0] ."\" selected>" . $row[1] ."</option>";
									else
										$mensaje = $mensaje . "<option value=\"" . $row[0] ."\">" . $row[1] ."</option>";
								}
								
						$mensaje = $mensaje . "</select><!-- end tipoUser -->
						</div><!-- end cuenta -->
						
					";		

					/*<div class=\"guardarUsuario\">
							<button class=\"guardar\" id=\"guardar\" onclick=\"cambiarUsuario(".$fila[0].");\">Actualizar Datos</button><!-- end subirArchivo -->
							<button class=\"guardar\" id=\"guardar\" onclick=\"borrarUsuario(".$fila[0].");\">Borrar Usuario</button><!-- end subirArchivo -->
						</div><!-- end guardarUsuario -->*/
		
	}
}
else
{
	$mensaje = $mensaje . "No existen usuarios creados para la UPI seleccionada";
}
echo $mensaje;
?>
