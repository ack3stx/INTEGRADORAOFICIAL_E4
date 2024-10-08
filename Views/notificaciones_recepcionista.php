<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laguna Inn</title>
  <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
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

  if($_SESSION["rol"]=="recepcionista")
  {
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
              <i class="fas fa-users"></i>Extender
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
            if (isset($_SESSION["usuario"])) 
            {
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

  <?php
    $conexion->desconectarBD();
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
    <?php

$db = new Database();
$db->conectarDB();

extract($_POST);

$cadena = "SELECT RESERVACION.ID_RESERVACION AS FOLIO, RESERVACION.FECHA_, CONCAT(PERSONA.NOMBRE, PERSONA.APELLIDO_PATERNO, PERSONA.APELLIDO_MATERNO) AS NOMBRE,
PERSONA.NUMERO_DE_TELEFONO, USUARIOS.CORREO, DETALLE_PAGO.MONTO_TOTAL, DETALLE_PAGO.METODO_PAGO, DETALLE_PAGO.ID_DETALLE_PAGO, COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD
FROM USUARIOS
INNER JOIN PERSONA ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
INNER JOIN HUESPED ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
INNER JOIN RESERVACION ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
INNER JOIN DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
INNER JOIN DETALLE_PAGO ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
WHERE RESERVACION.ESTADO_RESERVACION = 'proceso'
GROUP BY FOLIO, RESERVACION.FECHA_, NOMBRE,
PERSONA.NUMERO_DE_TELEFONO, USUARIOS.CORREO, DETALLE_PAGO.MONTO_TOTAL, DETALLE_PAGO.METODO_PAGO";
$tabla = $db->seleccionar($cadena);

$cadena2 = "SELECT DATOS_FACTURACION.DETALLE_PAGO FROM DATOS_FACTURACION;";
$consultita = $db->seleccionar($cadena2);

$facturacion_detalles = array_map(function($item) { return $item->DETALLE_PAGO; }, $consultita);

echo "
<div class='table-responsive'>
    <table class='table table-hover table-bordered table-danger'>
        <thead class='table-dark'>
            <tr>
                <th text-white>Folio</th>
                <th text-white>Fecha</th>
                <th text-white>Nombre</th>
                <th text-white>Telefono</th>
                <th text-white>Correo</th>
                <th text-white>Monto Total</th>
                <th text-white>Método de Pago</th>
                <th text-white>Habitaciones</th>
                <th text-white>Detalles</th>
            </tr>
        </thead>
        <tbody>
";

foreach ($tabla as $reg) {
    echo "
            <tr>
                <td>{$reg->FOLIO}</td>
                <td>{$reg->FECHA_}</td>
                <td>{$reg->NOMBRE}</td>
                <td>{$reg->NUMERO_DE_TELEFONO}</td>
                <td>{$reg->CORREO}</td>
                <td>{$reg->MONTO_TOTAL}</td>
                <td>{$reg->METODO_PAGO}</td>
                <td>{$reg->CANTIDAD}</td>
                <td>";
    if (isset($reg->ID_DETALLE_PAGO) && in_array($reg->ID_DETALLE_PAGO, $facturacion_detalles)) 
    {
        $consultona = "SELECT DATOS_FACTURACION.NOMBRE, DATOS_FACTURACION.APELLIDO_PATERNO, DATOS_FACTURACION.APELLIDO_MATERNO, DATOS_FACTURACION.RFC, DATOS_FACTURACION.DIRECCION 
                      FROM DATOS_FACTURACION
                      WHERE DATOS_FACTURACION.DETALLE_PAGO = {$reg->ID_DETALLE_PAGO}";
        $datos_facturacion = $db->seleccionar($consultona);

        if (!empty($datos_facturacion)) {
            $facturacion = $datos_facturacion[0];
            echo "<!-- Button trigger modal -->
<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#staticBackdrop{$reg->ID_DETALLE_PAGO}'>
  Factura
</button>

<!-- Modal -->
<div class='modal fade' id='staticBackdrop{$reg->ID_DETALLE_PAGO}' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel{$reg->ID_DETALLE_PAGO}' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='staticBackdropLabel{$reg->ID_DETALLE_PAGO}'>Datos de Facturacion</h1>
      </div>
      <div class='modal-body'>
        <label>Nombre: {$facturacion->NOMBRE}</label><br>
        <label>Apellido Paterno: {$facturacion->APELLIDO_PATERNO}</label><br>
        <label>Apellido Materno: {$facturacion->APELLIDO_MATERNO}</label><br>
        <label>RFC: {$facturacion->RFC}</label><br>
        <label>Dirección: {$facturacion->DIRECCION}</label><br>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
      </div>
    </div>
  </div>
</div>";
        }
    }
    echo "<!-- Button trigger modal -->
<button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#staticBackdrop1{$reg->FOLIO}'>
  Cancelar
</button>

<!-- Modal -->
<div class='modal fade' id='staticBackdrop1{$reg->FOLIO}' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel{$reg->FOLIO}' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5 fas fa-exclamation-triangle' id='staticBackdropLabel{$reg->FOLIO}'>&nbsp;ALERTA</h1>
      </div>
      <div class='modal-body'>
        <h4>Seguro que deseas cancelar esta reservacion?</h4>
      </div>
      <div class='modal-footer'>
        <form method='post' action='../Scripts/cancelacion_reservacion.php'>
          <input type='hidden' name='ID_RESERVACION' value='{$reg->FOLIO}'>
          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
          <button type='submit' class='btn btn-danger'>Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>
                </tr>
    ";
}

echo "
        </tbody>
    </table>
</div>
";

$db->desconectarBD();
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
