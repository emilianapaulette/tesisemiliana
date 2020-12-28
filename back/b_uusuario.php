<?php
include 'conexion.php';
$idu = $_GET["ic"];
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$password = $_POST["password"];
$rol = $_POST["rol"];

$query = "UPDATE usuario SET fullname = '$fullname', username = '$username', password = '$password', rol = '$rol' WHERE idusuario = '$idu';";

$insert = mysqli_query($con, $query);

header("location:../usuario.php");

?>