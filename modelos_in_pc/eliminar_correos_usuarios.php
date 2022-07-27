<?php 
	include("conexion.php");

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    if (empty($_SESSION['id_admin']) && empty($_SESSION['user_id'])) {
		header("location:inicio_sesion.php");
	}else {
		
		if (isset ($_GET['id_correos']) && empty($_GET['id_modelos_borrados']  )) {
			
			$id_correos = $_GET['id_correos'];

			$query = $conexion->prepare('DELETE FROM correos_verificados WHERE id_correos = ?');
    		$query->bind_param('i', $id_correos); // 'i' specifies the variable type => 'int'
   			$query->execute();
   			$resultado =$query->get_result();

   			if ($resultado) {
				echo "Datos NO eliminados ";
			}else{
				echo "Datos Eliminados Exitosamente ";
				
			}
		}elseif (isset ($_GET['id_modelos_borrados']) && empty($_GET['id_correos'])) {
			


			$id_modelos_borrados = $_GET['id_modelos_borrados'];

			$stmt = $conexion->prepare('SELECT * FROM modelos_borrados WHERE id_modelos_borrados= ?');
    		$stmt->bind_param('i', $id_modelos_borrados); // 'i' specifies the variable type => 'int'
    		$stmt->execute();
    		$resultado_one =$stmt->get_result();

    		while ($row = $resultado_one->fetch_assoc()) {
    			if ($row['id_modelos_borrados'] == $id_modelos_borrados) {
    				echo $row['id_modelos_borrados'];
    				unlink($row['model_glb_borrado']);
    				unlink($row['model_usdz_borrado']);
    				rmdir('uploads/'.$row['id_correo_borrar']);
    			}
    		}

			$query_one = $conexion->prepare('DELETE FROM modelos_borrados WHERE id_modelos_borrados = ?');
    		$query_one->bind_param('i', $id_modelos_borrados); // 'i' specifies the variable type => 'int'
   			$query_one->execute();
   			$result =$query_one->get_result();

   			if ($result) {
				echo "Datos NO eliminados ";
			}else{
				
				echo "Datos Eliminados Exitosamente ";
			}
		}
		

		
		
	}


?>
	<button name="button"><a href="home_principal.php"> volver<a/></button>


