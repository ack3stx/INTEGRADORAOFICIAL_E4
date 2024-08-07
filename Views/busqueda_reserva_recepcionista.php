<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
</head>

<body>
<?php
  session_start();
  include '../Clases/BasedeDatos.php';
  $conexion = new Database();
  $conexion->conectarDB();

  if (isset($_SESSION["usuario"]) && isset($_SESSION["rol"]) && $_SESSION["rol"] == "recepcionista") {
?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="panel_recepcionista.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="calendariore.php">
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
            <a class="nav-link" href="notificaciones_recepcionista.php">
            <button type="button" class="btn btn-danger position-relative fas fa-envelope">
              <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                <span class="visually-hidden"></span>
              </span>
            </button>
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
      if(empty($numero) && empty($fecha1) && empty($fecha2))
      {

      }
      else
      {
        if (empty($numero)) {
          $consulta = "SELECT DISTINCT CONCAT(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion, COUNT(detalle_reservacion.id_detalle_reservacion) AS Cantidad_de_habitaciones
          FROM usuarios
          INNER JOIN persona ON persona.usuario=usuarios.id_usuario
          INNER JOIN huesped ON huesped.persona_huesped=persona.id_persona
          INNER JOIN reservacion ON reservacion.huesped=huesped.id_huesped
          INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion=reservacion.id_reservacion
          WHERE reservacion.fecha_ BETWEEN '$fecha1' AND '$fecha2'
          GROUP BY Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion";
        } else {
          $consulta = "SELECT DISTINCT CONCAT(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion, COUNT(detalle_reservacion.id_detalle_reservacion) AS Cantidad_de_habitaciones
          FROM usuarios
          INNER JOIN persona ON persona.usuario=usuarios.id_usuario
          INNER JOIN huesped ON huesped.persona_huesped=persona.id_persona
          INNER JOIN reservacion ON reservacion.huesped=huesped.id_huesped
          INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion=reservacion.id_reservacion
          WHERE reservacion.id_reservacion=$numero
          GROUP BY Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion";
        }

        $tabla = $conexion->seleccionar($consulta);
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
          echo "<td>{$reg->Nombre_Huesped}</td>";
          echo "<td>{$reg->numero_de_telefono}</td>";
          echo "<td>{$reg->fecha_}</td>";
          echo "<td>{$reg->estado_reservacion}</td>";
          echo "<td>{$reg->Cantidad_de_habitaciones}</td>";
          echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
      }
        $conexion->desconectarBD();
      
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
