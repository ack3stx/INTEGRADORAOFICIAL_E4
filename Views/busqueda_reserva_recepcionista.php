<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
  
  <div class="container d-flex justify-content-center mt-4">
    <form class="d-flex justify-content-center w-100 flex-wrap" role="search" method="post">
      <input class="form-control me-2 mb-2" type="number" name="numero" placeholder="Número de la Reservación">
      <input class="form-control me-2 mb-2" type="date" name="fecha1">
      <input class="form-control me-2 mb-2" type="date" name="fecha2">
      <select name="cancelada" class="form-select">
        <option value="todos">Todos</option>
        <option value="cancelada">Canceladas</option>
      </select>
      <button class="btn btn-outline-danger mb-2" type="submit">Buscar</button>
    </form>
  </div>

  <div class="container">
  <?php 
    extract($_POST);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      if(empty($numero) && empty($fecha1) && empty($fecha2) && $cancelada=="todos") {
        echo "<p>Por favor, ingresa los datos para realizar la búsqueda.</p>";
      } else {
        if (empty($numero)) {
          
          if ($cancelada == "todos") {
            $where= "WHERE DETALLE_RESERVACION.FECHA_INICIO BETWEEN '$fecha1' AND '$fecha2'
                        AND DETALLE_RESERVACION.FECHA_FIN BETWEEN '$fecha1' AND '$fecha2' AND DETALLE_PAGO.MONTO_TOTAL!=0";
        } elseif ($cancelada == "cancelada") {
            $where= "WHERE DETALLE_PAGO.MONTO_TOTAL=0";
        }
        
$consulta = "SELECT DISTINCT
    RESERVACION.ID_RESERVACION, 
    CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_HUESPED, 
    PERSONA.NUMERO_DE_TELEFONO, 
    RESERVACION.FECHA_,
    RESERVACION.ESTADO_RESERVACION
FROM 
    USUARIOS
INNER JOIN 
    PERSONA ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
INNER JOIN 
    HUESPED ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
INNER JOIN 
    RESERVACION ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
INNER JOIN 
    DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
INNER JOIN 
    DETALLE_PAGO ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
$where
GROUP BY 
    RESERVACION.ID_RESERVACION, 
    PERSONA.NOMBRE, 
    PERSONA.APELLIDO_PATERNO, 
    PERSONA.APELLIDO_MATERNO, 
    PERSONA.NUMERO_DE_TELEFONO, 
    RESERVACION.FECHA_, 
    RESERVACION.ESTADO_RESERVACION;
";

        } else {
          if ($cancelada == "todos") {
            $where = "WHERE RESERVACION.ID_RESERVACION = '$numero' AND DETALLE_PAGO.MONTO_TOTAL!=0";
        } elseif ($cancelada == "cancelada") {
            $where = "WHERE DETALLE_PAGO.MONTO_TOTAL=0";
        }

$consulta = "SELECT DISTINCT
    RESERVACION.ID_RESERVACION, 
    CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_HUESPED, 
    PERSONA.NUMERO_DE_TELEFONO, 
    RESERVACION.FECHA_,
    RESERVACION.ESTADO_RESERVACION
FROM 
    USUARIOS
INNER JOIN 
    PERSONA ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
INNER JOIN 
    HUESPED ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
INNER JOIN 
    RESERVACION ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
INNER JOIN 
    DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
INNER JOIN 
    DETALLE_PAGO ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
$where
GROUP BY 
    RESERVACION.ID_RESERVACION, 
    PERSONA.NOMBRE, 
    PERSONA.APELLIDO_PATERNO, 
    PERSONA.APELLIDO_MATERNO, 
    PERSONA.NUMERO_DE_TELEFONO, 
    RESERVACION.FECHA_, 
    RESERVACION.ESTADO_RESERVACION;
";
        }

        $tabla = $conexion->seleccionar($consulta);

        if (empty($tabla)) {
          echo "<p>No se encontraron reservaciones.</p>";
        } else {
          echo "<div class='table-responsive'>";
          echo "<table class='table table-hover table-bordered table-danger'>";
          echo "<thead class='table-dark'>";
          echo "<tr>";
          echo "<th>Folio Reservacion</th>";
          echo "<th>Nombre</th>";
          echo "<th>Teléfono</th>";
          echo "<th>Fecha Reservación</th>";
          echo "<th>Estado Reservación</th>";
          echo "<th>Acciones</th>";
          echo "</tr>";
          echo "</thead>";
          echo "<tbody>";

          foreach ($tabla as $reg) {
            echo "<tr>";
            echo "<td>{$reg->ID_RESERVACION}</td>";
            echo "<td>{$reg->NOMBRE_HUESPED}</td>";
            echo "<td>{$reg->NUMERO_DE_TELEFONO}</td>";
            echo "<td>{$reg->FECHA_}</td>";
            echo "<td>{$reg->ESTADO_RESERVACION}</td>";
            echo "<td>";
            $consultona = "
            SELECT
    DETALLE_RESERVACION.FECHA_INICIO, 
    DETALLE_RESERVACION.FECHA_FIN, 
    DETALLE_PAGO.MONTO_TOTAL,
    DETALLE_PAGO.METODO_PAGO,
    T_HABITACION.NOMBRE AS TIPO_HABITACION,
    COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_HABITACIONES,
    (T_HABITACION.PRECIO * COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION)) AS PRECIO_TOTAL_POR_TIPO
FROM 
    DETALLE_PAGO
JOIN 
    RESERVACION ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
JOIN 
    HUESPED ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
JOIN 
    PERSONA ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
JOIN 
    USUARIOS ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
JOIN 
    DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
JOIN 
    HABITACION ON DETALLE_RESERVACION.HABITACION = HABITACION.ID_HABITACION
JOIN 
    T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
WHERE 
    RESERVACION.ID_RESERVACION = {$reg->ID_RESERVACION}
GROUP BY 
    DETALLE_RESERVACION.FECHA_INICIO, 
    DETALLE_RESERVACION.FECHA_FIN, 
    DETALLE_PAGO.MONTO_TOTAL,
    DETALLE_PAGO.METODO_PAGO,
    T_HABITACION.NOMBRE, 
    T_HABITACION.PRECIO;
        ";

        $datos_facturacion = $conexion->seleccionar($consultona);
            $precio_total_reservacion = 0;

            // Inicia el modal
            echo "<!-- Button trigger modal -->
            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBack{$reg->ID_RESERVACION}'>
                Detalles
            </button>
            
            <!-- Modal -->
            <div class='modal fade' id='staticBack{$reg->ID_RESERVACION}' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel{$reg->ID_RESERVACION}' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='staticBackdropLabel{$reg->ID_RESERVACION}'>Detalles Reservacion</h1>
                </div>
                <div class='modal-body'>";

            foreach ($datos_facturacion as $facturacion) {
                echo "<label>FECHA DEL CHECK IN: {$facturacion->FECHA_INICIO}</label><br>
                <label>FECHA DEL CHECK OUT: {$facturacion->FECHA_FIN}</label><br>
                <label>Tipo de Habitación: {$facturacion->TIPO_HABITACION}</label><br>
                <label>Cantidad de Habitaciones: {$facturacion->CANTIDAD_HABITACIONES}</label><br>
                <label>Precio Total por Tipo: {$facturacion->PRECIO_TOTAL_POR_TIPO}</label><br><br>";

                $precio_total_reservacion += $facturacion->PRECIO_TOTAL_POR_TIPO;
            }

            echo "<label>Monto Total De La Reservacion: {$precio_total_reservacion}</label><br>
                <label>Método De Pago: {$datos_facturacion[0]->METODO_PAGO}</label><br>
                </div>
            
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                </div>
                </div>
            </div>
            </div>";
            echo "</td></tr>";
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