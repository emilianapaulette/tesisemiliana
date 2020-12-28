
<?php 

include 'conexion.php';
 if (empty($_GET["id"])) {
      

    header("location:./usuario.php");

   } else{

   	$id = $_GET["id"];
   }

$q = "DELETE FROM usuario WHERE idusuario = $id";

$ejecutar = mysqli_query($con,$q);

header("location:../usuario.php");
?>