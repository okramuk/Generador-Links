$(document).on('ready', inicio);

function inicio()
{
	$('#tipoUpi').on('change', crearUsuario);
	$('#guardar').on('click', guardarUsuario);

}

function nuevoAjax()
{
	var xmlhttp;
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

	return xmlhttp;

}
function crearUsuario()
{
	var formulario = $('#cambios').html();
	$('#cambios').html(' ');

	bootbox.dialog({
		title: 'CREAR USUARIOS',
		message: formulario,
		buttons:{
			success:{
				label: 'Guardar',
				callback: function()
				{
					guardarUsuario();
					return false;
					//bootbox.hideAll();
				}
			}
		}
	});
	$('#cambios').html(formulario);
}

function mostrarUsuarios()
{
	var request = nuevoAjax();

	var codigoUpi = $('#tipoUpi').prop('selected', true).val();

	var fdata = new FormData();

	fdata.append('codigoUpi', codigoUpi);

	request.open("POST","php/consultarUsuario.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#cambios').html(request.response);
			var cambioCss =
			{
				background: '#B4AFAC',
				height: "auto",
				opacity: 1,
				width: '100%'
			};
			$('#cambios').css(cambioCss);
		}
	};

	request.send(fdata);

}

function guardarUsuario()
{
	var formulario = $('#cambios').html();
	$('#cambios').html(' ');
	var codigoUpi = $('#tipoUpi').prop('selected', true).val();
	var nombres = $('#nombre').val();
	var apellidos = $('#apellido').val();
	var mail = $('#email').val();
	var usuario = $('#usuario').val();
	var password = $('#password').val();
	var tipoUsuario = $('#tipoUser').prop('selected', true).val();

	if(validarIngreso(nombres) == 0)
	{
		$('#archivo').append('<div class="cambios" id="cambios">');			
		$('#cambios').html(formulario);
		alert("No se ingreso el nombre del usuario");
		return false;
	}
	if(validarIngreso(apellidos) == 0)
	{
		$('#archivo').append('<div class="cambios" id="cambios">');			
		$('#cambios').html(formulario);
		alert("No se ingreso el apellido del usuario");
		return false;
	}
	if(validarIngreso(mail) == 0)
	{
		$('#archivo').append('<div class="cambios" id="cambios">');			
		$('#cambios').html(formulario);
		alert("No se ingreso el mail del usuario");
		return false;
	}
	if(validarIngreso(usuario) == 0)
	{
		$('#archivo').append('<div class="cambios" id="cambios">');			
		$('#cambios').html(formulario);
		alert("No se ingreso un usuario");
		return false;
	}
	if(validarIngreso(password) == 0)
	{
		$('#archivo').append('<div class="cambios" id="cambios">');			
		$('#cambios').html(formulario);
		alert("No se ingreso el password del usuario");
		return false;
	}
	if(tipoUsuario == 0)
	{
		$('#archivo').append('<div class="cambios" id="cambios">');			
		$('#cambios').html(formulario);
		alert("No se escogio un tipo de usuario");
		return false;
	}

	var fdata = new FormData();
	fdata.append('codigoUpi', codigoUpi);
	fdata.append('nombres', nombres);
	fdata.append('apellidos', apellidos);
	fdata.append('mail', mail);
	fdata.append('usuario', usuario);
	fdata.append('password', password);
	fdata.append('tipoUsuario', tipoUsuario);

	var request = nuevoAjax();

	request.open("POST", "php/guardarUsuario.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#archivo').html(request.responseText);
			var cambioCss =
			{
				background: '#B4AFAC',
				height: "auto",
				opacity: 1,
				width: '100%',
				margin: '10px auto',
				padding: '10px',
				border: '2px solid black'
				
			};
			$('#archivo').css(cambioCss);
			$('#archivo').append('<div class="cambios" id="cambios">');			
			$('#cambios').html(formulario);
			var esconderCss =
			{
				width: '0',
				height: '0',
				overflow: 'hidden'
			};
			$('#cambios').css(esconderCss);
			if(request.responseText == 0)
			{
				alert('El nombre de usuario ya existe, por favor ingrese uno diferente');
				$('#archivo').html('El nombre de usuario ya existe, por favor ingrese uno diferente');
			}
			else
			{
				alert(request.responseText);
				$('.nombre').val('');
				$('.apellido').val('');
				$('.email').val('');
				$('.usuario').val('');
				$('.password').val('');	
				enviarCorreo(nombres, apellidos, mail, usuario, password, tipoUsuario);	
			}
				
		}
	};

	request.send(fdata);
}

function enviarCorreo(nombres, apellidos, mail, usuario, password, tipoUsuario)
{	
	
	var fdata = new FormData();
	//fdata.append('codigoUser', codigoUser);
	fdata.append('nombres', nombres);
	fdata.append('apellidos', apellidos);
	fdata.append('mail', mail);
	fdata.append('usuario', usuario);
	fdata.append('password', password);
	fdata.append('tipoUsuario', tipoUsuario);

	var request = nuevoAjax();

	request.open("POST", "../php/correo.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{			
			/*no hacer nada*/
		}
	};

	request.send(fdata);
}

function validarIngreso(variable)
{
	var longitud = variable.length;
	if(longitud > 0)
		return 1
	else
		return 0
}