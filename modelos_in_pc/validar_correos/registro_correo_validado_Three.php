<?php

	include("C:/xampp/htdocs/modelos_in_pc/conexion.php");

	$correo_ingresado = $_POST['correo_ingresado'];

	if(buscarRepetido($correo_ingresado,$conexion)==1){
		echo "Ya existe ese correo en la base de datos";
	}else{

		$query = "INSERT INTO correos_verificados (id_correos, correos_verificados_byAdmin, admin_id) VALUES('','$correo_ingresado','1')";
		
		$result = mysqli_query($conexion,$query);
		echo "Correo registrado correctamente";
	}

	function buscarRepetido($correo,$conexion){

		$query = "SELECT * FROM correos_verificados WHERE correos_verificados_byAdmin = '$correo'";
    	$resultado = mysqli_query($conexion,$query);

    	if(mysqli_num_rows($resultado) > 0){
    		return 1;
    	}else{
    		return 0;
    	}
	}


?>