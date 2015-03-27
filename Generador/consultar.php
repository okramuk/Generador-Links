<?php
session_start();
?>
<?php 
include "php/conexion.php"; 
include "clases/cerrar_sesion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Consulta de Links</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos.css">
</head>
<body>
	<div class="site">
		<div class="header-outer">
			<header class="site-header group">
				<h1 class="tagline">Consulta de Links</h1>
				<div class="logo">
					<img src="images/IEPS-listo.png" alt="">
				</div>
			</header><!-- end site-header -->
		</div><!-- end header-outer -->
		<div class="navigation-outer">
			<nav class="navigation-bar group">
				<ul class="navigation">
					<li><a href="index.php">Generar Links</a></li>
					<li><a class="active" href="#">Consultar Links</a></li>
					<li><a href="http://10.2.74.100/intranet/index.php/es/">Salir</a></li>
				</ul>

			</nav><!-- end navigation-bar -->
		</div><!-- end navigation-outer -->
		

		<section class="site-content">
			<section class="information">
				<div class="imagenes">
					<div class="imagen">
						<img src="images/ama-vida-iso.png" alt="Ama la vida">
						<div class="texto">
							<h2>Consulta de Links</h2>
							<p>Aplicativo para la consulta de links</p>
						</div><!-- end texto -->

					</div>
				</div>
			</section><!-- end information -->
			<section class="generator-link">
				<div class="form-generator">
					<div class="formulario">
						<div class="field">
							<label for="upi">Seleccionar una UPI</label>
							<select id="tipoUpi" class="tipoUpi" name="upi">
								<option value="0" selected>Seleccione una UPI</option>}
								option
								<?php
								/*
								* 	Se consultara de la tabla de datos los nombres de las upis.
								*	Para consultar el nombre de la base de datos y servidor, etc
								*	Revisar el archivo: php/conexion.php
								*/

								$query = "SELECT * FROM upi";
								$result = mysqli_query($conexion, $query);

								while($row = mysqli_fetch_row($result))
								{
									echo "<option value=\"" . $row[0] ."\">" . $row[1] ."</option>";
								}
								?>

							</select><!-- end tipoUpi -->
						</div><!-- end field -->
						<div class="field">
							<label for="matriz">Seleccione una matriz</label>
							<select id="tipoMatriz" class="tipoMatriz" name="matriz">
							</select><!-- end tipoMatriz -->
						</div><!-- end field -->
						<div class="field">
							<div class="fecha">
								<label for="anio">Seleccione Año</label>
								<select class="anio" id="anio" name="anio" disabled="disabled"></select>
								<label for="anio">Seleccione Mes</label>
								<select class="mes" id="mes" name="mes" disabled="disabled"></select>
							</div><!-- end fecha -->
						</div><!-- end field -->
						<div class="field">
							<div class="archivos" id="archivos">								
								<div class="listaArchivos" id="listaArchivos">
									<ul class="lista" id="lista"></ul>
								</div><!-- end listaArchivos -->
								<div class="barraProgreso" hidden="hidden">
									<div class="progreso">
									</div><!-- end barraProgreso -->
								</div><!-- end barraProgreso -->
							</div><!-- end archivos -->
						</div><!-- end field -->
						<div class="field">
							<div class="controles">
								<button class="consultar" id="consultar">Consultar</button><!-- end subirArchivo -->
							</div><!-- end controles -->
						</div>	<!-- end field -->						
					</div><!-- end formulario -->
				</div><!-- end generator-link -->
			</section><!-- end generator-link -->
		</section><!-- end site-content -->

		<footer class="site-footer">
			
		</footer><!-- end site-foooter -->
	</div><!-- end site -->
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/bootbox.js"></script>
	<script src="js/modernizr.js"></script>
	<script src="js/comportamiento.js"></script>
	<script src="js/prefixfree.min.js"></script>
</body>
</html>