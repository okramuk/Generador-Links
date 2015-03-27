$(document).on('ready', inicio);

function inicio()
{
	$('#tipoUpi').on('change',cargarMatriz);	
	$('#seleccion').on('change', verListaArchivos);
	$('#subirArchivo').on('click', consultarArchivos);
	$('#verLinks').on('click', verLinks);
	$('#consultar').on('click', consultarLinks);
	
}

//cargar y retornar una variable xmlhttprequest

function cargarAjax()
{
	var xmlhttp;
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

	return xmlhttp;
}

//consultar links
function consultarLinks()
{
	//tomamos el codigo de la upi
	var upi = $('#tipoUpi').prop('selected', true).val();

	if(upi <= 0)
	{
		alert("No ha seleccionado ninguna UPI.");
		return false;
	}

	//valor de la matriz
	var matriz = $('#tipoMatriz').prop('selected', true).val();

	if(matriz <= 0)
	{
		alert("No ha seleccionado ninguna MATRIZ.");
		return false;
	}

	//valor del año
	var anio = $('#anio').prop('selected', true).val();

	//valor del mes
	var mes = $('#mes').prop('selected', true).val();

	//cargamos ajax
	var request = cargarAjax();

	//variable que transportara los valores
	var fdata = new FormData();

	//cargamos variables
	fdata.append('upi', upi);
	fdata.append('matriz', matriz);
	fdata.append('anio', anio);
	fdata.append('mes', mes);

	request.open("POST", "../../php/consutarLinks.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#lista').html(request.responseText);

			$('#lista').css('opacity', '1');
		}
	};

	request.send(fdata);
}

//regresar datos para el select matriz

function cargarMatriz()
{
	var request = cargarAjax();

	var fdata = new FormData();

	var seleccion = $('#tipoUpi').prop('selected', true).val();

	fdata.append('upi', seleccion);

	console.log("*****" + seleccion);

	request.open("POST", "../../php/cargarMatriz.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#tipoMatriz').html(request.responseText);
			cargarAnio();
			cargarMes();

			console.log(request.responseText + "");
		}
	};

	request.send(fdata);

}

function cargarAnio()
{
	var request = cargarAjax();

	request.open("POST", "../../php/cargarAnio.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#anio').html(request.responseText);
			$('#anio').removeAttr('disabled');
			console.log(request.responseText + "");
		}
	};

	request.send();
}

function cargarMes()
{
	var request = cargarAjax();

	request.open("POST", "../../php/cargarMes.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#mes').html(request.responseText);
			$('#mes').removeAttr('disabled');
			console.log(request.responseText + "");
		}
	};

	request.send();
}

//llamara al codigo php para subir el archivo al servidor
function subidaArchivos()
{

	//tomamos el codigo de la upi
	var upi = $('#tipoUpi').prop('selected', true).val();

	if(upi <= 0)
	{
		alert("No ha seleccionado ninguna UPI.");
		return false;
	}

	//valor de la matriz
	var matriz = $('#tipoMatriz').prop('selected', true).val();

	if(matriz <= 0)
	{
		alert("No ha seleccionado ninguna MATRIZ.");
		return false;
	}

	//valor del año
	var anio = $('#anio').prop('selected', true).val();

	//valor del mes
	var mes = $('#mes').prop('selected', true).val();

	//cargamos ajax
	var request = cargarAjax();

	//variable que transportara los valores
	var fdata = new FormData();

	//revisamos si ha escogido un archivo
	var numArchivos = $('#seleccion').prop('files').length;
	if(numArchivos <= 0)
	{
		alert("No ha seleccionado ningun archivo.");
		return false;
	}

	//cargamos archivos
	var archivo = document.getElementById('seleccion').files;
	var extensionPermitida = ".pdf";
	var cont = 0;
	for(var i = 0; i < numArchivos; i++)
	{
		var nombreArchivo = archivo[i].name;
		var ext = nombreArchivo.substring(nombreArchivo.lastIndexOf(".")).toLowerCase();
		if(ext == extensionPermitida)
		{
			fdata.append('archivo' + i, archivo[i]);
			cont++;
		}
			
	}

	if(cont == 0)
	{
		alert("Solo puede subir archivos con extensión pdf");
		return false;
	}
	
	//cargamos variables
	fdata.append('upi', upi);
	fdata.append('matriz', matriz);
	fdata.append('anio', anio);
	fdata.append('mes', mes);

	request.open("POST", "../../php/subirArchivos.php", true);

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			$('#lista').html(request.responseText);
			$('#verLinks').removeAttr('disabled');
			bootbox.dialog({
				title: 'COPIE LOS LINKS DE LOS SIGUIENTES ARCHIVOS',
				message: request.responseText
			});
			
		}
		else
		{
			alert("Fallo en la carga de los archivos");
		}
	};

	request.upload.addEventListener('progress', function(e){
		if(e.lengthComputable)
		{
			document.querySelector('.progreso').style.width = ((e.loaded / e.total) * 100) + '%';
		}
	});

	request.send(fdata);

}
//desplegara la lista de archivos
function verListaArchivos()
{
	var numFiles = $(this).prop('files').length;
	var mensaje = "";

	for(var i = 0; i < numFiles; i++)
	{
		var nombre = this.files[i].name;
		mensaje = mensaje + "<li>" + nombre + "</li>"; 
		console.log(nombre);
	}

	$('#lista').html(mensaje);
	$('#lista').css('opacity', '1');
	//console.log(numFiles + "   000000");
}

function verLinks()
{
	var mensaje = $('#listaArchivos').html();
	bootbox.dialog({
		title: 'LINKS',
		message: mensaje
	});
}

function borrarArchivo(nombreId)
{

	//tomamos el codigo de la upi
	var upi = $('#tipoUpi').prop('selected', true).val();
	//valor de la matriz
	var matriz = $('#tipoMatriz').prop('selected', true).val();
	//valor del año
	var anio = $('#anio').prop('selected', true).val();

	//valor del mes
	var mes = $('#mes').prop('selected', true).val();

	var nombreTag = $("#" + nombreId).attr('name');

	var tamanioNombre = nombreTag.length;
	var num = nombreTag.substr(tamanioNombre - 1);

	var nombreId = "archivoSubido" + num;
	var nameFile = $('#' + nombreId).html();

	var fdata = new FormData();
	//cargamos variables
	fdata.append('upi', upi);
	fdata.append('matriz', matriz);
	fdata.append('anio', anio);
	fdata.append('mes', mes);
	fdata.append('nombreArchivo', nameFile);

	var request = cargarAjax();
	var confirmar = confirm("En realidad quiere borrar el archivo: " + nameFile);
	if(!confirmar)
	{
		alert("No se borro el archivo");
		return false;
	}

	request.open("POST","../../php/BorrarArchivo.php", true);
	request.onload = function(e)
	{
		if(request.status == 200)
		{
			consultarLinks();
			bootbox.dialog({
				title: 'ARCHIVOS BORRADOS',
				message: request.responseText
			});
		}
		else
		{
			alert("Error al borrar el archivo.");
		}
	};

	request.send(fdata);


	console.log(nameFile);

}

function consultarArchivos()
{
	//tomamos el codigo de la upi
	var upi = $('#tipoUpi').prop('selected', true).val();

	if(upi <= 0)
	{
		alert("No ha seleccionado ninguna UPI.");
		return false;
	}

	//valor de la matriz
	var matriz = $('#tipoMatriz').prop('selected', true).val();

	if(matriz <= 0)
	{
		alert("No ha seleccionado ninguna MATRIZ.");
		return false;
	}

	//valor del año
	var anio = $('#anio').prop('selected', true).val();

	//valor del mes
	var mes = $('#mes').prop('selected', true).val();

	//cargamos ajax
	var request = cargarAjax();

	//variable que transportara los valores
	var fdata = new FormData();

	//revisamos si ha escogido un archivo
	var numArchivos = $('#seleccion').prop('files').length;
	if(numArchivos <= 0)
	{
		alert("No ha seleccionado ningun archivo.");
		return false;
	}

	//cargamos archivos
	var archivo = document.getElementById('seleccion').files;
	var extensionPermitida = ".pdf";
	var cont = 0;
	for(var i = 0; i < numArchivos; i++)
	{
		var nombreArchivo = archivo[i].name;
		var ext = nombreArchivo.substring(nombreArchivo.lastIndexOf(".")).toLowerCase();
		if(ext == extensionPermitida)
		{
			fdata.append('archivo' + i, archivo[i]);
			cont++;
		}
			
	}

	if(cont == 0)
	{
		alert("Solo puede subir archivos con extensión pdf");
		return false;
	}
	
	//cargamos variables
	fdata.append('upi', upi);
	fdata.append('matriz', matriz);
	fdata.append('anio', anio);
	fdata.append('mes', mes);

	request.open("POST", "../../php/consultarArchivo.php", true);

	var res;

	request.onload = function(e)
	{
		if(request.status == 200)
		{
			var respuesta = request.responseText;
			
			if(respuesta == 0)
			{
				subidaArchivos();
				
			}
			else
			{
				res = confirm(request.responseText);
				if(res)
					subidaArchivos();
				else
					alert('No se subio ningún archivo');
				
			}
			
		}
		
	};	

	request.send(fdata);
	//return res;

}

