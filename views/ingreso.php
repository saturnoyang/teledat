<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ricardo Sanchez">

    <title>Ingreso Intranet</title>


    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />

    <link href="views/css/sidebars.css" rel="stylesheet">
  </head>
  <body>

<main >



<div class="container-fluid">
    <div class="row flex-nowrap">
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-secondary" style="width: 190px;">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">


    <a href="dashboard.php" target="iframe" class="d-flex align-items-center pb-3 mb-3 link-light text-decoration-none border-bottom">
      <i class="bi bi-menu-up"></i>
      <span class="fs-5 fw-semibold text-white">&nbsp; Menu</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
            <i class="fs-4 bi-people-fill"></i>&nbsp; Usuarios
        </button>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="usuarios.php?op=1" target="iframe" class="link-dark align-middle rounded"  >Agregar</a></li>
            <li><a href="#" class="link-dark rounded">Seguridad</a></li>
            <li><a href="#" class="link-dark rounded">Consultar</a></li>
            <li><a href="#" class="link-dark rounded">Eliminar</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          <i class="fs-4 bi-wrench"></i> &nbsp; Instaladores
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Agregar</a></li>
            <li><a href="#" class="link-dark rounded">Consultar / Editar</a></li>

          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          <i class="fs-4 bi-table"></i> &nbsp; Bodega
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Proveedores</a></li>
            <li><a href="#" class="link-dark rounded">Bodegas</a></li>
            <li><a href="#" class="link-dark rounded">Productos</a></li>
            <li><a href="#" class="link-dark rounded">Compras</a></li>
            <li><a href="#" class="link-dark rounded">Procesar una entrega</a></li>
            <li><a href="#" class="link-dark rounded">Consultar Entregas</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#herramientas-collapse" aria-expanded="false">
          <i class="bi bi-tools"></i> &nbsp; Herramientas
        </button>
        <div class="collapse" id="herramientas-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Inventario</a></li>
            <li><a href="#" class="link-dark rounded">Prestamo</a></li>
            <li><a href="#" class="link-dark rounded">Devolución</a></li>
          </ul>
        </div>
      </li>

      
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
         <i class="fs-4 bi-truck"></i> &nbsp; Autos
        </button>
        <div class="collapse" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Ingresar</a></li>
            <li><a href="#" class="link-dark rounded">Consultar</a></li>
            <li><a href="#" class="link-dark rounded">Entregar un auto</a></li>
            <li><a href="#" class="link-dark rounded">Reportes</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#pedidos-collapse" aria-expanded="false">
         <i class="fs-4 bi-ui-checks"></i>&nbsp; Pedidos
        </button>
        <div class="collapse" id="pedidos-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Realizar un pedido</a></li>
            <li><a href="#" class="link-dark rounded">Consultar</a></li>
            <li><a href="#" class="link-dark rounded">Regresar Material</a></li>
            <li><a href="#" class="link-dark rounded">Reportes</a></li>
          </ul>
        </div>
      </li>      
      <li class="border-top my-3"></li>
    </ul>
              
    



    <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1"><?php echo $nombre_completo ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">                       
                    <li><a class="dropdown-item" href="#">Cambio de Clave</a></li>
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="index.php">Salir</a></li>
            </ul>
        </div>
            </div>
        </div>





        <div class="col py-3">

<iframe id='iframe' 
    name='iframe' 
    src='dashboard.php' 
    frameborder='0' 
    style='overflow: hidden; height: 100%; width: 80%; position: absolute;' height='100%' width='80%'>
        
</iframe>






        </div>
</div>


</div>

  </main>



  </body>
</html>
