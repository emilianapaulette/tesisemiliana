<?php 

  include 'links/session.php';
  include 'links/chart_clilinks.php';


 ?>
<!DOCTYPE html>
<html>
<head>

<title>Estadisticas </title>
</head>
<body>
<?php
	include 'back/conexion.php';


?>

<div class="wrapper">
    
    <?php
    include 'links/sidebar.php'; 
    ?>

    <div class="main_content">
    <h1 class="black down"><a class="black" href="ventas.php">Ventas</a> ></h1>
    <h4 class="downr">estadisticas</h4>
   <div class="yearp">
    <select class="cho" onchange="location = this.value;">
    



    
<?php 
    					include_once 'back/conexion.php';
    					$query = mysqli_query($con,"select year from year;");
    					while ($row = mysqli_fetch_array($query)) {
    						$year = $row['year'];
    						if ($_REQUEST["year"] == $year) {
							echo "<option value='chart_venta.php?year=$year' selected>$year</option>";
    							
    						}else{
    						echo "<option value='chart_venta.php?year=$year'>$year</option>";
    					}
    					}



    			?>
</select>	
</div>

    

    </div>
       
  
</div>

<?php


include 'links/chartventa.php';

?>


</body>
</html>