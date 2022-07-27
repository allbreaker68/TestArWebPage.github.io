<?php
	include("conexion.php");
	
	if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
	}

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	$id_modelo = $_GET['idmodeloactual'];

	$actualiza_datos=false;

	$id_admin = $_SESSION['id_admin'];
    $user_id = $_SESSION['user_id'];

	if (isset($_FILES['fileToUpload'],$_FILES['fileusdz'])) {

		$fileglb = $_FILES['fileToUpload'];
		$filename_glb = $fileglb['name'];
		$filetype_glb = $fileglb['type'];
		
		$fileusdz = $_FILES['fileusdz'];
		$filename_usdz = $fileusdz['name'];
		$filetype_usdz = $fileusdz['type'];

		$allowed_types = array("glb","usdz" );

		/*if (!in_array($filetype, $allowed_types)) {
			//header("Location:form_Actualizar_modelos.php?idmodeloactual=0");

		}*/
		
		if (empty($user_id)) {
		$user_id = $_GET['user_id'];
		}
		if (empty($id_admin)) {
		$id_admin = 1;
		}

		if (!is_dir("uploads/".$user_id)) {
			mkdir("uploads/".$user_id, 0777);
		}

		move_uploaded_file($fileglb['tmp_name'], 'uploads/'.$user_id.'/'.$filename_glb);
		move_uploaded_file($fileusdz['tmp_name'], 'uploads/'.$user_id.'/'.$filename_usdz);
		
	}else{
		
		//header("Location:form_Actualizar_modelos.php?idmodeloactual=0");
	}





	$ubicacion_nombre_glb = "uploads/$user_id/$filename_glb";
	$ubicacion_nombre_usdz = "uploads/$user_id/$filename_usdz";

	

		$stmt = $conexion->prepare('SELECT * FROM model_glb WHERE id_modelos = ?');
    	$stmt->bind_param('i', $id_modelo); // 'i' specifies the variable type => 'int'
    	$stmt->execute();
    	$resultado =$stmt->get_result();
    	while ($row = $resultado->fetch_assoc()) {
    		if ($row['id_modelos'] == $id_modelo) {
    				echo $row['id_modelos'];
    				unlink($row['modelo_glb']);
    				unlink($row['modelo_usdz']);
    			}
    	}

		$query = $conexion->prepare("UPDATE model_glb SET  modelo_glb = ? , modelo_usdz = ? WHERE id_modelos = ?; ");
    	$query->bind_param('ssi', $ubicacion_nombre_glb, $ubicacion_nombre_usdz, $id_modelo); // 's' specifies the variable type => 'string'
    	$query->execute();

    	if ($query) {
			echo "datos enviados";
?>
			<button name="button"><a href="home_principal.php"> volver<a/></button>
<?php
		}else  {
			echo "no enviados";
?>
			<button name="button"><a href="home_principal.php"> volver<a/></button>
<?php
		}
	

	

	

?>