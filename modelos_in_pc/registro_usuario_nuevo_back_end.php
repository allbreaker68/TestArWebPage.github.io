<?php
	include("conexion.php");

	$correo_usuario = $_POST['correo_usuario'];
	$password = $_POST['password'];

	if (buscarRepetido($correo_usuario,$password,$conexion)==1) {
		//echo "Ya existe ese correo en la base de datos <br>"; <button name="button"><a href="inicio_sesion.php"> volver<a/></button>	
?>
			
<?php			
	}else{
		$query = "SELECT * FROM correos_verificados";
    	$resultado = $conexion->query($query);
	
		while ($row = $resultado->fetch_assoc()) {

			if ($row['admin_id'] == 1 && $row['correos_verificados_byAdmin'] == $correo_usuario) {

				$query = $conexion->prepare("INSERT INTO user ( usuario,  user_pass, admin_id) VALUES(?,?,?) ");
    			$query->bind_param('ssi',$correo_usuario,$password,$row['admin_id']); 
    			$query->execute();
    				

				
    		}else {
    		//$result = empty
    		} 
    	}
	}

	

    

    if (empty($query)) {
    	echo "<h1 class='bad'> no coincide el correo ingresado, o ya estas registrado </h1>";

?>
		<button name="button"><a href="inicio_sesion.php"> volver al inicio<a/></button>    	
<?php    	
    	
    }else{
    	
    	echo "<h1>coincide el correo ingresado, te has registrado correctamente</h1> <br>";
?>

		<button name="button"><a href="inicio_sesion.php"> volver al inicio<a/></button>
<?php			
    }

    function buscarRepetido($correo,$password,$conexion){

    	$stmt = $conexion->prepare('SELECT * FROM user WHERE Usuario = ?');
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