<?php 
	include('conexion.php');
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }			
	if (empty($_SESSION['id_admin']) && empty($_SESSION['user_id'])) {
		header("location:inicio_sesion.php");
	}		


	$user_id = $_SESSION['user_id'];

	if (empty($user_id)) {
		$user_id = $_GET['user_id'];
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Actulizar modelos</h1>
	
	<form action="cerrar_sesion.php" method="post" >
			<button type="submit">Cerrar sesion</button><br><br>
	</form>
	<?php echo '<form action=Actualizar_modelos.php?idmodeloactual='.$_GET['idmodeloactual'].'&user_id='.$user_id.' method=post enctype=multipart/form-data >' ;?>
	
		Seleccciona modelo .glb  :
		<input type="file" name="fileToUpload" id="fileToUpload" accept=".glb" required= "required"> 
		<hr>
		Selecciona modelo .usdz :
		<input type="file" name="fileusdz" id="fileusdz" accept=".usdz" required= "required">
		<input type="submit" value="Upload model" name="submit" >
	</form>
	<button name="button"><a href="http://localhost/modelos_in_pc/home_principal.php"> Volver<a/></button>
		
</body>
</html>