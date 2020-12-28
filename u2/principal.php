<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>El viejo continente</title>
    <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="assets2/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets2/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="animate/animate.min.css">
    <link rel="stylesheet" href="css/nivo-slider.css">
    <link rel="stylesheet" href="css/mi-slider.css">
    <link rel="stylesheet" type="text/css" href="fw/all.css">
    <link rel="stylesheet" href="css/principal.css">

</head>

<body>
    <nav class="navbar navbar-light navbar-expand bg-light navigation-clean">
        <div class="container"><a class="navbar-brand" href="#">EL VIEJO CONTIENTE</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"></button>
            <div class="collapse navbar-collapse" id="navcol-1"><a class="btn btn-primary ml-auto" role="button" href="inicio.php">Administrar</a>
            <a class="btn btn-primary ml-auto" role="button" href="back/logout.php">Cerrar sesión</a></div>
        </div>
    </nav>
    <header class="masthead text-white text-center" style="background:url('assets2/img/bg-masthead.jpg')no-repeat center center;background-size:cover;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    
                  <div id="slider">
   <input type="radio" name="slider" id="slide1" checked>
   <input type="radio" name="slider" id="slide2">
   <input type="radio" name="slider" id="slide3">
   <input type="radio" name="slider" id="slide4">
   <div id="slides">
      <div id="overflow">
         <div class="inner">
            <div class="slide slide_1">
               <div class="slide-content">
                  <img src="img/logo.png">
               </div>
            </div>
            <div class="slide slide_2">
               <div class="slide-content">
                  <h2>El VIEJO CONTINENTE IMPORT</h2>
                  <p></p>
               </div>
            </div>
            <div class="slide slide_3">
               <div class="slide-content">
                  <h2>Calidad en nuestros servicios y productos!</h2>
                  <p></p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="controls">
      <label for="slide1"></label>
      <label for="slide2"></label>
      <label for="slide3"></label>
      <label for="slide4"></label>
   </div>
   <div id="bullets">
      <label for="slide1"></label>
      <label for="slide2"></label>
      <label for="slide3"></label>
      <label for="slide4"></label>
   </div>
</div>

                
            </div>
        </div>
    </header>
    
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image:url(&quot;img/01.png&quot;);"><span></span></div>
                <div class="col-lg-6 my-auto order-lg-1 showcase-text">
                    <h2>Buena calidad de mercancia</h2>
                    <p class="lead mb-0">Nuestra mercancia es de la mas alta calidad, importada desde europa. Siempre cumpliendo con los certificados de seguridad respectivos.</p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 text-white showcase-img" style="background-image:url(&quot;img/02.png&quot;);"><span></span></div>
                <div class="col-lg-6 my-auto order-lg-1 showcase-text">
                    <h2>Personal capacitado</h2>
                    <p class="lead mb-0">El personal del viejo continente import es un personal experimentado y estudiado, ofreciendo al cliente mayor seguridad y confianza a la hora de realizar una consulta.</p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image:url(&quot;img/03.png&quot;);"><span></span></div>
                <div class="col-lg-6 my-auto order-lg-1 showcase-text">
                    <h2>Excelente relacion calidad-precio</h2>
                    <p class="lead mb-0">Ofrecemos los productos de mas alta calidad del mercado, al mejor precio posible.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="call-to-action text-white text-center" style="background:url(&quot;assets2/img/bg-masthead.jpg&quot;) no-repeat center center;background-size:cover;">
        <div class="overlay">
            
        </div>

       
    </section>

    
    <script src="assets2/js/jquery.min.js"></script>
    <script src="assets2/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets2/js/bs-animation.js"></script>
    <script src="fw/all.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    
    $('#slider').css({ width: slideWidth, height: slideHeight });
    
    $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
    
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    

    </script>

</body>

</html>