
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
			<button name="button"><a href="home_principal.php"> volver<a/></button><br><br><br>
			<a href="ver_correos_registrados.php">ver correos registrados sin usuarios activos</a> <br><br>
		</form>
		<?php
			
			include("conexion.php");

    		if(!isset($_SESSION)) 
    		{ 
        		session_start(); 
    		} 

    		if (empty($_SESSION['id_admin'])) {
        		header("location:inicio_sesion.php");
    		}

    		$query = "SELECT * FROM user";
    		$resultado = $conexion->query($query);

    		while ($row = $resultado->fetch_assoc()) {
    			if ($row['admin_id'] == $_SESSION['id_admin']) {
    				?>	
    					<table>
    						<tr>
    							<th>Id Usuario</th>
    							<th>Usuario</th>	
    							<th>Eliminar</th>
    						</tr>
    						<tr>
    							<td><?php echo $row['user_id']."<br>"; ?></td>
    							<td><?php echo $row['Usuario']."<br>";?></td>
    							<td><?php echo '<a href=eliminar_correos_usuarios.php?id_user=' . $row['user_id']. '>Eliminar</a>'; ?></td>
    						</tr>
    					</table>

    				<?php
    			}
    		}
		?>
			
	</body>
</html>