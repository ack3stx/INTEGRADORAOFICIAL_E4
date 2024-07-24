<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservacionId = $_POST['reservacionId'];

    try {
        $consulta = "UPDATE reservacion SET ESTADO_RESERVACION = 'finalizada' WHERE reservacion.id_reservacion = $reservacionId";
        $db->ejecuta($consulta);
        $db->desconectarBD();
        header("Location: check_out.php?success=1");
        exit;
    } catch (Exception $e) {
        $db->desconectarBD();
        header("Location: check_out.php?error=" . urlencode($e->getMessage()));
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
            habitacion.NUM_HABITACION,
            t_habitacion.NOMBRE as NOMBRE_HABITACION
        FROM persona
        JOIN huesped ON huesped.persona_huesped = persona.id_persona
        JOIN reservacion ON reservacion.huesped = huesped.persona_huesped
        JOIN detalle_reservacion ON detalle_reservacion.reservacion = reservacion.id_reservacion
        JOIN habitacion ON habitacion.id_habitacion = detalle_reservacion.habitacion
        JOIN t_habitacion ON t_habitacion.ID_TIPO_HABITACION = habitacion.TIPO_HABITACION
        WHERE reservacion.estado_reservacion = 'activa'
        AND DATE(detalle_reservacion.fecha_fin) = CURDATE();";

    $tabla = $db->seleccionar($consulta);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Check-Out</title>
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

    <div class='table-responsive'>
        <h1 class='text-center bg-danger text-white'>Reservaciones Para Check-Out Hoy...</h1>
        <br>
        <table class='table table-hover table-bordered table-danger'>
            <thead class='table-dark'>
                <tr>
                    <th class='text-white'>Numero_Reservacion</th>
                    <th class='text-white'>Nombre Completo</th>
                    <th class='text-white'>Fecha Inicio</th>
                    <th class='text-white'>Fecha Fin</th>
                    <th class='text-white'>Número Habitación</th>
                    <th class='text-white'>Nombre Habitación</th>
                    <th class='text-white'>Acción</th>
                </tr>
            </thead>
            <tbody>
    <?php
    foreach ($tabla as $reg) {
        echo "
        <tr>
            <td>{$reg->Numero_Reservacion}</td>
            <td>{$reg->Nombre_Completo}</td>
            <td>{$reg->FECHA_INICIO}</td>
            <td>{$reg->FECHA_FIN}</td>
            <td>{$reg->NUM_HABITACION}</td>
            <td>{$reg->NOMBRE_HABITACION}</td>
            <td>
                <form method='post'>
                    <input type='hidden' name='reservacionId' value='{$reg->Numero_Reservacion}'>
                    <button type='submit' class='btn btn-danger'>Finalizar Reservación</button>
                </form>
            </td>
        </tr>";
    }
    ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
?>
