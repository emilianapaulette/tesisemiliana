<?php

include 'links/session.php';
include 'links/provlinks.php';
include 'back/conexion.php';


?>
<!DOCTYPE html>
<html>
<head>

	<title>Usuarios</title>
</head>
<body>


	
	<div class="wrapper">

    <?php
    include 'links/sidebar.php';
    ?>

    <div class="main_content">
    	<h1 class="down">Usuarios </h1>


	<div class="divtab">
	<section class="downp" id="container">
    	<table>

			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>username</th>
				<th>rol</th>
				<th>Acciones</th>

			</tr>
			<?php



			//paginas
			if (empty($_REQUEST["busqueda"])) {
			$q2 = "SELECT COUNT(*) as total_reg FROM usuario";

			}else{
			$busqueda = $_REQUEST["busqueda"];


			$q2 = "SELECT COUNT(*) as total_reg FROM usuario where idusuario LIKE '%$busqueda%' OR fullname LIKE '%$busqueda%' OR username LIKE '%$busqueda%' OR password LIKE '%$busqueda%' OR rol LIKE '%%busqueda%' ";

			}
			$sq_reg = mysqli_query($con,$q2);
			$r_reg = mysqli_fetch_array($sq_reg);
			$total_reg = $r_reg['total_reg'];
			$ppg = 9;
			if (empty($_GET['npg'])) {
				$npg = 1;
			} else {

				$npg = $_GET['npg'];

			}

			$desde = ($npg - 1) *  $ppg;

			$ttp = ceil($total_reg / $ppg);










			if (empty($_REQUEST["busqueda"])) {


				$q = "SELECT idusuario,fullname,username,password,rol FROM usuario LIMIT $desde,$ppg";

			} else{
				
				$q = "SELECT idusuario,fullname,username,password,rol FROM usuario where idusuario LIKE '%$busqueda%' OR fullname LIKE '%$busqueda%' OR username LIKE '%$busqueda%' OR password LIKE '%$busqueda%' OR rol LIKE '%%busqueda%' LIMIT $desde,$ppg";




			}
			$e = mysqli_query($con,$q);
			$contador = mysqli_num_rows($e); 

			if ($contador > 0) {
				while ($datos = mysqli_fetch_array($e)) {
					
			?>

			<tr>
				<td><?php echo $datos['idusuario']; ?> </td>
				<td><?php echo $datos['fullname']; ?> </td>
				<td><?php echo $datos['username']; ?> </td>

				<td><?php echo $datos['rol']; ?> </td>
				<td><a href="u_usuario.php?id=<?php echo $datos['idusuario']; ?>" id="b_edit"><i class="fas fa-edit"></i>Editar</a> | <a href="d_usuario.php?id=<?php echo $datos['idusuario']; ?>" id="b_delete"><i class="fas fa-trash"></i>Borrar</a></td>


			</tr>
					







			<?php




		    	}
			}


			?>




    	</table>
    	
    	
    </section><!--downpdiv-->

	</div><!--Divsec-->
	<div class="paginas">
	<div class="wd">
	<form action="back/robusuario.php" method="get" class="down">
    <input type="text" name="busqueda" value="<?php if(!empty($busqueda)){echo $busqueda;} ?>">
    <input type="submit" name = "buscar" value="buscar" class="botw btn btn-2 ">
    <input type="submit" name="reiniciar" value="reiniciar" class="botw btn btn-2">
    </form>
	</div>


	 	
		<ul>
			<?php
			if ($npg != 1) {
				if (!empty($busqueda)) {
				
				
				

			?>	
			<li><a href="?npg=<?php  echo $npg - 1?>&busqueda=<?php echo $busqueda ?>"> < </a></li>

			<?php
			    }else{

			 
			 ?>
			 <li><a href="?npg=<?php  echo $npg - 1?>"> < </a></li>



			<?php 
			}
			}

			for ($i=1; $i <= $ttp ; $i++) { 

				if ($i == $npg) {
				 echo '<li class="seleccion">'.$i.'</li>';
				}else{
				if (empty($busqueda)) {
					echo '<li><a href="?npg='.$i.'">'.$i.'</a></li>';
				} else{
					echo '<li><a href="?npg='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';

				}
				
			}
			}


			?>
			
	
			<?php 
			if ($npg != $ttp) {
				if (!empty($busqueda)) {
				
				
				

			?>	
			<li><a href="?npg=<?php  echo $npg + 1?>&busqueda=<?php echo $busqueda ?>"> > </a></li>

			<?php
			    }else{

			 
			 ?>
			 <li><a href="?npg=<?php  echo $npg + 1?>"> > </a></li>



			<?php 
			}
			}
			 ?>

		</ul>


	</div>





	<div class="bar_btn">

 

    <button class="bot3 btn btn-2" onclick="window.location.href = 'registrarusuario.php';" ><i class="fas fa-plus"></i>  Nuevo Usuario </button>


    <button class="bot3 btn btn-2" onclick="window.location.href = 'back/exportusuario.php';" ><i class="fas fa-file-excel"></i>  Exportar a Excel </button>


    </div><!--divbotones-->

    		
			















      </div>

   





    </div>
       
  
</div>

</body>
</html>