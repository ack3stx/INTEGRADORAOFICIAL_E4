
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionista.css">
    <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
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
              <i class="fas fa-book"></i> Reservaciones Fisicas
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
    <br>
    <form class="d-flex" role="search" method="post">
    <div class="container">
        <h4 class="color-hotel">Búsqueda de reservaciones por recepcionista</h4>
        <?php
            $consultaRecepcionistas = 'SELECT RECEPCIONISTA.ID_RECEPCIONISTA, PERSONA.NOMBRE, PERSONA.APELLIDO_PATERNO, PERSONA.APELLIDO_MATERNO 
                                       FROM RECEPCIONISTA
                                       JOIN PERSONA ON RECEPCIONISTA.PERSONA_RECEPCIONISTA = PERSONA.ID_PERSONA';

            $recepcionistas = $conexion->seleccionar($consultaRecepcionistas);

            if ($recepcionistas) {
                echo "<select class='form-select' name='recepcionista_id'>";
                foreach($recepcionistas as $recepcionista) {
                    echo "<option value='".$recepcionista->ID_RECEPCIONISTA."'>".$recepcionista->NOMBRE." ".$recepcionista->APELLIDO_PATERNO." ".$recepcionista->APELLIDO_MATERNO."</option>";
                }
                echo "</select>";
            } else {
                echo "No se encontraron recepcionistas.";
            }
        ?>
        <button class="btn btn-outline-danger" type="submit">Buscar</button>
    </div>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    extract($_POST);

    if (isset($recepcionista_id)) {
        $consulta = "
        SELECT DISTINCT 
            CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS Nombre_Huesped, 
            reservacion.id_reservacion AS folio_reserva, 
            reservacion.estado_reservacion AS estado, 
            reservacion.FECHA_ AS fecha_reservacion,
            detalle_reservacion.FECHA_INICIO as fecha_inicio,
            detalle_reservacion.FECHA_FIN as fecha_fin,
            t_habitacion.NOMBRE as tipo_habitacion,
            t_habitacion.PRECIO as precio_habitacion
        FROM usuarios AS usuario_recepcionista
        INNER JOIN persona AS persona_recepcionista ON persona_recepcionista.usuario = usuario_recepcionista.id_usuario
        INNER JOIN recepcionista ON recepcionista.persona_recepcionista = persona_recepcionista.id_persona
        INNER JOIN reservacion ON reservacion.recepcionista = recepcionista.id_recepcionista
        INNER JOIN huesped ON reservacion.huesped = huesped.id_huesped
        INNER JOIN persona ON huesped.persona_huesped = persona.id_persona
        INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion = reservacion.id_reservacion
        JOIN habitacion ON detalle_reservacion.HABITACION = habitacion.ID_HABITACION
        JOIN t_habitacion ON habitacion.TIPO_HABITACION = t_habitacion.ID_TIPO_HABITACION
        WHERE recepcionista.id_recepcionista = $recepcionista_id
        GROUP BY Nombre_Huesped, folio_reserva, estado, fecha_reservacion, fecha_inicio, fecha_fin, tipo_habitacion, precio_habitacion
        ORDER BY reservacion.FECHA_";

        $reservaciones = $conexion->seleccionar($consulta);

        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover table-bordered table-danger'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        echo "<th>Huésped</th>";
        echo "<th>Folio Reserva</th>";
        echo "<th>Estado</th>";
        echo "<th>Fecha Reservación</th>";
        echo "<th>Fecha Inicio</th>";
        echo "<th>Fecha Fin</th>";
        echo "<th>Tipo Habitación</th>";
        echo "<th>Precio Habitación</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if ($reservaciones) {
            foreach ($reservaciones as $reservacion) {
                echo "<tr>";
                echo "<td>{$reservacion->Nombre_Huesped}</td>";
                echo "<td>{$reservacion->folio_reserva}</td>";
                echo "<td>{$reservacion->estado}</td>";
                echo "<td>{$reservacion->fecha_reservacion}</td>";
                echo "<td>{$reservacion->fecha_inicio}</td>";
                echo "<td>{$reservacion->fecha_fin}</td>";
                echo "<td>{$reservacion->tipo_habitacion}</td>";
                echo "<td>{$reservacion->precio_habitacion}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No se encontraron reservaciones para este recepcionista.</td></tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }

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