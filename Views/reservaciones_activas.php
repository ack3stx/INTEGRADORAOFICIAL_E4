<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol']) || $_SESSION['rol'] !== 'recepcionista') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Página no Encontrada</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
                <div class="error-message">Página no Encontrada</div>
                <p>Es posible que la página que está buscando se haya eliminado, haya cambiado de nombre o no esté disponible temporalmente.</p>
                <a href="../index.php" class="btn btn-primary mt-4">Página Principal</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $detalleIds = $_POST['detalleId'];
    $titularHabitaciones = $_POST['titularHabitacion'];
    $fechasFin = $_POST['fechaFin'];

    try {
        $costoTotal = 0;
        $diasEstanciaTotal = 0;
        $detallesHabitaciones = [];
        $numeroReservacion = null;
        $mensajesError = [];

        for ($i = 0; $i < count($detalleIds); $i++) {
            $detalleReservacion = $detalleIds[$i];
            $nombreTitularReservacion = $titularHabitaciones[$i];
            $nuevaFechaFin = $fechasFin[$i];

            if ($nuevaFechaFin === null || $nuevaFechaFin === '') {
                continue;
            }

            $consultaActual = "
                SELECT RESERVACION, HABITACION, FECHA_INICIO, FECHA_FIN, HABITACION.NUM_HABITACION, T_HABITACION.NOMBRE, T_HABITACION.PRECIO
                FROM DETALLE_RESERVACION 
                JOIN HABITACION ON HABITACION.ID_HABITACION = DETALLE_RESERVACION.HABITACION
                JOIN T_HABITACION ON T_HABITACION.ID_TIPO_HABITACION = HABITACION.TIPO_HABITACION
                WHERE ID_DETALLE_RESERVACION = $detalleReservacion";
            $detalleActual = $db->seleccionar($consultaActual);

            if (empty($detalleActual)) {
                throw new Exception("No se encontró la reservación con ID $detalleReservacion.");
            }

            $numHabitacion = $detalleActual[0]->NUM_HABITACION;
            $nombreHabitacion = $detalleActual[0]->NOMBRE;
            $precioHabitacion = $detalleActual[0]->PRECIO;
            $fechaFinActual = $detalleActual[0]->FECHA_FIN;
            $numeroReservacion = $detalleActual[0]->RESERVACION;

            $consultaDisponibilidad = "
                CALL VERIFICAR_DISPONIBILIDAD_HABITACION($numHabitacion, '$fechaFinActual', '$nuevaFechaFin')";
            $resultadoDisponibilidad = $db->seleccionar($consultaDisponibilidad);

            if (empty($resultadoDisponibilidad)) {
                throw new Exception("Error al verificar la disponibilidad de la habitación $numHabitacion.");
            }

            if ($resultadoDisponibilidad[0]->Disponibilidad === 'No Disponible') {
                $mensajesError[] = "La habitación $numHabitacion no está disponible en las fechas seleccionadas.";
                continue;
            }

            $fechaFinActualDatetime = new DateTime($fechaFinActual);
            $nuevaFechaFinDatetime = new DateTime($nuevaFechaFin);
            $diasEstancia = $fechaFinActualDatetime->diff($nuevaFechaFinDatetime)->days;

            if ($diasEstancia == 0) {
                $diasEstancia = 1;
            } else {
                $diasEstancia += 1;
            }

            $costoTotalHabitacion = $precioHabitacion * $diasEstancia;
            $costoTotal += $costoTotalHabitacion;
            $diasEstanciaTotal += $diasEstancia;

            $detallesHabitaciones[] = [
                'nombre' => $nombreHabitacion,
                'diasEstancia' => $diasEstancia,
                'precioHabitacion' => $precioHabitacion,
                'costoTotalHabitacion' => $costoTotalHabitacion,
                'numHabitacion' => $numHabitacion
            ];
        }

        if (!empty($mensajesError)) {
            $_SESSION['mensajesError'] = $mensajesError;
        }

        if (!empty($detallesHabitaciones)) {
            $_SESSION['detallesHabitaciones'] = $detallesHabitaciones;
            $_SESSION['costoTotal'] = $costoTotal;
            $_SESSION['diasEstanciaTotal'] = $diasEstanciaTotal;
            $_SESSION['numeroReservacion'] = $numeroReservacion;

            header("Location: pagina_de_pago.php");
            exit;
        } else {
            header("Location: reservaciones_activas.php");
            exit;
        }
    } catch (Exception $e) {
        $db->desconectarBD();
        echo "<script>alert('" . $e->getMessage() . "'); window.location.href='reservaciones_activas.php';</script>";
        exit();
    }
} else {
    $consulta = "
        SELECT 
            RESERVACION.ID_RESERVACION AS 'NUMERO_RESERVACION',
            CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_COMPLETO,
            DETALLE_RESERVACION.ID_DETALLE_RESERVACION,
            DETALLE_RESERVACION.FECHA_INICIO,
            DETALLE_RESERVACION.FECHA_FIN,
            DETALLE_RESERVACION.TITULAR_HABITACION,
            HABITACION.NUM_HABITACION,
            T_HABITACION.NOMBRE AS NOMBRE_HABITACION
        FROM PERSONA
        JOIN HUESPED ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
        JOIN RESERVACION ON RESERVACION.HUESPED = HUESPED.PERSONA_HUESPED
        JOIN DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
        JOIN HABITACION ON HABITACION.ID_HABITACION = DETALLE_RESERVACION.HABITACION
        JOIN T_HABITACION ON T_HABITACION.ID_TIPO_HABITACION = HABITACION.TIPO_HABITACION
        WHERE RESERVACION.ESTADO_RESERVACION = 'activa';
        ORDER BY DESC";

    $tabla = $db->seleccionar($consulta);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="Panel_Recepcionista.php">Hotel Laguna Inn</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
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
                        <a class="nav-link" href="notificaciones_recepcionista.php">
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
                        if (isset($_SESSION["usuario"])) {
                            echo "<button class='btn btn-danger dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                      ".$_SESSION["usuario"]."
                                    </button>";
                        }
                        ?>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
                           
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
        <h1 class='text-center bg-danger text-white'>Extender Reservaciones Activas...</h1>
        <br>
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
        <table class='table table-hover table-bordered table-danger'>
            <thead class='table-dark'>
            <tr>
                <th class='text-white'>NUMERO_RESERVACION</th>
                <th class='text-white'>Nombre Completo</th>
                <th class='text-white'>Registrar Check-IN</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $reservaciones = [];
            foreach ($tabla as $reg) {
                $reservaciones[$reg->NUMERO_RESERVACION][] = $reg;
            }

            foreach ($reservaciones as $numReservacion => $detalles) {
                $nombreCompleto = $detalles[0]->NOMBRE_COMPLETO;
                echo "
                <tr>
                    <td>{$numReservacion}</td>
                    <td>{$nombreCompleto}</td>
                    <td>
                        <button class='btn btn-danger' onclick='openModal({$numReservacion})'>
                            Extender Reservacion
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
                    <form id="reservacionForm" method="post" onsubmit="return validarFechas();">
                        <div id="modalContent"></div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Verificicar Disponibilidad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(reservacionId) {
            const reservaciones = <?php echo json_encode($reservaciones); ?>;
            const detalles = reservaciones[reservacionId];
            let modalContent = '';

            detalles.forEach((detalle, index) => {
                let titularHabitacion = detalle.TITULAR_HABITACION !== null ? detalle.TITULAR_HABITACION : '';
                modalContent += `
                    <div class="detalleSection">
                      <input type="hidden" name="detalleId[]" value="${detalle.ID_DETALLE_RESERVACION}">
                      <div class="mb-3">
                        <label for="fechaInicio${index}" class="form-label">Fecha Inicio</label>
                        <input type="text" class="form-control" name="fechaInicio[]" value="${detalle.FECHA_INICIO}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="fechaFinActual${index}" class="form-label">Fecha Final De La Reservacion</label>
                        <input type="text" class="form-control" id="fechaFinActual${index}" value="${detalle.FECHA_FIN}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="fechaFin${index}" class="form-label">Fecha Para Actualizar La Reservacion</label>
                        <input type="date" class="form-control" id="fechaFin${index}" name="fechaFin[]" value="${detalle.FECHA_FIN}">
                      </div>
                      <div class="mb-3">
                        <label for="titularHabitacion${index}" class="form-label">Titular Habitación</label>
                        <input type="text" class="form-control" name="titularHabitacion[]" value="${titularHabitacion}" readonly>
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

        function validarFechas() {
            let valid = true;
            const detalles = document.querySelectorAll('.detalleSection');
            detalles.forEach((detalle, index) => {
                const fechaFinInput = detalle.querySelector(`#fechaFin${index}`);
                const fechaFinActualInput = detalle.querySelector(`#fechaFinActual${index}`);
                const fechaFinActual = new Date(fechaFinActualInput.value);
                const nuevaFechaFin = new Date(fechaFinInput.value);

                if (nuevaFechaFin <= fechaFinActual) {
                    alert('La Fecha Para Extender la reservacion Debe Ser Mayor a La Fecha Fin De La Reservacion.');
                    valid = false;
                }

                const fechaMaxima = new Date(fechaFinActual);
                fechaMaxima.setFullYear(fechaMaxima.getFullYear() + 1);

                if (nuevaFechaFin > fechaMaxima) {
                    alert('La Fecha Para Extender la reservacion no puede ser mayor a 12 meses desde la fecha fin actual.');
                    valid = false;
                }
            });
            return valid;
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
}
?>
