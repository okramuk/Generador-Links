$(document).on('ready', inicio);

function inicio()
{
	$('#tipoUpi').on('change', mostrarUsuarios);
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
		message: formulario
	});
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
		}
	};

	request.send(fdata);

}

function verPerfil(codigo)
{
	$('#guardar').attr('disabled', false);
	var codigoUsuario = codigo;
	var fdata = new FormData();
	var request = nuevoAjax();

	fdata.append('codigoUsuario', codigoUsuario);

	request.open("POST", "php/mostrarPerfil.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			bootbox.dialog({
				title: 'MODIFICAR CUENTA',
				message: request.responseText,
				onEscape: function(){
					bootbox.hideAll();
				},
				buttons:{
					success:{
						label: 'Actualizar Datos',
						callback: function(){
							cambiarUsuario(codigoUsuario);
							return false;
						}
					},
					danger:{
						label: 'Borrar Usuario',
						callback: function(){
							borrarUsuario(codigoUsuario);
							return true;
						}
					}
				}
			});
		}
	};

	request.send(fdata);
}

function guardarUsuario()
{
	var codigoUpi = $('#tipoUpi').prop('selected', true).val();
	var nombres = $('#nombre').val();
	var apellidos = $('#apellido').val();
	var mail = $('#email').val();
	var usuario = $('#usuario').val();
	var password = $('#password').val();
	var tipoUsuario = $('#tipoUser').prop('selected', true).val();

	if(validarIngreso(nombres) == 0)
	{
		alert("No se ingreso el nombre del usuario");
		return false;
	}
	if(validarIngreso(apellidos) == 0)
	{
		alert("No se ingreso el apellido del usuario");
		return false;
	}
	if(validarIngreso(mail) == 0)
	{
		alert("No se ingreso el mail del usuario");
		return false;
	}
	if(validarIngreso(usuario) == 0)
	{
		alert("No se ingreso un usuario");
		return false;
	}
	if(validarIngreso(password) == 0)
	{
		alert("No se ingreso el password del usuario");
		return false;
	}
	if(tipoUsuario == 0)
	{
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
			/*$('#nombre').val('');
			$('#apellido').val('');
			$('#email').val('');
			$('#usuario').val('');
			$('#password').val('');*/
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
			alert(request.responseText);
		}
	};

	request.send(fdata);
}

function cambiarUsuario(codigo)
{	
	var codigoUser = codigo;
	var nombres = $('#nombre').val();
	var apellidos = $('#apellido').val();
	var mail = $('#email').val();
	var usuario = $('#usuario').val();
	var password = $('#password').val();
	var tipoUsuario = $('#tipoUser').prop('selected', true).val();

	if(validarIngreso(nombres) == 0)
	{
		alert("No se ingreso el nombre del usuario");
		return false;
	}
	if(validarIngreso(apellidos) == 0)
	{
		alert("No se ingreso el apellido del usuario");
		return false;
	}
	if(validarIngreso(mail) == 0)
	{
		alert("No se ingreso el mail del usuario");
		return false;
	}
	if(validarIngreso(usuario) == 0)
	{
		alert("No se ingreso un usuario");
		return false;
	}
	if(validarIngreso(password) == 0)
	{
		alert("No se ingreso el password del usuario");
		return false;
	}
	if(tipoUsuario == 0)
	{
		alert("No se escogio un tipo de usuario");
		return false;
	}

	var fdata = new FormData();
	fdata.append('codigoUser', codigoUser);
	fdata.append('nombres', nombres);
	fdata.append('apellidos', apellidos);
	fdata.append('mail', mail);
	fdata.append('usuario', usuario);
	fdata.append('password', password);
	fdata.append('tipoUsuario', tipoUsuario);

	var request = nuevoAjax();

	request.open("POST", "php/cambiarPerfil.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{			
			alert(request.responseText);
			mostrarUsuarios();
		}
	};

	request.send(fdata);
}

function borrarUsuario(codigo)
{
	var codigoUser = codigo;
	var nombres = $('#nombre').val();
	var apellidos = $('#apellido').val();
	var fdata = new FormData();
	fdata.append('codigoUser', codigoUser);

	var confirmar = confirm("Desea borrar la cuenta del usuario: " + nombres + " " + apellidos + "?");
	if(!confirmar)
	{
		alert("No se borro la cuenta");
		return false;
	}
	var request = nuevoAjax();

	request.open("POST", "php/borrarUsuario.php", true);
	request.onload = function(e)
	{
		if(request.status == 200)
		{
			alert(request.responseText);
			$('#nombre').val('');
			$('#apellido').val('');
			$('#email').val('');
			$('#usuario').val('');
			$('#password').val('');
			$('#guardar').attr('disabled', true);
			mostrarUsuarios();
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