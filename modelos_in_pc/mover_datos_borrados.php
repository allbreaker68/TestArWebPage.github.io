<?php 
	include("conexion.php");

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $id_admin = $_SESSION['id_admin'];

	$_GET['id_user'];
	

	

	$id_modelo_a_guardar = null;
	$modelos_glb_guardar = null;
	$modelos_usdz_guardar = null;
	$id_usuario_guardar = null;
	$Usuario_guardar = null;

	$query = $conexion->prepare('SELECT * FROM user WHERE user_id = ?');
    $query->bind_param('i', $_GET['id_user']); // 'i' specifies the variable type => 'int'
    $query->execute();
    $result =$query->get_result();

    while ($row = $result->fetch_assoc()) {
    	if ($row['user_id'] == $_GET['id_user'] && $row['admin_id'] == $id_admin) {
    		
    		$id_correo_borrar = $row['user_id'];
    		$Usuario_guardar = $row['Usuario'];

    		echo $id_correo_borrar." id user<br>";
    		echo $Usuario_guardar." correo<br>";
    		
    	}
    }

	$query = $conexion->prepare('SELECT * FROM model_glb WHERE admin_id = ?');
    $query->bind_param('i', $id_admin); // 'i' specifies the variable type => 'int'
    $query->execute();
    $resultado =$query->get_result();

    while ($row = $resultado->fetch_assoc()) {
    	if ($row['user_id'] == $_GET['id_user'] && $row['admin_id'] == $id_admin) {
    		
    		$id_modelo_a_guardar = $row['id_modelos'];
    		$modelos_glb_guardar = $row['modelo_glb'];
    		$modelos_usdz_guardar = $row['modelo_usdz'];

    		echo $id_modelo_a_guardar." id modelo<br>";
    		echo $modelos_glb_guardar."   GLB<br>";
    		echo $modelos_usdz_guardar." USDZ<br>";

    		$query = $conexion->prepare("INSERT INTO modelos_borrados (id_anterior_del_modelo, id_correo_borrar, correos_borrados, model_glb_borrado,model_usdz_borrado, admin_id) VALUES(?,?,?,?,?,?) ");
    		$query->bind_param('iisssi',$id_modelo_a_guardar,$id_correo_borrar,$Usuario_guardar, $modelos_glb_guardar, $modelos_usdz_guardar, $id_admin); 
    		$query->execute();
    				
    	}
    }


  	$id_user = $_GET['id_user'];

	$query_one = $conexion->prepare('DELETE FROM user WHERE user_id = ?');
    $query_one->bind_param('i', $id_user); // 'i' specifies the variable type => 'int'
   	$query_one->execute();
   	$result =$query_one->get_result();

   	if ($result) {
		echo "Datos NO eliminados <br>";
	}else{
		
		echo "Datos Eliminados Exitosamente <br>";
	}

    
?>
<button name="button"><a href="home_principal.php"> volver<a/></button>