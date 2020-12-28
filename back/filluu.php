<?php

include 'conexion.php'; 
  if (empty($_GET["id"])) {
      

    header("location:./usuario.php");

   }

  $idc = $_GET["id"]; 



  $q = "SELECT fullname,username,password,rol FROM usuario WHERE idusuario = $idc;";
  $e = mysqli_query($con,$q);
  
  $contador = mysqli_num_rows($e); 

  if ($contador > 0) {
        while ($datos = mysqli_fetch_array($e)) {
            
            $fullname = $datos['fullname'];
            $username = $datos['username'];
            $password = $datos['password'];
            $rol = $datos['rol'];

        }
   }


?>