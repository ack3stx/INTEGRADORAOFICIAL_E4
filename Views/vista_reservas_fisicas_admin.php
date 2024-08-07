
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


  $consulta = 'SELECT PERSONA.NOMBRE, PERSONA.APELLIDO_PATERNO, PERSONA.APELLIDO_MATERNO FROM PERSONA, USUARIOS, ROL_USUARIO
  WHERE PERSONA.ID_PERSONA = USUARIOS.ID_USUARIO AND ROL_USUARIO.ID_ROL_USUARIO = USUARIOS.ID_USUARIO AND ROL_USUARIO.ROL = 2';

  $reg = $conexion->seleccionar($consulta);

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
        
        $consulta = "SELECT DISTINCT CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS Nombre_Huesped
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join reservacion on reservacion.recepcionista = recepcionista.id_recepcionista
inner join recepcionista on recepcionista.persona = persona.id_persona
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
group by Nombre, folio_reserva,estado,noches";

        $reservaciones = $conexion->seleccionar($consulta);

        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover table-bordered table-danger'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        echo "<th>Huesped</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Fecha Reservación</th>";
        echo "<th>Estado Reservación</th>";
        echo "<th>Cantidad Habitaciones</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        if ($reservaciones) {
            foreach ($reservaciones as $reservacion) {
                echo "<tr>";
                echo "<td>{$reservacion->Nombre_Huesped}</td>";
                echo "<td>{$reservacion->numero_de_telefono}</td>";
                echo "<td>{$reservacion->fecha_}</td>";
                echo "<td>{$reservacion->estado_reservacion}</td>";
                echo "<td>{$reservacion->Cantidad_de_habitaciones}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron reservaciones para este recepcionista.</td></tr>";
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