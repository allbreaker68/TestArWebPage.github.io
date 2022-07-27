<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro</title>
	</head>
	<body>

		<h1>Registrate</h1>	
		<p></p>
		<a href="inicio_sesion.php" >Iniciar sesion</a>

		<form action="registro_usuario_nuevo_back_end.php" method="post" enctype="multipart/form-data">	
			
			<label for="correo_usuario">Correo</label><br>
			<input type="email" placeholder="Ingresa un correo" name="correo_usuario"><br><br>

			<label for="password_usuario">Contraseña</label><br>
			<input type="password" placeholder="Ingresa una contraseña" name="password"><br><br>
			<input type="submit" name="submit">
		</form>

	</body>
</html>