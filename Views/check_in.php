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

<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

$consulta = "
    SELECT 
        reservacion.id_reservacion as 'Numero_Reservacion',
        CONCAT(persona.Nombre, ' ', persona.Apellido_paterno, ' ', persona.apellido_materno) AS Nombre_Completo,
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

echo "
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
";

foreach ($tabla as $reg) {
    echo "
        <tr>
            <td>{$reg->Numero_Reservacion}</td>
            <td>{$reg->Nombre_Completo}</td>
            <td>
                <button 
                    class='btn btn-danger' 
                    onclick='openModal(
                        {$reg->Numero_Reservacion},
                        \"{$reg->FECHA_INICIO}\",
                        \"{$reg->FECHA_FIN}\",
                        \"{$reg->TITULAR_HABITACION}\",
                        \"{$reg->NUM_HABITACION}\",
                        \"{$reg->NOMBRE_HABITACION}\"
                    )'>
                    Añadir Detalles
                </button>
            </td>
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

<div class="modal fade" id="addDetailModal" tabindex="-1" aria-labelledby="addDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDetailModalLabel">Editar Titular de la Habitación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="ruta_a_tu_script_para_guardar_detalles.php" method="post">
          <input type="hidden" id="reservacionId" name="reservacionId">
          <div class="mb-3">
            <label for="fechaInicio" class="form-label">Fecha Inicio</label>
            <input type="text" class="form-control" id="fechaInicio" name="fechaInicio" readonly>
          </div>
          <div class="mb-3">
            <label for="fechaFin" class="form-label">Fecha Fin</label>
            <input type="text" class="form-control" id="fechaFin" name="fechaFin" readonly>
          </div>
          <div class="mb-3">
            <label for="titularHabitacion" class="form-label">Titular Habitación</label>
            <input type="text" class="form-control" id="titularHabitacion" name="titularHabitacion" required>
          </div>
          <div class="mb-3">
            <label for="numHabitacion" class="form-label">Número Habitación</label>
            <input type="text" class="form-control" id="numHabitacion" name="numHabitacion" readonly>
          </div>
          <div class="mb-3">
            <label for="nombreHabitacion" class="form-label">Nombre Habitación</label>
            <input type="text" class="form-control" id="nombreHabitacion" name="nombreHabitacion" readonly>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    function openModal(reservacionId, fechaInicio, fechaFin, titularHabitacion, numHabitacion, nombreHabitacion) {
        document.getElementById('reservacionId').value = reservacionId;
        document.getElementById('fechaInicio').value = fechaInicio;
        document.getElementById('fechaFin').value = fechaFin;
        document.getElementById('titularHabitacion').value = titularHabitacion;
        document.getElementById('numHabitacion').value = numHabitacion;
        document.getElementById('nombreHabitacion').value = nombreHabitacion;

        var myModal = new bootstrap.Modal(document.getElementById('addDetailModal'), {});
        myModal.show();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
