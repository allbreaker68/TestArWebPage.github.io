<?php
	include("conexion.php");

    $var = 1;

    $stmt = $conexion->prepare('SELECT * FROM model_glb WHERE admin_id = ?');
    $stmt->bind_param('i', $var); // 'i' specifies the variable type => 'int'
    $stmt->execute();
    $resultado =$stmt->get_result();

    
    

    
    while ($row = $resultado->fetch_assoc()) {
        
    if ($row['id_modelos'] == $_GET['idpage'] && $row['admin_id'] == $var ) {
      /*echo $row['id_modelos'];
    	echo $row['admin_id']; 
   		echo $row['modelo_glb']; 
    	echo $row['modelo_usdz']; */

    	$modeloglb = $row['modelo_glb'];
    	$modelousdz = $row['modelo_usdz'];
    }  
    
    
}



?>
