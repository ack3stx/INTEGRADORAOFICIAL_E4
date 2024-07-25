<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $detalleIds = $_POST['detalleId'];
    $titularHabitaciones = $_POST['titularHabitacion'];

    try {
        for ($i = 0; $i < count($detalleIds); $i++) {
            $detalleReservacion = $detalleIds[$i];
            $nombreTitularReservacion = $titularHabitaciones[$i];

            if (trim($nombreTitularReservacion) === '') {
                throw new Exception("Todos los campos de Titular Habitación deben estar llenos.");
            }

            $consulta = "CALL check_in_huesped($detalleReservacion, '$nombreTitularReservacion')";
            $db->ejecuta($consulta);
        }
        $db->desconectarBD();
        header("Location: check_in.php?success=1");
        exit;
    } catch (Exception $e) {
        $db->desconectarBD();
        header("Location: check_in.php?error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    $consulta = "
        SELECT 
            reservacion.id_reservacion as 'Numero_Reservacion',
            CONCAT(persona.Nombre, ' ', persona.Apellido_paterno, ' ', persona.apellido_materno) AS Nombre_Completo,
            detalle_reservacion.ID_DETALLE_RESRVACION,
            detalle_reservacion.FECHA_INICIO,
            detalle_reservacion.FECHA_FIN,
            detalle_reservacion.TITULAR_HABITACION,
            habitacion.NUM_HABITACION,
            t_habitacion.NOMBRE as NOMBRE_HABITACION
        FROM persona
        JOIN huesped ON huesped.persona_huesped = persona.id_persona
        JOIN reservacion ON reservacion.huesped = huesped.persona_huesped
        JOIN detalle_reservacion ON detalle_reservacion.reservacion = reservacion.id_reservacion
        JOIN habitacion ON habitacion.id_habitacion = detalle_reservacion.habitacion
        JOIN t_habitacion ON t_habitacion.ID_TIPO_HABITACION = habitacion.TIPO_HABITACION
        WHERE reservacion.estado_reservacion = 'pendiente'
        AND DATE(detalle_reservacion.fecha_inicio) = CURDATE();";

    $tabla = $db->seleccionar($consulta);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
    </head>
    <body>
        
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
          <a class="navbar-brand" href="panel_recepcionista.php">Hotel Laguna Inn</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="calendario.php">
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
          session_start();
          if (isset($_SESSION["usuario"])) 
          {
            echo "<button class='btn btn-danger dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                      ".$_SESSION["usuario"]."
                    </button>";
          }
          ?>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
                  <li><a class="dropdown-item" href="#">Historial</a></li>
                  <li><a class="dropdown-item" href="#">Opciones</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item text-danger" href="../Scripts/Cerrar_Sesion.php">Cerrar Sesión</a></li>
                </ul>
              </div>
              <i class="fas fa-user text-white ms-2"></i>
            </div>
          </div>
        </div>
    </nav>

    <div class='table-responsive'>
        <h1 class='text-center bg-danger text-white'>Reservaciones Programadas Para Hoy...</h1>
        <br>
        <table class='table table-hover table-bordered table-danger'>
            <thead class='table-dark'>
                <tr>
                    <th class='text-white'>Numero_Reservacion</th>
                    <th class='text-white'>Nombre_Completo</th>
                    <th class='text-white'>Registrar Check-IN</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $reservaciones = [];
    foreach ($tabla as $reg) {
        $reservaciones[$reg->Numero_Reservacion][] = $reg;
    }

    foreach ($reservaciones as $numReservacion => $detalles) {
        $nombreCompleto = $detalles[0]->Nombre_Completo;
        echo "
        <tr>
            <td>{$numReservacion}</td>
            <td>{$nombreCompleto}</td>
            <td>
                <button class='btn btn-danger' onclick='openModal({$numReservacion})'>
                    Añadir Detalles
                </button>
            </td>
        </tr>";
    }
    ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDetailModalLabel">Editar Detalles de la Reservación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post">
                <div id="modalContent"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
        let detallesArray = [];

        function openModal(reservacionId) {
            const reservaciones = <?php echo json_encode($reservaciones); ?>;
            const detalles = reservaciones[reservacionId];
            let modalContent = '';

            detalles.forEach((detalle, index) => {
                let titularHabitacion = detalle.TITULAR_HABITACION !== null ? detalle.TITULAR_HABITACION : '';
                modalContent += `
                    <div class="detalleSection">
                      <input type="hidden" name="detalleId[]" value="${detalle.ID_DETALLE_RESRVACION}">
                      <div class="mb-3">
                        <label for="fechaInicio${index}" class="form-label">Fecha Inicio</label>
                        <input type="text" class="form-control" name="fechaInicio[]" value="${detalle.FECHA_INICIO}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="fechaFin${index}" class="form-label">Fecha Fin</label>
                        <input type="text" class="form-control" name="fechaFin[]" value="${detalle.FECHA_FIN}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="titularHabitacion${index}" class="form-label">Titular Habitación</label>
                        <input type="text" class="form-control" name="titularHabitacion[]" value="${titularHabitacion}" required>
                      </div>
                      <div class="mb-3">
                        <label for="numHabitacion${index}" class="form-label">Número Habitación</label>
                        <input type="text" class="form-control" name="numHabitacion[]" value="${detalle.NUM_HABITACION}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="nombreHabitacion${index}" class="form-label">Nombre Habitación</label>
                        <input type="text" class="form-control" name="nombreHabitacion[]" value="${detalle.NOMBRE_HABITACION}" readonly>
                      </div>
                      <hr>
                    </div>`;
            });

            document.getElementById('modalContent').innerHTML = modalContent;
            var myModal = new bootstrap.Modal(document.getElementById('addDetailModal'), {});
            myModal.show();
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
?>
