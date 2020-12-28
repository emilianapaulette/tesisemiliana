<?php 
$busqueda = $_REQUEST["busqueda"];
if (isset($_REQUEST['buscar'])) {
	header("location:../usuario.php?busqueda=$busqueda");

} else {

	header("location:../usuario.php");

}


?>