<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionista.css">
    <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
</head>
<body>
<?php
  session_start();
  include '../Clases/BasedeDatos.php';
  
  $conexion = new Database();
  $conexion->conectarDB();

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
            <a class="nav-link" href="vista_reservas_fisicas_admin.php">
              <i class="fas fa-book"></i> Reservas Fisicas
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
              <i class="fas fa-user"></i> Personal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportes_hotel.php">
              <i class="fas fa-hotel"></i> Hotel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_facturacion.php">
              <i class="fas fa-file-alt"></i> Facturacion
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="costos.php">
              <i class="fas fa-dollar-sign"></i> Costos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notificaciones.php">
            <button type="button" class="btn btn-danger position-relative fas fa-envelope">
  <span class="position-absolute top-1 start-75 translate-middle p-1 bg-success border border-light rounded-circle">
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
  
  <div class="container d-flex justify-content-center mt-4">
    <form class="d-flex justify-content-center w-100 flex-wrap" role="search" method="post">
      <input class="form-control me-2 mb-2" type="number" name="numero" placeholder="Número de la Reservación">
      <input class="form-control me-2 mb-2" type="date" name="fecha1">
      <input class="form-control me-2 mb-2" type="date" name="fecha2">
      <button class="btn btn-outline-danger mb-2" type="submit">Buscar</button>
    </form>
  </div>

  <div class="container">
  <?php 
    extract($_POST);

    // Verifica si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Si no se proporcionan datos, muestra el formulario vacío
      if(empty($numero) && empty($fecha1) && empty($fecha2)) {
        echo "<p>Por favor, ingresa los datos para realizar la búsqueda.</p>";
      } else {
        // Realiza la consulta dependiendo si el número está vacío o no
        if (empty($numero)) {
          $consulta = "SELECT DISTINCT CONCAT(PERSONA.NOMBRE,' ',PERSONA.APELLIDO_PATERNO,' ',PERSONA.APELLIDO_MATERNO) AS NOMBRE_HUESPED, PERSONA.NUMERO_DE_TELEFONO, RESERVACION.FECHA_, RESERVACION.ESTADO_RESERVACION, COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_DE_HABITACIONES
          FROM USUARIOS
          INNER JOIN PERSONA ON PERSONA.USUARIO=USUARIOS.ID_USUARIO
          INNER JOIN HUESPED ON HUESPED.PERSONA_HUESPED=PERSONA.ID_PERSONA
          INNER JOIN RESERVACION ON RESERVACION.HUESPED=HUESPED.ID_HUESPED
          INNER JOIN DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION=RESERVACION.ID_RESERVACION
          WHERE RESERVACION.FECHA_ BETWEEN '$fecha1' AND '$fecha2'
          GROUP BY NOMBRE_HUESPED, PERSONA.NUMERO_DE_TELEFONO, RESERVACION.FECHA_, RESERVACION.ESTADO_RESERVACION";
        } else {
          $consulta = "SELECT DISTINCT CONCAT(PERSONA.NOMBRE,' ',PERSONA.APELLIDO_PATERNO,' ',PERSONA.APELLIDO_MATERNO) AS NOMBRE_HUESPED, PERSONA.NUMERO_DE_TELEFONO, RESERVACION.FECHA_, RESERVACION.ESTADO_RESERVACION, COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_DE_HABITACIONES
          FROM USUARIOS
          INNER JOIN PERSONA ON PERSONA.USUARIO=USUARIOS.ID_USUARIO
          INNER JOIN HUESPED ON HUESPED.PERSONA_HUESPED=PERSONA.ID_PERSONA
          INNER JOIN RESERVACION ON RESERVACION.HUESPED=HUESPED.ID_HUESPED
          INNER JOIN DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION=RESERVACION.ID_RESERVACION
          WHERE RESERVACION.ID_RESERVACION=$numero
          GROUP BY NOMBRE_HUESPED, PERSONA.NUMERO_DE_TELEFONO, RESERVACION.FECHA_, RESERVACION.ESTADO_RESERVACION";
        }

        $tabla = $conexion->seleccionar($consulta);

        // Verifica si se encontraron resultados
        if (empty($tabla)) {
          echo "<p>No se encontraron reservaciones.</p>";
        } else {
          echo "<div class='table-responsive'>";
          echo "<table class='table table-hover table-bordered table-danger'>";
          echo "<thead class='table-dark'>";
          echo "<tr>";
          echo "<th>Nombre</th>";
          echo "<th>Teléfono</th>";
          echo "<th>Fecha Reservación</th>";
          echo "<th>Estado Reservación</th>";
          echo "<th>Cantidad Habitaciones</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          foreach ($tabla as $reg) {
            echo "<tr>";
            echo "<td>{$reg->NOMBRE_HUESPED}</td>";
            echo "<td>{$reg->NUMERO_DE_TELEFONO}</td>";
            echo "<td>{$reg->FECHA_}</td>";
            echo "<td>{$reg->ESTADO_RESERVACION}</td>";
            echo "<td>{$reg->CANTIDAD_DE_HABITACIONES}</td>";
            echo "</tr>";
          }

          echo "</tbody>";
          echo "</table>";
          echo "</div>";
        }
      }
      
      $conexion->desconectarBD();
    }
  ?>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
