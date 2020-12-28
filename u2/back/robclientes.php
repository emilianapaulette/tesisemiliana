<?php 
$busqueda = $_REQUEST["busqueda"];
if (isset($_REQUEST['buscar'])) {
	header("location:../clientes.php?busqueda=$busqueda");

} else {

	header("location:../clientes.php");

}


?>