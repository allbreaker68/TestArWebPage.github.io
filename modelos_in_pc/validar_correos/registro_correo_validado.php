<?php

	include("C:/xampp/htdocs/modelos_in_pc/conexion.php");
	$correo_ingresado = $_POST['correo_ingresado'];

	$query = "SELECT * FROM correos_verificados" ; 
	$resultado = mysqli_query($conexion,$query);
	

	$ingresar_datos = null;
	 
	/*while ($registro= $resultado->fetch_assoc()) {
		
		echo "".$registro['correos_verificados_byAdmin']."<br>";
	}*/
	
	while ($registro = $resultado->fetch_row()) {
        //printf($registro[1]);
        echo "".$registro[1]."<br>";
        
        $consulta_registro = array_search($correo_ingresado, $registro, $estricto= true);
    	echo "".$consulta_registro."<br>";

    	if ($consulta_registro == 1) {
			echo " ".$correo_ingresado."<br>";
		    $ingresar_datos = false;			
    	}

    	
    }
    
    if ($ingresar_datos = true) {
    	echo "correo ingresado";
    }elseif ($ingresar_datos = false) {
    	echo "correo existente";
    }
	
    

	/*for ($i=0; $i < 7; $i++) { 
		echo "".$registro[$i]."<br>";

	}

	

	if(empty($registro)) {
	  	echo "Sin coincidencias<br>";
	  	echo "Correo registrado<br>";
	}elseif(var_dump(count($registro)) >= 1) {
		for ($i=0; $i < var_dump(count($registro))  ; $i++) { 
			if ($registro[$i] == $correo_ingresado) {
				echo "el correo ".$registro[$i]." ya existe";
			}
		}
	}  


	//WHERE correos_verificados_byAdmin LIKE '%\".$correo_ingresado.%\"' ";
    /*if ($query)  {

    	echo $row['correos_verificados_byAdmin'];
      	$query = "INSERT INTO correos_verificados (id_correos, correos_verificados_byAdmin, admin_id) VALUES('','$correo_ingresado','1')";
      	$resuelto = $conexion->query($query);
    }
    */
    
	

	



	

    

	
	
?>