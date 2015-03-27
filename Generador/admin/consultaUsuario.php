<?php
session_start();
?>
<?php 
include "../php/conexion.php"; 
include "../clases/cerrar_sesion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Generador de Links -- Administración</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
	<div>
		<div class="site">
			

			<section class="site-content">
				<section class="information">
					<div class="imagenes">
						<div class="imagen">
							<img src="../images/ama-vida-iso.png" alt="Ama la vida">
							<div class="texto">
								<h2>Administración</h2>
								<p>Consulta de Usuarios</p>
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
								<div class="archivo" id="archivo">																		
									<div class="cambios" id="cambios">
										<div class="nombres">
											<label for="nombre">Nombre</label>
											<input class="nombre" id="nombre" name="nombre" type="text" placeholder="Ingrese un nombre"></input>
											<label for="apellido">Apellidos</label>
											<input class="apellido" id="apellido" name="apellido" type="text" placeholder="Ingrese un apellido"></input>
										</div><!-- end nombres -->
										<div class="mail">
											<label for="email">E-mail</label>
											<input class="email" id="email" name="email" type="email" placeholder="example@host.com"></input>
										</div><!-- end mail -->
										<div class="cuenta">
											<label for="usuario">Nombre de Usuario</label>
											<input class="usuario" id="usuario" name="usuario" type="text" placeholder="nombre.apellido"></input>
											<label for="password">Password</label>
											<input class="password" id="password" name="password" type="password" placeholder="123456"></input>
											<label for="tipoUser">Tipo de Usuario</label>
											<select class="tipoUser" id="tipoUser">
												<option value="0" selected>Seleccione el tipo de Usuario</option>
												<?php
												$query = "SELECT * FROM tipo_usuario";
												$result = mysqli_query($conexion, $query);

												while($row = mysqli_fetch_row($result))
												{
													echo "<option value=\"" . $row[0] ."\">" . $row[1] ."</option>";
												}
												?>
											</select><!-- end tipoUser -->
										</div><!-- end cuenta -->
										<div class="guardarUsuario">
											<button class="guardar" id="guardar" onclick="guardarUsuario();">Crear Usuario</button><!-- end subirArchivo -->
										</div><!-- end guardarUsuario -->
									</div><!-- end cambios -->									
								</div><!-- end archivos -->
							</div><!-- end field -->											
						</div><!-- end formulario -->
					</div><!-- end generator-link -->
				</section><!-- end generator-link -->
			</section><!-- end site-content -->

			<footer class="site-footer">
				
			</footer><!-- end site-foooter -->
		</div><!-- end site -->
	</div>
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/bootbox.js"></script>
	<script src="../js/modernizr.js"></script>
	<script src="js/consulta.js"></script>
	<script src="../js/prefixfree.min.js"></script>
</body>
</html>