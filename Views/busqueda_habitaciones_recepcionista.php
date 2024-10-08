<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
</head>

<?php
  session_start();
  include '../Clases/BasedeDatos.php';
  
  $conexion = new Database();
  $conexion->conectarDB();

  if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "recepcionista") {
?>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="Panel_Recepcionista.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="Calendariore.php">
              <i class="fas fa-calendar-plus"></i> Crear Reserva
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_reserva_recepcionista.php">
              <i class="fas fa-book"></i> Reservaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_habitaciones_recepcionista.php">
              <i class="fas fa-bed"></i> Habitaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_huesped_recepcionista.php">
              <i class="fas fa-users"></i> Huesped
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="check_in.php">
              <i class="fas fa-users"></i> Check-in
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="check_out.php">
              <i class="fas fa-users"></i> Check-out
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reservaciones_activas.php">
              <i class="fas fa-users"></i> Extender
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Incidencias.php">
              <i class="fas fa-users"></i>incidencias
            </a>
          </li>
        </ul>
        <div class="header-right">
          <div class="btn-group">
          <?php
            if (isset($_SESSION["usuario"])) {
              echo "<button class='btn btn-danger dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                      ".$_SESSION["usuario"]."
                    </button>";
            }
          ?>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
              
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
  <br>
    <div class="container">

      <div id="alertContainer">
      <?php
      if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        HABITACION agregada correctamente.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      ?>
    </div>

      <div class="modal fade" id="modalhabitaciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Nueva HABITACION</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../Scripts/agregar_habitaciones.php" method="post" id="habitacionesForm" class="toggle-form">
              <select class="form-control me-2" id="roomStatus" name="roomStatus" required>
                <option class="form-control me-2" value="1">Doble</option>
                <option class="form-control me-2" value="2">King Size</option>
                <option class="form-control me-2" value="3">Sencilla</option>
              </select><br>
              <button class="btn btn-outline-danger" type="submit">Agregar</button>
              <input type="hidden" name="form_submitted" value="1">
            </form>
              
            </div>

          </div>
        </div>
      </div>
      <br>
      <h4 class="color-hotel">Busqueda</h4>
      <form class="d-flex" role="search" method="post">
        <label class="color-hotel">Tipo:</label>&nbsp;
        <select class="form-control me-2" name="tipo">
          <option value="Sencilla">Sencilla</option>
          <option value="Doble">Doble</option>
          <option value="King size">King size</option>
        </select>&nbsp;
        <label class="color-hotel">Estado:</label>&nbsp;
        <select name="estado">
          <option value="ocupada">Ocupada</option>
          <option value="mantenimiento">Mantenimiento</option>
          <option value="disponible">Disponible</option>
        </select>&nbsp;
        <button class="btn btn-outline-danger" type="submit">Buscar</button>
      </form>
      <br>
      <?php
      extract($_POST);
      if ($_POST) {
        $consulta = "SELECT HABITACION.NUM_HABITACION, HABITACION.PISO, HABITACION.ESTADO_HABITACION, T_HABITACION.NOMBRE,
        T_HABITACION.DESCRIPCION, T_HABITACION.PRECIO, T_HABITACION.CANTIDAD_MAX_ADULTOS, T_HABITACION.CANTIDAD_MAX_NINOS
        FROM HABITACION
        INNER JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
        WHERE T_HABITACION.NOMBRE = '$tipo' AND HABITACION.ESTADO_HABITACION = '$estado'";

        $tabla = $conexion->seleccionar($consulta);

        echo "
            <div class='table-responsive'>
        <table class='table table-hover table-bordered table-danger'>
            <thead class='table-dark'>
                <tr>
                    <th text-white>Num HABITACION</th>
                    <th text-white>Piso</th>
                    <th text-white>Estado</th>
                    <th text-white>Tipo</th>
                    <th text-white>Descripcion</th>
                    <th text-white>Costo</th>
                    <th text-white>Cant Max Adultos</th>
                    <th text-white>Cant Max Niños</th>
                    </tr>
                </thead>
                <tbody>
            ";
        foreach ($tabla as $reg) {
          echo "<tr>";
          echo "<td> $reg->NUM_HABITACION </td>";
          echo "<td> $reg->PISO </td>";
          echo "<td> $reg->ESTADO_HABITACION </td>";
          echo "<td> $reg->NOMBRE </td>";
          echo "<td> $reg->DESCRIPCION </td>";
          echo "<td> $reg->PRECIO </td>";
          echo "<td> $reg->CANTIDAD_MAX_ADULTOS </td>";
          echo "<td> $reg->CANTIDAD_MAX_NINOS </td>";
          echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>
            </div>";
        $conexion->desconectarBD();

      }
      ?>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <?php
    $conexion->desconectarBD();
  } else {
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
