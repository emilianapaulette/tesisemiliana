<?php 

  include 'links/session.php';
  include 'links/d_clientelinks.php';
  include 'back/conexion.php';

 ?>

<?php
    if (empty($_GET["id"])) {
      

    header("location:./clientes.php");

    }
    $id = $_GET["id"]; 
    $cons = "SELECT fullname,username,rol FROM usuario WHERE idusuario = $id";
    $ejec = mysqli_query($con,$cons);
    $rs = mysqli_fetch_array($ejec);

?>
 
<!DOCTYPE html>
<html>
<head>
	



	<script src="js/jsidebar.js"></script>
	<title>Eliminar Usuario</title>
</head>
<body>


	
	<div class="wrapper">
    
    <?php
    include 'links/sidebar.php'; 
    ?>

    <div class="main_content">
    <h1 class="black down"><a class="black" href="usuario.php">Usuario</a> ></h1>
    <h4 class="downr2">eliminar usuairo</h4>
    	<!--div form-->
    <div class="downp">
        <div class="conf">

          <h3 align="center">¿Seguro de que desea eliminar el usuario?</h3><br><br>
          <h4 align="center">Nombre: <?php echo $rs["fullname"]; ?></h4><br>
          <h4 align="center">usuario: <?php echo $rs["username"]; ?></h4><br>
          <h4 align="center">rol: <?php echo $rs["rol"]; ?></h4>

    
          <button class="bot bot2 btn btn-2" onclick="window.location.href = 'usuario.php';" ><i class="fas fa-times"></i>  cancelar </button>


          <button class="bot bot2 btn btn-2" onclick="window.location.href = 'back/b_dusuario.php?id=<?php echo $id ?>';" ><i class="fas fa-check"></i>  confirmar </button>

        </div>
    </div>
			





        </div>
    	</div>
</body>
</html>