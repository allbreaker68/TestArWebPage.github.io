<?php 
	include("conexion.php");

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if (empty($_SESSION['id_admin'])) {
    	$_SESSION['id_admin']=null;
    	
		header("location:inicio_sesion.php");
	
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title>Registro Correos</title>
</head>
<body>
<?php
	if ($_SESSION['id_admin'] == 1) {
?>		
	<h1>Registro Correos Validados para nuevos usuarios</h1>
	<form action="cerrar_sesion.php" method="post" >
			<button type="submit">Cerrar sesion</button><br><br>
	</form>
	<form action="registro_correo_validado_Three.php" method="POST" enctype="multipart/form-data">
		<label for="correo_ingresado">Correo por registrar</label><br><br>
		<input type="email" name="correo_ingresado" placeholder="Ingrese un correo" required>

		<input type="submit" name="submit"><br><br>
	</form>
<?php	
	}else{
		
		session_destroy();
		echo "No deberias de estar aqui";
	}
	
?>
	<button name="button"><a href="home_principal.php"> Volver<a/></button>
</body>
</html>