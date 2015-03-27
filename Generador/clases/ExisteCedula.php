<script type="text/javascript">
	$( ".datepicker" ).datepicker(); 
</script>
<?php
include("../lib/dbconfig.php");
	consultaCedula($cedula, $caducidad_licencia, $puntos_licencia, $fecha_vacaciones, $observaciones, $responsable, $type);
	
	
function consultaCedula($cedula, $caducidad_licencia, $puntos_licencia, $fecha_vacaciones, $observaciones, $responsable, $type)
{
	if(!cedulaRepetida($cedula, $type )){
	//$query_consultaCedula = "select count(*) as num from informacion where num_documento = '$cedula'";
	$query_consultaCedula = "select ci_funcionario, concat(primer_nombre,' ',segundo_nombre) as nombres, concat(apellido_paterno,' ',apellido_materno) as apellidos, fecha_nacimiento, mail_institucional, telefono, celular, cod_estado from funcionario where ci_funcionario = '$cedula'";
	$result_consultaCedula=query($query_consultaCedula);
 	$result_bk1 = mysql_query($query_consultaCedula); 
          $numerobk = mysql_num_rows($result_bk1); 
         if ($numerobk != 0) // si ya esta en la base de datos 
         {
				while($consultaCedula=mysql_fetch_object($result_consultaCedula))
				{
					$ci_funcionario = $consultaCedula->ci_funcionario;
					$nombres = $consultaCedula->nombres;
					$apellidos = $consultaCedula->apellidos;
					$telefono = $consultaCedula->telefono;
					$celular = $consultaCedula->celular;
					$mail_institucional = $consultaCedula->mail_institucional;
					$fecha_nacimiento = $consultaCedula->fecha_nacimiento;					
				}
		 }
		 else
		 {
			$nombres = "no existe información de la cédula";
			$apellidos = "no existe información de la cédula";
			$telefono = "";
			$celular = "";
			$mail_institucional = "";
			$fecha_nacimiento = "";
		 }

	echo '<div id="Div_Informacion">
		<table style="border-style:none">
            <tr>
                <td width="120">
                	<label for="lblCi_usuario" style="display:block">Cédula: </label>
                </td>
                <td width="146">
                	<div id="Div_NumDocumento"><input name="txtCi_funcionario" type="text" id="txtCi_funcionario" value="'.$ci_funcionario.'" maxlength="10" onkeypress="return validarN(event);" onKeyUp="fn(this.form,this,event);" onBlur="return check_cedula(this.form,this);" required="required"/></div>
                </td>
				<td colspan="2">';
				if($responsable == 0){
	                echo '<label for="lblEncargado_transportes" style="display:block">Encargado de Transportes:
                	<input id="chkEncargado_transportes" name="chkEncargado_transportes" type="checkbox" /></label>';
				}
				else{
					echo '<label for="lblEncargado_transportes" style="display:block">Encargado de Transportes:
                	<input id="chkEncargado_transportes" name="chkEncargado_transportes" type="checkbox" checked="'.$responsable.'" /></label>';
					}
         echo '</td>
            </tr>
            
            <tr>
                <td>
                	<label for="lblNombres" style="display:block">Nombres: </label>
                </td>
                <td colspan="3">
                	<input name="txtNombres" type="text" id="txtNombres" value="'.$nombres.'" size="50" readonly="readonly" disabled="disabled"/>
                </td>
            </tr>
            <tr>
                <td>
                	<label for="lblApellidos" style="display:block">Apellidos: </label>
                </td>
                <td colspan="3">
                	<input name="txtApellidos" type="text" id="txtApellidos" value="'.$apellidos.'" size="50" readonly="readonly" disabled="disabled" />
                </td>
            </tr>
            <tr>
                <td>
                	<label for="lblTelefono" style="display:block">Teléfono: </label>
                </td>
                <td>
                	<input name="txtTelefono" type="text" id="txtTelefono" value="'.$telefono.'" maxlength="50" readonly="readonly" disabled="disabled"/>
                </td>
                <td>
                	<label for="lblFecha_Nacimiento" style="display:block">Fecha Nacimiento: </label>
                </td>
                <td>
                	<input name="txtFecha_nacimiento" type="text" id="txtFecha_nacimiento" value="'.$fecha_nacimiento.'" maxlength="10" readonly="readonly" disabled="disabled"   />
                </td>
				
            </tr>
            <tr>
              <td>
                	<label for="lblMail" style="display:block">Mail: </label>
                </td>
                <td colspan="3">
                	<input name="txtMail" type="text" id="txtMail" value="'.$mail_institucional.'" size="50" readonly="readonly"  disabled="disabled" />
                </td>
            </tr>
			
            <tr>
				<td>
                	<label for="lblCelular" style="display:block">Celular: </label>
                </td>
                <td >
                	<input name="txtCelular" type="text" id="txtCelular" value="'.$celular.'" maxlength="10" onkeypress="return validarN(event)"/>
                </td>
				 <td> 
    	           	<label for="lblCaducidad_licencia" style="display:block">Caducidad Licencia: </label>
				</td>
				<td>
					<input type="text" name="txtCaducidad_licencia" id="txtCaducidad_licencia" value="'.$caducidad_licencia.'" required="required" maxlength="12" readonly="readonly"/>
				</td>
	         </tr>
	
             <tr>
   				 <td>
                	<label for="lblPuntos" style="display:block">Puntos Licencia: </label>
                </td>
                <td>
                	<input type="text" name="txtPuntos_licencia" id="txtPuntos_licencia" value="'.$puntos_licencia.'" onkeypress="return validarN(event)" required="required" maxlength="2" onBlur="return entre(this,0,30);" />
                </td>
				<td>
                	<label for="lblFecha_vacaciones" style="display:block">Fecha Vacaciones: </label>
                </td>
	
                <td>
                	<input type="text" name="txtFecha_vacaciones" id="txtFecha_vacaciones" value="'.$fecha_vacaciones.'" required="required" maxlength="12" readonly="readonly"/>
                </td>
            </tr>
             <tr>
                <td>
                	<label for="lblObservaciones" style="display:block">Observaciones: </label>
                </td>
                <td colspan="3">
                <textarea name="txtObservaciones" cols="50" rows="3"  id="txtObservaciones">'.$observaciones.'</textarea>
                </td>
            </tr>
		</table>
	<input type="text" name="txtValidate" id="txtValidate" value="false" style="display:none" />
    <input type="text" name="txtCi_funcionario" id="txtCi_funcionario" value="" style="display:none" />
	</div>';
	}
}


function cedulaRepetida($num_documento, $type)
{
	if($type == 0)
	{
	$consultaCedula = "select * from pa_conductor where ci_funcionario = '$num_documento'";
	$result_consultaCedula=query($consultaCedula);
	$result_bk1 = mysql_query($consultaCedula); 
    $numerobk = mysql_num_rows($result_bk1); 
         if ($numerobk != 0) // si ya esta en la base de datos 
         {
		 echo '<div id="Div_Informacion">
		<table style="border-style:none">
            <tr>
                <td width="120">
                	<label for="lblCi_usuario" style="display:block">Cédula: </label>
                </td>
                <td width="146">
                	<div id="Div_NumDocumento"><input name="txtCi_funcionario" type="text" id="txtCi_funcionario" value="'.$ci_funcionario.'" maxlength="10" onkeypress="return validarN(event);" onKeyUp="fn(this.form,this,event);" onBlur="return check_cedula(this.form,this);" required="required"/><span style="color:#FF0000">C&eacute;dula ya se encuentra registrada.</span><br></div>
                </td>
				<td colspan="2">
					<label for="lblEncargado_transportes" style="display:block">Encargado de Transportes:
                	<input id="chkEncargado_transportes" name="chkEncargado_transportes" type="checkbox" /></label>
				</td>
            </tr>
            
            <tr>
                <td>
                	<label for="lblNombres" style="display:block">Nombres: </label>
                </td>
                <td colspan="3">
                	<input name="txtNombres" type="text" id="txtNombres" value="'.$nombres.'" size="50" readonly="readonly" disabled="disabled"/>
                </td>
            </tr>
            <tr>
                <td>
                	<label for="lblApellidos" style="display:block">Apellidos: </label>
                </td>
                <td colspan="3">
                	<input name="txtApellidos" type="text" id="txtApellidos" value="'.$apellidos.'" size="50" readonly="readonly" disabled="disabled" />
                </td>
            </tr>
            <tr>
                <td>
                	<label for="lblTelefono" style="display:block">Teléfono: </label>
                </td>
                <td>
                	<input name="txtTelefono" type="text" id="txtTelefono" value="'.$telefono.'" maxlength="50" readonly="readonly" disabled="disabled"/>
                </td>
                <td>
                	<label for="lblFecha_Nacimiento" style="display:block">Fecha Nacimiento: </label>
                </td>
                <td>
                	<input name="txtFecha_nacimiento" type="text" id="txtFecha_nacimiento" value="'.$fecha_nacimiento.'" maxlength="10" readonly="readonly" disabled="disabled"   />
                </td>
				
            </tr>
            <tr>
              <td>
                	<label for="lblMail" style="display:block">Mail: </label>
                </td>
                <td colspan="3">
                	<input name="txtMail" type="text" id="txtMail" value="'.$mail_institucional.'" size="50" readonly="readonly"  disabled="disabled" />
                </td>
            </tr>
			
            <tr>
				<td>
                	<label for="lblCelular" style="display:block">Celular: </label>
                </td>
                <td >
                	<input name="txtCelular" type="text" id="txtCelular" value="'.$celular.'" maxlength="10" onkeypress="return validarN(event)"/>
                </td>
				 <td> 
    	           	<label for="lblCaducidad_licencia" style="display:block">Caducidad Licencia: </label>
				</td>
				<td>
					<input type="text" name="txtCaducidad_licencia" id="txtCaducidad_licencia" value="'.$caducidad_licencia.'" required="required" maxlength="12" readonly="readonly"/>
				</td>
	         </tr>
	
             <tr>
   				 <td>
                	<label for="lblPuntos" style="display:block">Puntos Licencia: </label>
                </td>
                <td>
                	<input type="text" name="txtPuntos_licencia" id="txtPuntos_licencia" value="'.$puntos_licencia.'" onkeypress="return validarN(event)" required="required" maxlength="2" onBlur="return entre(this,0,30);" />
                </td>
				<td>
                	<label for="lblFecha_vacaciones" style="display:block">Fecha Vacaciones: </label>
                </td>
	
                <td>
                	<input type="text" name="txtFecha_vacaciones" id="txtFecha_vacaciones" value="'.$fecha_vacaciones.'" required="required" maxlength="12" readonly="readonly"/>
                </td>
            </tr>
             <tr>
                <td>
                	<label for="lblObservaciones" style="display:block">Observaciones: </label>
                </td>
                <td colspan="3">
                <textarea name="txtObservaciones" cols="50" rows="3"  id="txtObservaciones">'.$observaciones.'</textarea>
                </td>
            </tr>
		</table>
	<input type="text" name="txtValidate" id="txtValidate" value="false" style="display:none" />
    <input type="text" name="txtCi_funcionario" id="txtCi_funcionario" value="" style="display:none" />
	</div>';		 
				return true;	 
		 }else
		 	return false;
	}
}
?>
