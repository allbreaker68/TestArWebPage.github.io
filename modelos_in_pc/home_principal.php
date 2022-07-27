<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UFT-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>bienvenido</title>
	</head>
	<style>
		table, th, td {
  		border:1px solid black;
	}
</style>
	<body>

		<h1>Bienvenido</h1>	
		<p></p>
		<form action="cerrar_sesion.php" method="post" >
			<button type="submit">Cerrar sesion</button>
		</form>
		<?php
			session_start();
			echo $_SESSION['correo'];
			if (empty($_SESSION['id_admin']) && empty($_SESSION['user_id'])) {
				header("location:inicio_sesion.php");
			}
			Include("home_principal_mostrar_datos.php");
		?>	
	</body>
</html>