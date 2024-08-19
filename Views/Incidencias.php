<?php
session_start();
include '../Clases/BasedeDatos.php';

$db = new Database();
$db->conectarDB();

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
                <div class="error-message">Pagina no Encontrada</div>
                <p>Es posible que la página que está buscando se haya eliminado, haya cambiado de nombre o no esté disponible temporalmente.</p>
                <a href="../index.php" class="btn btn-primary mt-4">Pagina Principal</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservacionId']) && isset($_POST['habitacionesSeleccionadas'])) {
    $reservacionId = $_POST['reservacionId'];
    $habitacionesSeleccionadas = $_POST['habitacionesSeleccionadas'];

    try {
        foreach ($habitacionesSeleccionadas as $numHabitacion) {
            $idHabitacion = $db->seleccionar("SELECT ID_HABITACION FROM HABITACION WHERE NUM_HABITACION = '$numHabitacion'")[0]->ID_HABITACION;

            // Actualizar el detalle correspondiente para que el ID de la habitación se actualice con el nuevo ID de la habitación seleccionada
            $consultaActualizar = "
                UPDATE DETALLE_RESERVACION 
                SET HABITACION = $idHabitacion 
                WHERE RESERVACION = $reservacionId 
                AND HABITACION IN (
                    SELECT ID_HABITACION 
                    FROM HABITACION 
                    WHERE ESTADO_HABITACION = 'mantenimiento'
                )
                LIMIT 1
            ";
            $db->ejecuta($consultaActualizar);
        }

        // Actualizar el estado de la reservación a 'proceso'
        $consultaActualizarEstado = "
            UPDATE RESERVACION 
            SET ESTADO_RESERVACION = 'proceso' 
            WHERE ID_RESERVACION = $reservacionId";
        $db->ejecuta($consultaActualizarEstado);

        header("Location: Incidencias.php?success=1");
        exit();
    } catch (Exception $e) {
        header("Location: Incidencias.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

$consulta = "
    SELECT 
        RESERVACION.ID_RESERVACION AS 'NUMERO_RESERVACION',
        CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_COMPLETO,
        DETALLE_RESERVACION.FECHA_INICIO,
        DETALLE_RESERVACION.FECHA_FIN,
        RESERVACION.INCONSISTENCIA,
        GROUP_CONCAT(IF(HABITACION.ESTADO_HABITACION = 'mantenimiento', HABITACION.NUM_HABITACION, NULL) ORDER BY HABITACION.NUM_HABITACION SEPARATOR ', ') AS 'HABITACIONES_MANTENIMIENTO',
        HABITACION.ESTADO_HABITACION
    FROM 
        RESERVACION
    JOIN 
        DETALLE_RESERVACION ON RESERVACION.ID_RESERVACION = DETALLE_RESERVACION.RESERVACION
    JOIN 
        HABITACION ON DETALLE_RESERVACION.HABITACION = HABITACION.ID_HABITACION
    JOIN 
        T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
    JOIN 
        HUESPED ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
    JOIN 
        PERSONA ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
    WHERE 
        RESERVACION.ESTADO_RESERVACION = 'inconsistencia'
    AND 
        DATE(DETALLE_RESERVACION.FECHA_INICIO) = CURDATE()
    GROUP BY RESERVACION.ID_RESERVACION, PERSONA.NOMBRE, PERSONA.APELLIDO_PATERNO, PERSONA.APELLIDO_MATERNO, DETALLE_RESERVACION.FECHA_INICIO, DETALLE_RESERVACION.FECHA_FIN, RESERVACION.INCONSISTENCIA
    ORDER BY RESERVACION.ID_RESERVACION, DETALLE_RESERVACION.FECHA_INICIO;";

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
                        <i class="fas fa-users"></i> Incidencias
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

<div class="bg-danger text-white w-100 text-center">
    <h1 class="mb-0">Reasignación de habitaciones</h1>
</div>
<div class='table-responsive'>
    <br>
    <table class='table table-hover table-bordered table-danger'>
        <thead class='table-dark'>
            <tr>
                <th class='text-white'>NUMERO_RESERVACION</th>
                <th class='text-white'>Nombre Completo</th>
                <th class='text-white'>Fecha Inicio</th>
                <th class='text-white'>Fecha Fin</th>
                <th class='text-white'>INCONSISTENCIA</th>
                <th class='text-white'>Acción</th>
            </tr>
        </thead>
        <tbody>
<?php
if (isset($tabla) && !empty($tabla)) {
    foreach ($tabla as $reg) {
        echo "
        <tr>
            <td>{$reg->NUMERO_RESERVACION}</td>
            <td>{$reg->NOMBRE_COMPLETO}</td>
            <td>{$reg->FECHA_INICIO}</td>
            <td>{$reg->FECHA_FIN}</td>
            <td>{$reg->INCONSISTENCIA}</td>
            <td>
                <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#modalReasignar{$reg->NUMERO_RESERVACION}'>
                    Reasignar Habitacion
                </button>
            </td>
        </tr>";
    }
}
?>
        </tbody>
    </table>
</div>

<?php
if (isset($tabla) && !empty($tabla)) {
    foreach ($tabla as $reg) {
        echo "
        <!-- Modal -->
        <div class='modal fade' id='modalReasignar{$reg->NUMERO_RESERVACION}' tabindex='-1' aria-labelledby='modalReasignarLabel' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='modalReasignarLabel'>Reasignar Habitacion para Reservacion {$reg->NUMERO_RESERVACION}</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <p><strong>Nombre del Huesped:</strong> {$reg->NOMBRE_COMPLETO}</p>
                        <p><strong>Fecha Inicio:</strong> {$reg->FECHA_INICIO}</p>
                        <p><strong>Fecha Fin:</strong> {$reg->FECHA_FIN}</p>";
                        if ($reg->HABITACIONES_MANTENIMIENTO) {
                            echo "<p><strong>Habitación en Mantenimiento:</strong> {$reg->HABITACIONES_MANTENIMIENTO}</p>";
                        }
                        echo "<hr>
                        <h6>Habitaciones Disponibles:</h6>
                        <form method='post'>
                            <div class='mb-3'>
                                <input type='hidden' name='reservacionId' value='{$reg->NUMERO_RESERVACION}'>";
                                
                                $habitacionesDisponibles = $db->seleccionar("
                                    SELECT NUM_HABITACION 
                                    FROM HABITACION 
                                    WHERE ESTADO_HABITACION = 'disponible' 
                                    AND ID_HABITACION NOT IN (
                                        SELECT HABITACION 
                                        FROM DETALLE_RESERVACION 
                                        WHERE (FECHA_INICIO <= '{$reg->FECHA_FIN}' AND FECHA_FIN >= '{$reg->FECHA_INICIO}')
                                    )
                                ");

                                foreach ($habitacionesDisponibles as $habitacion) {
                                    echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='checkbox' name='habitacionesSeleccionadas[]' value='{$habitacion->NUM_HABITACION}'>
                                        <label class='form-check-label'>
                                            Habitación {$habitacion->NUM_HABITACION}
                                        </label>
                                    </div>";
                                }

        echo "              </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                            <button type='submit' class='btn btn-danger'>Confirmar Reasignación</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
