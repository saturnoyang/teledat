<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ricardo Sanchez">
    <title>Teledat INTRANET</title>





    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- Favicons -->
<link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="views/css/carousel.css" rel="stylesheet">
  </head>
  <body>

<header>
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container-fluid">
      <img class="rounded-start" src="views\img\teledat_logo.png" width="200px" height="70px">
      <a class="navbar-brand" href="#">&nbsp; INTRANET</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">

      </div>
        <form name="form1" method="post" action="ingreso.php" autocomplete="off">
          <div class="row">
            <div class="col">
                <input type="text" class="form-control" 
                    placeholder="usuario" aria-label="usuario" name="usr" id="usr">
            </div>
            <div class="col">
                <input type="password" class="form-control" 
                    placeholder="clave" aria-label="clave" name="pswd" id="pswd">
            </div>
            <div class="col">
                <input type="submit" name="button" id="button" value="Ingresar" class="btn btn-outline-success" />
            </div>            
          </div>
        </form>
    </div>
  </nav>
</header>

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner" >
      <div class="carousel-item active">

        <img class="bd-placeholder-img" src="views\img\image-slider-01.jpg" width="100%" height="100%">

      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" src="views\img\image-slider-02.jpg" width="100%" height="100%">


      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" src="views\img\image-slider-03.jpg" width="100%" height="100%">


      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Regresar al Principio</a></p>
    <p>&copy; 2022 Ricardo J. Sanchez Moreno &middot; 
      <a href="#">Privacidad</a> &middot; 
      <a href="#">Terminos</a>
    </p>
  </footer>
</main>





  </body>
</html>
