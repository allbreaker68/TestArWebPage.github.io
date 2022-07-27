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
    $inserta_datos=false;

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
			header("Location:formulario_guardar_modelos.php");

		}*/
		
		if (empty($user_id)) {
		$user_id = 1;
		}
		if (empty($id_admin)) {
		$id_admin = 1;
		}

		

		if (!is_dir("uploads/".$user_id)) {
			mkdir("uploads/".$user_id, 0777);
		}

		if (file_exists('uploads/'.$user_id.'/'.$filename_glb) || file_exists('uploads/'.$user_id.'/'.$filename_usdz) ) {
			include ("formulario_guardar_modelos.php");
			echo "Cambie el nombre del archivo, pues ya existe uno en la base de datos";
		}else{
			$inserta_datos=true;
			move_uploaded_file($fileglb['tmp_name'], 'uploads/'.$user_id.'/'.$filename_glb);
			move_uploaded_file($fileusdz['tmp_name'], 'uploads/'.$user_id.'/'.$filename_usdz);
		}
		

	}else{
		
		header("Location:formulario_guardar_modelos.php");
	}

	
	$filename_model_glb = "uploads/$user_id/$filename_glb";
	$filename_model_usdz = "uploads/$user_id/$filename_usdz";

	
	if ($inserta_datos == true) {
		
		$query = $conexion->prepare("INSERT INTO model_glb ( modelo_glb, admin_id, modelo_usdz,user_id) VALUES(?,?,?,?) ");
    	$query->bind_param('sisi',$filename_model_glb,$id_admin,$filename_model_usdz,$user_id ); // 's' specifies the variable type => 'string'
    	$query->execute();
		if ($query) {
			echo "datos enviados <br>";
?>
			<button name="button"><a href="home_principal.php"> volver<a/></button>
<?php
		}else  {
			echo "no enviados <br>";
?>
			<button name="button"><a href="home_principal.php"> volver<a/></button>
<?php
		}
	}
	


	

?>