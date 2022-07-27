
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UFT-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>bienvenido</title>
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
		<a href="correos_sin_cuenta_activa.php">ver todos los correos registrados</a> <br><br>
		<?php
			
			include("conexion.php");

    		if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 

    		if (empty($_SESSION['id_admin'])) {
        		header("location:inicio_sesion.php");
    		}
    		$stmt = $conexion->prepare('SELECT * FROM user WHERE admin_id = ?');
    		$stmt->bind_param('i', $_SESSION['id_admin']); // 'i' specifies the variable type => 'int'
    		$stmt->execute();
   			$resultado =$stmt->get_result();


    		

    		while ($row = $resultado->fetch_assoc()) {
    			
    				?>	
    					<table>
    						<tr>
    							<th>Id Usuario</th>
    							<th>Usuario</th>	
    							<th>Enviar a la papelera</th>
    						</tr>
    						<tr>
    							<td><?php echo $row['user_id']."<br>"; ?></td>
    							<td><?php echo $row['Usuario']."<br>";?></td>
    							<td><?php echo '<a href=mover_datos_borrados.php?id_user=' . $row['user_id']. '>Mover a la papelera</a>'; ?></td>
    						</tr>
    					</table>

    				<?php
    			
    		}
		?>
			
	</body>
</html>