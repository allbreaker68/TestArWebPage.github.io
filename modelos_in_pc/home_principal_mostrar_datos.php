<?php
	include("conexion.php");

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (empty($_SESSION['id_admin']) && empty($_SESSION['user_id'])) {
        header("location:inicio_sesion.php");
    }

    if (empty($_SESSION['id_admin'])) {

        $_SESSION['id_admin']=null;

    }elseif(empty($_SESSION['user_id'])) {

        $_SESSION['user_id']=null;
    }

    $correo = $_SESSION['correo']."<br><br>";
    
    echo "<br>";
    echo $_SESSION['id_admin']."<br>";
    echo $_SESSION['user_id']."<br>";

    

	

    if ($_SESSION['user_id']== null) {
       
?>
    <table>
        <tr>
            <th><button name="registro_correo_validado" ><a href="registro_correo_validado.php">Añadir nuevo usuario</a></button></th>
            <th><button name="correos_sin_cuenta_activa"><a href="correos_sin_cuenta_activa.php">Ver todos los correos registrados</a></button> </th>
            <th><button name="mostrar_cuentas_activas"><a href="mostrar_cuentas_activas.php">Ver los usuarios con una cuenta creada</a></button></th>
            <th><button name="papelera_modelos_borrados"><a href="papelera_modelos_borrados.php">Ver los correos y modelos eliminados</a> </button></th>
        </tr>
        
    </table>
    <br>
    <br>
        
        

<?php        
    }
?>
    <a href="formulario_guardar_modelos.php">Añadir modelo nuevo</a><br><br>

<?php
    
    $stmt = $conexion->prepare('SELECT * FROM model_glb WHERE admin_id = ?');
    $stmt->bind_param('i', $_SESSION['id_admin']); // 'i' specifies the variable type => 'int'
    $stmt->execute();
    $resultado =$stmt->get_result();
    $filas = mysqli_num_rows($resultado);

    $stmt_one = $conexion->prepare('SELECT * FROM model_glb WHERE user_id = ?');
    $stmt_one->bind_param('i', $_SESSION['user_id']); // 's' specifies the variable type => 'string'
    $stmt_one->execute();
    $result =$stmt_one->get_result();
    $filas_one = mysqli_num_rows($result);

    if ($filas) {
        while ($row = $resultado->fetch_assoc() ) {

?>
            <table style="width:80%">
            <tr>
                <th>ID usuarios</th>
                <th>ID modelo</th>
                <th>Ubicacion modelo .GLB</th>
                <th>Ubicacion modelo .usdz</th>
                <th>visualizar modelo</th>
                <th>eliminar</th>
                <th>actualizar</th>
            </tr>
            <tr>
                <td><?php echo $row['user_id']."<br>";?></td>
                <td><?php echo $row['id_modelos']."<br>";?></td>
                <td><?php echo $row['modelo_glb']."<br>";?> </td>
                <td><?php echo $row['modelo_usdz']."<br>";?></td>
                
                <td><?php echo '<a href=ar_web.php?idpage=' . $row['id_modelos']. '>Visualizar</a>';  ?> </td>
                <td><?php echo '<a href=eliminar_modelo_bd.php?id_modelos=' . $row['id_modelos']. '>Eliminar</a>';  ?></td>
                <td><?php echo '<a href=form_actualizar_modelos.php?idmodeloactual=' . $row['id_modelos']. '&user_id='.$row['user_id'].' >Actualizar</a>';  ?>   </td>
                

                


            </tr>
            
        </table> 
<?php
        }
    }elseif ($filas_one) {
        while ($row = $result->fetch_assoc()) {
?>          <table style="width:80%">
                <tr>
                    <th>ID modelo</th>
                    <th>Ubicacion modelo .GLB</th>
                    <th>Ubicacion modelo .usdz</th>
                    <th>visualizar modelo</th>
                    <th>eliminar</th>
                    <th>actualizar</th>
                </tr>
                <tr>
                    <td><?php echo $row['id_modelos']."<br>";?></td>
                    <td><?php echo $row['modelo_glb']."<br>";?> </td>
                    <td><?php echo $row['modelo_usdz']."<br>";?></td>
                
                    <td><?php echo '<a href=ar_web.php?idpage=' . $row['id_modelos']. '>visualizar</a>';  ?>    </td>
                    <td><?php echo '<a href=eliminar_modelo_bd.php?id_modelos=' . $row['id_modelos']. '>Eliminar</a>';  ?></td>
                    <td><?php echo '<a href=form_actualizar_modelos.php?idmodeloactual=' . $row['id_modelos']. '>actualizar modelos</a>';  ?></td>
                </tr>
            
            </table>  
            
<?php                  
        }       
    }

 

?>