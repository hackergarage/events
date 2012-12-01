<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<meta name="keywords" lang="es" content="HackerGarage, Eventos, Programación Web" />
		<meta name="author" content="lord" />
		<meta name="description" content="Registro de eventos de programación en linea" />
		<title>Eventos</title>
		<link rel="stylesheet" type="text/css" href="../css/vistablog.css" />
	</head>

	<body>
	
	<?
		include 'header.php';
		include 'nav.php';
	?>
		<!-- INSERTAR AQUI EL FORMULARIO DE INICIO DE SESION CON TWITTER -->
<h3>Login</h3>
		<form name="formulario" method="get" action="usuariosLogin.php" accept-charset="utf-8">
		<fieldset>
			<legend>Proceso para login</legend>
			<div>
				<label for="usuario">Usuario</label>
				<input type="text" id="usuario" name="usuario" required  placeholder="Escribe tu nombre de usuario"/>
			</div>
			<div>
				<label for="cont">Contraseña</label>
				<input type="password" id="cont" name="cont" />
			</div>
			
		<br />
			<button type="submit">Enviar</button>
			</fieldset>
		</form>
	<?	
		include 'footer.php';
	?>
	</body>
</html>