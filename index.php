<!DOCTYPE html>
<html>
<?php
include 'links/loginlinks.php';
if (!empty($_REQUEST)) {

$aviso = "<p>Compruebe sus datos</p>";
}
?>
  
</head>

<body>
    
    <div id="login-one" class="login-one">
       
        <form class="login-one-form" method="post" action="back/validar.php">
            <div class="col">
                 <div class="mensaje2" align="center"><?php if (!empty($_REQUEST)) {echo $aviso;}?></div>
                <div class="login-one-ico"><i class="fa fa-unlock-alt" id="lockico"></i> </br>
                    <img src="img/frioven.jpg" alt="logo" width="180" height="160"> 
                </div>
                <div class="form-group">
                    <div></div><input class="form-control" type="text" id="input" placeholder="Username" name="username"><input class="form-control" type="password" id="input" placeholder="Password" name="password"><button class="btn btn-primary" id="button" style="background-color:#007ac9;"
                        type="submit">iniciar sesión</button></div>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>