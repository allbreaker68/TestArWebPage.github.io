<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UFT-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>papelera</title>
	</head>
	<style>
		table, th, td {
  		border:1px solid black;
		}
	</style>
	<body>

		<h1>Bienvenido</h1>	
		<p></p>
		<form action="cerrar_sesion.php" method="post" >
			<button type="submit">Cerrar sesion</button><br><br>
			
		</form>
		<button name="button"><a href="home_principal.php"> volver<a/></button><br><br><br>
		
		<?php
			
			include("conexion.php");

    		if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 

    		if (empty($_SESSION['id_admin'])) {
        		header("location:inicio_sesion.php");
    		}
    		$stmt = $conexion->prepare('SELECT * FROM modelos_borrados WHERE admin_id = ?');
    		$stmt->bind_param('i', $_SESSION['id_admin']); // 'i' specifies the variable type => 'int'
    		$stmt->execute();
   			$resultado =$stmt->get_result();


    		

    		while ($row = $resultado->fetch_assoc()) {
    			
    				?>	
    					<table>
    						<tr>
    							<th>ID actual</th>
    							<th>ID anterior</th>	
    							<th>Correo</th>
    							<th>ubicacion modelo GLB</th>
    							<th>ubicacion modelo USDZ</th>
    						</tr>
    						<tr>
    							<td><?php echo $row['id_modelos_borrados']."<br>"; ?></td>
    							<td><?php echo $row['id_anterior_del_modelo']."<br>";?></td>
    							<td><?php echo $row['correos_borrados']."<br>";?></td>
    							<td><?php echo $row['model_glb_borrado']."<br>";?></td>
    							<td><?php echo $row['model_usdz_borrado']."<br>";?></td>
    							<td><?php echo '<a href=eliminar_correos_usuarios.php?id_modelos_borrados=' . $row['id_modelos_borrados']. '&model_glb_borrado=' . $row['model_glb_borrado']. ' >Eliminar definitivamente</a>'; ?></td>
    						</tr>
    					</table>

    				<?php
    			
    		}
		?>
			
	</body>
</html>