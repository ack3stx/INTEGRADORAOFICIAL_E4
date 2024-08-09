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

<style>
  .custom-select {
  width: 70%;
  padding: 5px;
  font-size: 16px;
  border-radius: 8px;
  border: 1px solid #ccc;
  background-color: #f8f9fa;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.custom-select:hover {
  border-color: rgb(116, 13, 13);
}

.custom-select:focus {
  outline: none;
  border-color: rgb(116, 13, 13);
  box-shadow: 0 0 5px rgb(116, 13, 13);
}

</style>
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
                echo "<select class='form-select custom-select' name='recepcionista_id'>";
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
<br><br>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    extract($_POST);

    if (isset($recepcionista_id)) {
        $consulta = "
        SELECT DISTINCT 
            CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_HUESPED, 
            RESERVACION.ID_RESERVACION AS FOLIO_RESERVA, 
            RESERVACION.ESTADO_RESERVACION AS ESTADO, 
            RESERVACION.FECHA_ AS FECHA_RESERVACION,
            DETALLE_RESERVACION.FECHA_INICIO AS FECHA_INICIO,
            DETALLE_RESERVACION.FECHA_FIN AS FECHA_FIN,
            T_HABITACION.NOMBRE AS TIPO_HABITACION,
            DETALLE_PAGO.MONTO_TOTAL AS MONTO_PAGADO
        FROM USUARIOS AS USUARIO_RECEPCIONISTA
        INNER JOIN PERSONA AS PERSONA_RECEPCIONISTA ON PERSONA_RECEPCIONISTA.USUARIO = USUARIO_RECEPCIONISTA.ID_USUARIO
        INNER JOIN RECEPCIONISTA ON RECEPCIONISTA.PERSONA_RECEPCIONISTA = PERSONA_RECEPCIONISTA.ID_PERSONA
        INNER JOIN RESERVACION ON RESERVACION.RECEPCIONISTA = RECEPCIONISTA.ID_RECEPCIONISTA
        INNER JOIN HUESPED ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
        INNER JOIN PERSONA ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
        INNER JOIN DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
        INNER JOIN DETALLE_PAGO ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
        JOIN HABITACION ON DETALLE_RESERVACION.HABITACION = HABITACION.ID_HABITACION
        JOIN T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
        WHERE RECEPCIONISTA.ID_RECEPCIONISTA = $recepcionista_id
        GROUP BY NOMBRE_HUESPED, FOLIO_RESERVA, ESTADO, FECHA_RESERVACION, FECHA_INICIO, FECHA_FIN, TIPO_HABITACION, MONTO_PAGADO
        ORDER BY RESERVACION.FECHA_";

        $reservaciones = $conexion->seleccionar($consulta);

        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover table-bordered table-danger'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        echo "<th>Huésped</th>";
        echo "<th>Folio Reserva</th>";
        
        echo "<th>Fecha Reservación</th>";
        echo "<th>Fecha Inicio</th>";
        echo "<th>Fecha Fin</th>";
        echo "<th>Tipo Habitación</th>";
        echo "<th>Monto Pagado</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if ($reservaciones) {
            foreach ($reservaciones as $reservacion) {
                echo "<tr>";
                echo "<td>{$reservacion->NOMBRE_HUESPED}</td>";
                echo "<td>{$reservacion->FOLIO_RESERVA}</td>";
                
                echo "<td>{$reservacion->FECHA_RESERVACION}</td>";
                echo "<td>{$reservacion->FECHA_INICIO}</td>";
                echo "<td>{$reservacion->FECHA_FIN}</td>";
                echo "<td>{$reservacion->TIPO_HABITACION}</td>";
                echo "<td>{$reservacion->MONTO_PAGADO}</td>";
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
