<?php

	include("C:/xampp/htdocs/modelos_in_pc/conexion.php");

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
    if (empty($_SESSION['id_admin']) && empty($_SESSION['user_id'])) {
		header("location:inicio_sesion.php");
	} 

	$correo_ingresado = $_POST['correo_ingresado'];

	if(buscarRepetido($correo_ingresado,$conexion)==1){
		echo "Ya existe ese correo en la base de datos <br>";
?>
		<button name="button"><a href="home_principal.php"> volver<a/></button>
<?php
	}else{

		$var=1;

		$query = $conexion->prepare("INSERT INTO correos_verificados ( correos_verificados_byAdmin, admin_id) VALUES(?,?) ");
    	$query->bind_param('si',$correo_ingresado,$var ); 
    	$query->execute();


		

		echo "Correo registrado correctamente <br>";
?>

		<button name="button"><a href="home_principal.php"> volver<a/></button>
<?php		
	}

	function buscarRepetido($correo,$conexion){

		$stmt = $conexion->prepare('SELECT * FROM correos_verificados WHERE correos_verificados_byAdmin = ?');
   		$stmt->bind_param('s', $correo); 
    	$stmt->execute();
    	$resultado =$stmt->get_result();
    	


		

    	if(mysqli_num_rows($resultado) > 0){
    		return 1;
    	}else{
    		return 0;
    	}
	}


?>