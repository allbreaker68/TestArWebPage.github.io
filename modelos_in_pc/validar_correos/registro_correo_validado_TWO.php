<?php
	
	include("C:/xampp/htdocs/modelos_in_pc/conexion.php");

	$correo_ingresado = $_POST['correo_ingresado'];

	$query = "SELECT * FROM correos_verificados";
    $resultado = $conexion->query($query);

    $bool = true;
	
	while ($row = $resultado->fetch_assoc()) {

		if ($row['admin_id'] == 1 && $row['correos_verificados_byAdmin'] == $correo_ingresado) {
			echo "correo existente inserte otro correo<br>";
			$bool = true;
			echo "bool".$bool;

    	}elseif($row['admin_id'] == 1 && $row['correos_verificados_byAdmin'] != $correo_ingresado) {
    		
    		echo "correo sin guardar en base de datos<br>";
    		$bool = false;
			echo "bool".$bool;	    		
			break;
    	} 
    }

    if ($bool==false) {
    	$query = "INSERT INTO correos_verificados (id_correos, correos_verificados_byAdmin, admin_id) VALUES('','$correo_ingresado','1')";
		
		$result = $conexion->query($query);
    }

    


?>