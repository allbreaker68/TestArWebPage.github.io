<?php 
	
	include('conexion.php');

	if (empty($correo=$_POST['correo']) && empty($pass =$_POST['pass'])) {
		header("location:inicio_sesion.php");
	}
	$correo=$_POST['correo'];
	$pass =$_POST['pass'];
	
	session_start();

	$_SESSION['correo']=$correo;

	

	$stmt = $conexion->prepare('SELECT * FROM admin WHERE correo = ? and pass = ?');
	$stmt->bind_param('ss', $correo,$pass); // 's' specifies the variable type => 'string'
	$stmt->execute();
	$resultado =$stmt->get_result();
	$filas = mysqli_num_rows($resultado);


	$stmt_one = $conexion->prepare('SELECT * FROM user WHERE usuario = ? and user_pass = ?');
	$stmt_one->bind_param('ss', $correo,$pass); 
	$stmt_one->execute();
	$result =$stmt_one->get_result();
	$filas_one = mysqli_num_rows($result);


	if ($filas || $filas_one) {
		if ($filas) {
			while ($row_ = $resultado->fetch_assoc()) {
				
				$_SESSION['id_admin'] =  $row_['id_admin'];
			}

			header("location:home_principal.php?");
			
		}else{
			while ($row = $result->fetch_assoc()) {
				$_SESSION['user_id'] = $row['user_id'];
			}

			header("location:home_principal.php");
			
			
		}
	}else{
		include("inicio_sesion.php");
?>
		<h1 class="bad">Error en la autentificacion</h1>
		<h2 class="bad">Contacte a su administrador más cercano o registrate en caso de tener un correo verificado por el administrador</h2>
		
	<?php

	}

	

	mysqli_free_result($resultado);
	mysqli_close($conexion);
	