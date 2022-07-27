<?php
	include("conexion.php");

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $id_modelos = $_GET['id_modelos'];

    if (empty($_SESSION['id_admin']) && empty($_SESSION['user_id'])) {
		header("location:inicio_sesion.php");
	}else {

		$stmt = $conexion->prepare('SELECT * FROM model_glb WHERE id_modelos = ?');
    	$stmt->bind_param('i', $id_modelos); // 'i' specifies the variable type => 'int'
    	$stmt->execute();
    	$resultado_one =$stmt->get_result();

    		while ($row = $resultado_one->fetch_assoc()) {
    			if ($row['id_modelos'] == $id_modelos) {
    				echo $row['id_modelos'];
    				unlink($row['modelo_glb']);
    				unlink($row['modelo_usdz']);
    			}
    		}
		
		

		$stmt = $conexion->prepare('DELETE FROM model_glb WHERE id_modelos = ?');
    	$stmt->bind_param('i', $id_modelos); // 'i' specifies the variable type => 'int'
   		$stmt->execute();
   		$resultado =$stmt->get_result();

		

		if ($resultado) {
			echo "Datos NO eliminados";
		}else{
			echo "Datos Eliminados Exitosamente";
		}
	}


?>
	<button name="button"><a href="home_principal.php"> volver<a/></button>