<?php 

  include 'links/session.php';
  include 'links/u_clientelinks.php';
  include 'back/filluu.php';
  $idc = $_GET["id"];
?>
 
<!DOCTYPE html>
<html>
<head>
	



	<script src="js/jsidebar.js"></script>
	<title>Editar usuario</title>
</head>
<body>


	
	<div class="wrapper">
    
    <?php
    include 'links/sidebar.php'; 
    ?>

    <div class="main_content">
    <h1 class="black down"><a class="black" href="usuario.php">Usuario</a> ></h1>
    <h4 class="downr2">editar usuario</h4>
    	<!--div form-->
    <div class="downp">
    	<div class="frm_registrar">
			<form method="post" action="back/b_uusuario.php?ic=<?php echo $idc ?>">

				
				<label>Nombre</label>
                <br>
    			<input name="fullname" type="text" class="iwi" placeholder="Nombre de usuario" value = "<?php echo $fullname?>" required>
                <br><br>
				

    			<label>username</label>
                <br>
    			<input name="username"type="text" class="iwi" placeholder="username" value = "<?php echo $username?>"  required>
				<br><br>
				
				<label>password</label>
                <br>
    			<input name="password" type="text" class="iwi" placeholder="password" value = "<?php echo $password?>"  required>
                <br><br>
    			<label>rol</label>
                <br>
    			<input name="rol" type="text" class="iwi" value = "<?php echo $rol?>"  required>

    			<br><br>

    			
				
				
					
    			<input type="submit" class="iwi btn btn-2" value="Editar">

		
		  	</form>






        </div>
    	</div>
</body>
</html>