<?php
session_start();

if (!isset($_SESSION['detallesHabitaciones']) || !isset($_SESSION['costoTotal']) || !isset($_SESSION['numeroReservacion'])) {
    header("Location: ../index.php");
    exit();
}

include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodoPago = $_POST['metodoPago'];
    $nombreFactura = $_POST['nombreFactura'] ?? null;
    $apellidoPaternoFactura = $_POST['apellidoPaternoFactura'] ?? null;
    $apellidoMaternoFactura = $_POST['apellidoMaternoFactura'] ?? null;
    $direccion = $_POST['direccion'] ?? null;
    $rfc = $_POST['rfc'] ?? null;

    $detallesHabitaciones = $_SESSION['detallesHabitaciones'];
    $costoTotal = $_SESSION['costoTotal'];
    $numeroReservacion = $_SESSION['numeroReservacion'];

    try {
        $costoTotalHabitaciones = 0;
        foreach ($detallesHabitaciones as $detalle) {
            $numHabitacion = $detalle['numHabitacion']; 
            $diasEstancia = (int)$detalle['diasEstancia'];
            $costoTotalHabitacion = $detalle['costoTotalHabitacion'];
            $costoTotalHabitaciones += $costoTotalHabitacion;

            $consultaIdHabitacion = "
                SELECT id_habitacion 
                FROM habitacion
                WHERE num_habitacion = $numHabitacion";
            error_log("Consulta de ID de habitación: $consultaIdHabitacion");
            $resultadoIdHabitacion = $db->seleccionar($consultaIdHabitacion);

            if (empty($resultadoIdHabitacion)) {
                error_log("Resultado de la consulta de ID de habitación está vacío para la habitación número $numHabitacion.");
                throw new Exception("No se pudo obtener el ID de la habitación para el número de habitación $numHabitacion.");
            }

            if (!isset($resultadoIdHabitacion[0]->id_habitacion)) {
                error_log("Campo 'id_habitacion' no encontrado en el resultado de la consulta para el número de habitación $numHabitacion.");
                throw new Exception("No se pudo obtener el ID de la habitación para el número de habitación $numHabitacion.");
            }

            $idHabitacion = $resultadoIdHabitacion[0]->id_habitacion;
            error_log("ID de la habitación: $idHabitacion");

            $consultaFechaFinActual = "
                SELECT fecha_fin 
                FROM detalle_reservacion
                WHERE habitacion = $idHabitacion AND reservacion = $numeroReservacion";
            error_log("Consulta de fecha fin actual: $consultaFechaFinActual");
            $resultadoFechaFinActual = $db->seleccionar($consultaFechaFinActual);

            if (empty($resultadoFechaFinActual)) {
                error_log("Resultado de la consulta de fecha fin actual está vacío para la habitación $idHabitacion en la reservación $numeroReservacion.");
                throw new Exception("No se pudo obtener la fecha de fin actual para la habitación $idHabitacion en la reservación $numeroReservacion.");
            }

            if (!isset($resultadoFechaFinActual[0]->fecha_fin)) {
                error_log("Campo 'fecha_fin' no encontrado en el resultado de la consulta para la habitación $idHabitacion en la reservación $numeroReservacion.");
                throw new Exception("No se pudo obtener la fecha de fin actual para la habitación $idHabitacion en la reservación $numeroReservacion.");
            }

            $fechaFinActual = $resultadoFechaFinActual[0]->fecha_fin;
            error_log("Fecha fin actual: $fechaFinActual");

            $fechaFinActualDatetime = new DateTime($fechaFinActual);
            error_log("Fecha fin actual convertida a DateTime: " . $fechaFinActualDatetime->format('Y-m-d H:i:s'));

            $fechaFinActualDatetime->modify("+$diasEstancia days");
            error_log("Fecha fin actual después de agregar días: " . $fechaFinActualDatetime->format('Y-m-d H:i:s'));

            $fechaFinActualDatetime->setTime(12, 0, 0);
            $nuevaFechaFin = $fechaFinActualDatetime->format('Y-m-d H:i:s');
            error_log("Nueva fecha fin ajustada a las 12:00:00: $nuevaFechaFin");

            $updateConsulta = "
                UPDATE detalle_reservacion
                SET fecha_fin = '$nuevaFechaFin'
                WHERE habitacion = $idHabitacion AND reservacion = $numeroReservacion";
            error_log("Consulta de actualización: $updateConsulta");
            $db->ejecuta($updateConsulta);
        }

        $registrarPagoConsulta = "
            CALL RegistrarPagoReservacion($numeroReservacion, '$metodoPago', $costoTotalHabitaciones)";
        error_log("Consulta de registrar pago: $registrarPagoConsulta");
        $db->ejecuta($registrarPagoConsulta);

        if ($nombreFactura && $apellidoPaternoFactura && $apellidoMaternoFactura && $direccion && $rfc) {
            $registrarFacturacionConsulta = "
                CALL registro_facturacion('$nombreFactura', '$apellidoPaternoFactura', '$apellidoMaternoFactura', '$rfc', '$direccion')";
            error_log("Consulta de registrar facturación: $registrarFacturacionConsulta");
            $db->ejecuta($registrarFacturacionConsulta);
        }

        $db->desconectarBD();
        echo "<script>alert('Pago y extensión de reservación realizados exitosamente.'); window.location.href='reservaciones_activas.php';</script>";
        exit();
    } catch (Exception $e) {
        $db->desconectarBD();
        echo "<script>alert('Error al procesar el pago: " . $e->getMessage() . "'); window.location.href='pagina_de_pago.php';</script>";
        exit();
    }
}
?>
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
<body>
  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Roboto', sans-serif;
    }
    .container {
      max-width: 600px;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-top: 50px;
      position: relative;
    }
    h2, h4 {
      color: #dc3545;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
    .form-control, .form-select {
      border-radius: 0.25rem;
      border-color: #dc3545;
    }
    .form-check-input:checked {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .form-check-input:focus {
      border-color: #dc3545;
    }
    #billingForm {
      border-top: 1px solid #e0e0e0;
      padding-top: 15px;
      margin-top: 15px;
    }
    footer {
      margin-top: 50px;
      text-align: center;
    }
    .footer-link {
      color: #dc3545;
      text-decoration: none;
    }
    .footer-link:hover {
      text-decoration: underline;
    }
    .back-button {
      position: absolute;
      top: 10px;
      right: 10px;
    }
  </style>
  <script>
    function toggleBilling() {
      var checkbox = document.getElementById("facturar");
      var billingForm = document.getElementById("billingForm");
      billingForm.style.display = checkbox.checked ? "block" : "none";
    }
  </script>
    <a href="reservaciones_activas.php" class="btn btn-danger back-button">Regresar</a>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">INFORMACIÓN DE PAGO</h2>
    <?php
    if (isset($_SESSION['mensajesError'])) {
        echo '<div class="alert alert-danger">';
        foreach ($_SESSION['mensajesError'] as $mensaje) {
            echo $mensaje . "<br>";
        }
        echo '</div>';
        unset($_SESSION['mensajesError']);
    }
    ?>
    <form method="POST">
      <h4 class="mb-3">Método de Pago</h4>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="metodoPago" id="tarjetaCredito" value="tarjeta" checked>
        <label class="form-check-label" for="tarjetaCredito">
          Tarjeta de Crédito o Tarjeta de Débito
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="metodoPago" id="efectivo" value="efectivo">
        <label class="form-check-label" for="efectivo">
          Efectivo
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="metodoPago" id="transferencia" value="transferencia">
        <label class="form-check-label" for="transferencia">
          Transferencia
        </label>
      </div>

      <div class="mb-3 mt-4">
        <h4>Resumen de la Reserva</h4>
        <?php 
        if (isset($_SESSION['detallesHabitaciones'])) {
            foreach ($_SESSION['detallesHabitaciones'] as $detalle) : ?>
              <p>Habitación: <?php echo $detalle['nombre']; ?> (Número: <?php echo $detalle['numHabitacion']; ?>)</p>
              <p>Número de días: <?php echo $detalle['diasEstancia']; ?></p>
              <p>Costo por día: <?php echo $detalle['precioHabitacion']; ?></p>
              <p><strong>Costo Total Habitación: <?php echo $detalle['costoTotalHabitacion']; ?></strong></p>
              <hr>
            <?php endforeach; 
        }?>
        <p><strong>Costo Total: <?php echo isset($_SESSION['costoTotal']) ? $_SESSION['costoTotal'] : 'N/A'; ?></strong></p>
      </div>

      <div class="form-check mb-3 mt-4">
        <input type="checkbox" class="form-check-input" id="facturar" onclick="toggleBilling()">
        <label class="form-check-label" for="facturar">Desea Facturar</label>
      </div>

      <div id="billingForm" style="display: none;">
        <h4 class="mb-3">Datos de Facturación</h4>
        <div class="mb-3">
          <label for="nombreFactura" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombreFactura" name="nombreFactura" placeholder="Nombre completo">
        </div>
        <div class="mb-3">
          <label for="apellidoPaternoFactura" class="form-label">Apellido Paterno</label>
          <input type="text" class="form-control" id="apellidoPaternoFactura" name="apellidoPaternoFactura" placeholder="Apellido Paterno">
        </div>
        <div class="mb-3">
          <label for="apellidoMaternoFactura" class="form-label">Apellido Materno</label>
          <input type="text" class="form-control" id="apellidoMaternoFactura" name="apellidoMaternoFactura" placeholder="Apellido Materno">
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle 123, Ciudad, País">
        </div>
        <div class="mb-3">
          <label for="rfc" class="form-label">RFC</label>
          <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC">
        </div>
      </div>

      <button type="submit" class="btn btn-danger w-100">Confirmar Extender la Reservacion </button>
    </form>
    <footer class="mt-4">
      <p>&copy; 2024 Compañía. Hotel Laguna Inn. Todos los derechos reservados.</p>
    </footer>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
