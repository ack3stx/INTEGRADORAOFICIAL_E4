<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="../Estilos/costos.css">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<?php
  session_start();
  include '../Clases/BasedeDatos.php';
  
  $db = new Database();
  $db->conectarDB();

  if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "administrador") {
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="Panel_Admin.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="busqueda_reserva.php">
              <i class="fas fa-book"></i> Reservaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_habitaciones.php">
              <i class="fas fa-bed"></i> Habitaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_huesped.php">
              <i class="fas fa-users"></i> Huesped
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_empleados.php">
              <i class="fas fa-bed"></i> Personal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportes_hotel.php">
              <i class="fas fa-bed"></i> Hotel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_facturacion.php">
              <i class="fas fa-bed"></i> Facturacion
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="costos.php">
              <i class="fas fa-bed"></i> Costos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notificaciones.php">
            <button type="button" class="btn btn-danger position-relative fas fa-envelope">
  <span class="position-absolute top-2 start-75 translate-middle p-1 bg-success border border-light rounded-circle">
    <span class="visually-hidden"></span>
  </span>
</button>
            </a>
          </li>
        </ul>
        <div class="header-right">
          <div class="btn-group">
          <?php
  if (isset($_SESSION["usuario"])) 
  {
    echo "<button class='btn btn-danger dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
              ".$_SESSION["usuario"]."
            </button>";
  }
  ?>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_admin.php">Cuenta</a></li>
  
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../Scripts/Cerrar_Sesion.php">Cerrar Sesión</a></li>
            </ul>
          </div>
          <i class="fas fa-user text-white ml-2"></i>
        </div>
      </div>
    </div>
  </nav>

  
<!-- Contenedor principal -->
<div class="contenedor_cards_tittle">
  <div class="no">
    <p style="margin-bottom: 3%;">
      <p style="color: rgb(116, 13, 13); font-size: 200%;" class="col text-center font-weight-bold"><strong>Habitaciones</strong></p>
  </div>
  <div class="container mt-7">
    <br>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <!-- CARD 1 -->
        <div class="card card-custom">
          <div id="carouselExampleAutoplaying1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Imagenes/habitacioon sencilla 1.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#sencillam">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion sencilla 2.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#sencillam">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion sencilla 3.webp" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#sencillam">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body col text-center">
            <h5 class="card-title">Habitacion Sencilla</h5>
            <p class="card-text">
              <br><br>
              <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>Aire Acondicionado
              <br><br>
              <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
            </p>
            <br><br>
            <a data-bs-toggle="modal" data-bs-target="#sencillam" class="btn btn-danger">Cambiar Precio</a>
          </div>
        </div>
        <br><br>
      </div>

      <!-- CARD 2 -->
      <div class="col-md-4">
        <div class="card card-custom">
          <div id="carouselExampleAutoplaying2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Imagenes/habitacion1.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#doblem">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion doble 2.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#doblem">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion doble 3.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#doblem">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying2" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying2" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body col text-center">
            <h5 class="card-title">Habitacion Doble</h5>
            <p class="card-text">
              <br><br>
              <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
              <br><br>
              <i class="fa-solid fa-bed img"></i>&nbsp;2 camas&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
            </p>
            <br><br>
            <a data-bs-toggle="modal" data-bs-target="#doblem" class="btn btn-danger">Cambiar Precio</a>
          </div>
        </div>
        <br><br>
      </div>
      <div class="col-md-4">

        <!-- CARD 3 -->
        <div class="card card-custom">
          <div id="carouselExampleAutoplaying3" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Imagenes/habitacion king size 1.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#kingm">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion king size 2.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#kingm">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion king size 3.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#kingm">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying3" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying3" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body col text-center">
            <h5 class="card-title">Habitacion King Size</h5>
            <p class="card-text">
              <br><br>
              <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
              <br><br>
              <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
            </p>
            <br><br>
            <a data-bs-toggle="modal" data-bs-target="#kingm" class="btn btn-danger">Cambiar precio</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal Sencilla -->
<div class="modal fade" id="sencillam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Sencilla</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../Scripts/cambiar_costo.php">
            <input class="form-control me-2" type="text" value="sencilla" placeholder="Sencilla" disabled> <br>
            <label for="">Nuevo Costo</label>
            <input class="form-control me-2" type="number">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Doble -->
<div class="modal fade" id="doblem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Doble</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../Scripts/cambiar_costo.php">
            <input class="form-control me-2" type="text" value="doble" placeholder="Doble" disabled> <br>
            <label for="">Nuevo Costo</label>
            <input class="form-control me-2" type="number">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal King Size -->
<div class="modal fade" id="kingm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">King Size</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="../Scripts/cambiar_costo.php">
            <input class="form-control me-2" type="text" value="king size" placeholder="King Size" disabled> <br>
            <label for="">Nuevo Costo</label>
            <input class="form-control me-2" type="number">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
  }
  else
  {
  ?>
  <head>
    <style>
        body, html {
            height: 100%;
        }
        .bg-dark {
            background-color: #343a40 !important;
        }
        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            color: white;
        }
        .error-container {
            text-align: center;
        }
        .error-icon {
            font-size: 100px;
        }
        .error-code {
            font-size: 80px;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 24px;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container flex-center">
        <div class="error-container">
            <i class="fas fa-times-circle error-icon"></i>
            <div class="error-code">404</div>
            <div class="error-message">Pagina no Encontrada</div>
            <p>Es posible que la página que está buscando se haya eliminado, haya cambiado de nombre o no esté disponible temporalmente.</p>
            <a href="../index.php" class="btn btn-primary mt-4">Pagina Principal</a>
        </div>
    </div>
</body>
<?php
  }
?>
</body>
</html>