<?php
include 'conexion.php';

session_start();

$usn = $_POST["username"];
$password = $_POST["password"];


$query = "SELECT * FROM usuario WHERE username = '$usn'";
$ejecutar = mysqli_query($con,$query);
$contar= mysqli_num_rows($ejecutar);
if ($contar > 0 ) {
	while($informacion = mysqli_fetch_array($ejecutar)){
		if(password_verify($password, $informacion['password']) //&& $informacion['rol'] == 'administrador'
		){
			$_SESSION['fullname'] = $informacion['fullname'];
			$_SESSION['idusuario'] = $informacion['idusuario'];
			$_SESSION['rol'] = $informacion['rol'];
			header("location:../clientes.php");
		}
	}
//if ($informacion['rol'] == 'administrador' ) {
//	header("location:../clientes.php");
//} else {

//	header("location:../u2/clientes.php");
//}

}else{
	
	header("location:../u2/clientes.php");

}





?>