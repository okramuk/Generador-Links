<?php
include '../lib/dbconfig.php';
if($action == 'informacionKilometraje')
{
	informacionKilometraje($placa);
	
} else if ($action == 'informacionVehiculo')
{
	informacionVehiculo($placa);	
}

 else if ($action == 'informacionConductor')
{
	informacionConductor($placa);	
}
else
	consultaPlaca($placa);

function consultaPlaca($placa)
{
	$ultimoDigital = substr($placa, -1);    // devuelve "f"
	$value;
	switch ($ultimoDigital) {
    case "1":
		$value = "2";
		break;
    case "2":
		$value = "3";
		break;
    case "3":
		$value = "4";
		break;
    case "4":
		$value = "5";
		break;
    case "5":
		$value = "6";
		break;
    case "6":
		$value = "7";
		break;
    case "7":
		$value = "8";
		break;
    case "8":
		$value = "9";
		break;
    case "9":
		$value = "10";
		break;
    case "0":
		$value = "11";
		break;
	}
	
	return $value;
}

function informacionConductor($placa)
{
	$query="select v.placa, concat(f.primer_nombre,' ',f.apellido_paterno) as conductor
	from pa_vehiculo v inner join funcionario f on(v.cod_custodio = f.ci_funcionario) where v.placa = '$placa'";
	$result=query($query);
	while($consulta=mysql_fetch_object($result))
	{
		$conductor = $consulta->conductor;
	}
	echo '<div id="Div_Conductor">
			<input name="txtConductor" type="text" id="txtConductor" value="'.$conductor.'" readonly="readonly" disabled="disabled" />				
          </div>';
}

function informacionVehiculo($placa)
{
	$query="select placa, concat(marca,' - ',modelo) as vehiculo from pa_vehiculo where placa = '$placa'";
	$result=query($query);
	while($consulta=mysql_fetch_object($result))
	{
		$vehiculo = $consulta->vehiculo;
	}
	echo'<div id="Div_Vehiculo">
			<input name="txtVehiculo" type="text" id="txtVehiculo" value="'.$vehiculo.'" readonly="readonly" disabled="disabled"/>				
          </div>';
}
function informacionKilometraje($placa)
{
	$query="select max(kilometraje_final) kilometraje_final from pa_registro_kilometraje where placa = '$placa'";
	$result=query($query);
	while($consulta=mysql_fetch_object($result))
	{
		$kilometraje_final = $consulta->kilometraje_final;
	}
	if($kilometraje_final != ""){
	echo '<div id="Div_Kilom_Inicial">
			<input name="txtKilometraje_Final" type="text" id="txtKilometraje_Final" value="'.$kilometraje_final.'" disabled="disabled"/>
          </div>';
	}else
	{
		echo '<div id="Div_Kilom_Inicial">
			<input name="txtKilometraje_Final" type="text" id="txtKilometraje_Final" value=" " maxlength="10" onkeypress="return validarN(event)" size="25"/>
          </div>';
	}
}
?>
