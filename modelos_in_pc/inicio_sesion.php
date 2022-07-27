<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width, initial-scale=1.0">
		<title>inicia sesion</title>
	</head>
	<body>
		<form action="inicio_sesion_validar.php" method="post">
		<h2>sistema login</h2>
		<a href="registro_usuario_nuevo.php"> Registrate<a/>
		<p>usuario</p>
		<input type="email" placeholder="Ingrese su correo" name="correo">
		<p>contraseña</p>
		<input type="password" placeholder="ingrese su contraseña" name="pass">
		<input type="submit" value="Ingresar">
		</form>
	</body>
</html>