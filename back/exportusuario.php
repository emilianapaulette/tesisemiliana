<?php
header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=Usuarios.xls');
include 'conexion.php';
?>
<table>
    		
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>usuario</th>
				<th>password</th>
				<th>rol</th>
			</tr>
			<?php


		


				$q = "SELECT idusuario,fullname,username,password,rol FROM usuario";

		
			$e = mysqli_query($con,$q);
			$contador = mysqli_num_rows($e); 

			if ($contador > 0) {
				while ($datos = mysqli_fetch_array($e)) {
					
			?>

			<tr>
				<td><?php echo $datos['idusuario']; ?> </td>
				<td><?php echo $datos['fullname']; ?> </td>
				<td><?php echo $datos['username']; ?> </td>
				<td><?php echo $datos['password']; ?> </td>
				<td><?php echo $datos['rol']; ?> </td>


			</tr>
					







			<?php




		    	}
			}


			?>




    	</table>
    	