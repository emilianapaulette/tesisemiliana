<?php

include 'links/session.php';
include 'links/registrarclientelinks.php';
if (!empty($_POST)) {

    include 'back/conexion.php';
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];
    $hash=password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuario (`idusuario`, `fullname`, `username`, `password`, `rol`) VALUES (NULL, '$fullname', '$username', '$hash', '$rol');";

    $insert = mysqli_query($con, $query);
    $aviso = "<p class='av_good'>usuario registrado correctamente</p>";

    }


?>
<!DOCTYPE html>
<html>
<head>
<script src="js/jsidebar.js"></script>
	<title>Registrar Usuario</title>
</head>
<body>


	
	<div class="wrapper">
    
    <?php
    include 'links/sidebar.php'; 
    ?>

    <div class="main_content">
    <h1 class="black down"><a class="black" href="proveedores.php">Usuario</a> ></h1>
    <h4 class="downr2">nuevo usuario</h4>
    <!--div form-->
    <div class="downp">
        <div class="mensaje" align="center"><?php if (!empty($_POST)) {echo $aviso;}?></div>
    	<div class="frm_registrar">
			<form method="post" action="registrarusuario.php">

				
				<label>Nombre</label>
                <br>
    			<input name="fullname" type="text" class="iwi" placeholder="Nombre de usuario" required>
                <br><br>
				

    			<label>username</label>
                <br>
    			<input name="username"type="text" class="iwi" placeholder="username" required>
				<br><br>
				
				<label>Password</label>
                <br>
    			<input name="password" type="text" class="iwi" placeholder="password" required>
                <br><br>
    			<label>Rol</label>
                <br>
                <select name="rol">

                    <option>administrador</option>
                    <option>vendedor</option>
                    </select>

    			<br><br>

    			
				
				
					
    			<input type="submit" class="iwi btn btn-2" >

		
		</form>






        </div>
    	</div>
</body>
</html>