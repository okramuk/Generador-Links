<?php
include("../lib/dbconfig.php");

if($type == 'checkNombresByCedula')
{
	checkNombresByCedula($cedula);
}
if ($type == 'checkTipoUsuarioporCedula')
{
	checkTipoUsuarioporCedula($cedula);
}
function checkNombresByCedula($cedula)
{
	$consultaCedula = "select count(*) as cuantos from pa_conductor where ci_funcionario ='$cedula'";
	$result_consultaCedula=query($consultaCedula);
	while($consultaCedula=mysql_fetch_object($result_consultaCedula))
	$numeroC = $consultaCedula->cuantos;		
	if($numeroC == 1){
		$consultaCedula = "select count(*) as cuantos from usuario where cod_usuario ='$cedula'";
		$result_consultaCedula=query($consultaCedula);
		while($consultaCedula=mysql_fetch_object($result_consultaCedula))
		$numeroU = $consultaCedula->cuantos;			
		if($numeroU == 0){
			$query_consultaCedula = "select concat(primer_nombre,' ',apellido_paterno) as nombres from funcionario where ci_funcionario = '$cedula'";
			$result_consultaCedula=query($query_consultaCedula);
				while($consultaCedula=mysql_fetch_object($result_consultaCedula))
				{
					$nombres = $consultaCedula->nombres;
					echo '<div id="Div_Nombre">
						<input type="text" name="txtNombres_usuario" id="txtNombres_usuario" value="'.$nombres.'" maxlength="50" readonly="readonly"
						 disabled="disabled"/>	
					</div>';
				}
		}else{ echo '<div id="Div_Nombre">
					<input type="text" name="txtNombres_usuario" id="txtNombres_usuario" value="'.$nombres.'" maxlength="50" readonly="readonly"
					disabled="disabled"/><span style="color:#FF0000">Usuario ya existe...!</span><br>
					</div>';}
	}else{ 
			echo '<div id="Div_Nombre">
			<input type="text" name="txtNombres_usuario" id="txtNombres_usuario" value="'.$nombres.'" maxlength="50" readonly="readonly"
			disabled="disabled"/><span style="color:#FF0000">No se encuentra registrado como chofer o encargado de transportes...!</span><br>
			</div>';
		}	
}

function checkTipoUsuarioporCedula($cedula)
{
	$consultaCedula = "select encargado_transportes from pa_conductor where ci_funcionario ='$cedula'";
	$result_consultaCedula=query($consultaCedula);
	while($consultaCedula=mysql_fetch_object($result_consultaCedula))
	{
		$encargado_transportes = $consultaCedula->encargado_transportes;	
	}
	if ($encargado_transportes != ''){
		if ($encargado_transportes == '1')
			$encargado = '7';
		if ($encargado_transportes == '0')
			$encargado = '6';
	}else
		$encargado = '-1';
		
		echo '<div id="Div_TipoUsuario">';
				$consulta="select * from tipo_usuario ORDER BY usuario";
				$result=query($consulta);
				echo '<select name="txtCodTipoUsuario" id="txtCodTipoUsuario" disabled="disabled" >
				<option value = "-1">--Seleccione--</option>';
				while($area=mysql_fetch_object($result))
					{
						if($area->usuario == 'Chofer' || $area->usuario == 'Encargado Transporte')	
						{
							if($encargado == $area->cod_tipo_usuario){
								$descripcion = utf8_encode($area->usuario);	
								echo '<option value="'.$area->cod_tipo_usuario.'"selected>'.$descripcion.'</option>';
							}else
							{
								$descripcion = utf8_encode($area->usuario);	
								echo '<option value="'.$area->cod_tipo_usuario.'">'.$descripcion.'</option>';
							}
						}
					}
                echo '</select>
			</div>';
}

?>
