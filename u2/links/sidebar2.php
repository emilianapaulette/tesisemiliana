<link rel="stylesheet" type="text/css" href="css/sidebar.css">
<link rel="stylesheet" type="text/css" href="fw/all.css">


<script src="fw/all.js"></script>
<?php
      include 'links/session.php';

echo "<div class='sidebar'>
        <h2>FRIOVEN</h2>
        <center>$fn</center>
        <ul>
            <li><a href='./clientes.php'><i class='fas fa-address-card'></i>  Clientes</a></li>
            <li><a href='./ventas.php'><i class='fas fa-shopping-cart'></i>  Ventas</a></li>
            <li><a href='./productos.php'><i class='fas fa-boxes'></i>  Productos</a></li>
            <li><a href='./proveedores.php'><i class='fas fa-truck'></i>  Proveedores</a></li>
            <li><a href='./factura.php'><i class='fas fa-dollar-sign'></i> Punto de Venta</a></li>
            <li><a href='./usuario.php'><i class='fas fa-door-open'></i>  nuevo</a></li>
            <li><a href='./back/logout.php'><i class='fas fa-door-open'></i>  Cerrar sesion</a></li>
          
        </ul> 
      
    </div>";
?>
