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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservacionId = $_POST['reservacionId'];

    try {
        $consulta = "UPDATE RESERVACION SET ESTADO_RESERVACION = 'finalizada' WHERE RESERVACION.ID_RESERVACION = $reservacionId";
        $db->ejecuta($consulta);
        $db->desconectarBD();
        header("Location: check_out.php?success=1");
        exit();
    } catch (Exception $e) {
        $db->desconectarBD();
        header("Location: check_out.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    $consulta = "
        SELECT 
            RESERVACION.ID_RESERVACION AS 'NUMERO_RESERVACION',
            CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_COMPLETO,
            DETALLE_RESERVACION.FECHA_INICIO,
            DETALLE_RESERVACION.FECHA_FIN,
            HABITACION.NUM_HABITACION,
            T_HABITACION.NOMBRE AS NOMBRE_HABITACION
        FROM PERSONA
        JOIN HUESPED ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
        JOIN RESERVACION ON RESERVACION.HUESPED = HUESPED.PERSONA_HUESPED
        JOIN DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
        JOIN HABITACION ON HABITACION.ID_HABITACION = DETALLE_RESERVACION.HABITACION
        JOIN T_HABITACION ON T_HABITACION.ID_TIPO_HABITACION = HABITACION.TIPO_HABITACION
        WHERE RESERVACION.ESTADO_RESERVACION = 'activa'
        AND DATE(DETALLE_RESERVACION.FECHA_FIN) = CURDATE();";

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
            <a class="nav-link" href="reservaciones_activas.php">
              <i class="fas fa-users"></i>Cancelaciones
            </a>
          </li>
            </ul>
            <div class="header-right">
                <div class="btn-group">
                <?php
                if (isset($_SESSION["usuario"])) 
                {
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
<div class="bg-danger text-white w-100 text-center">
    <h1 class="mb-0">Reservaciones Para Check-Out Hoy...</h1>
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
            <td>{$reg->NUMERO_RESERVACION}</td>
            <td>{$reg->NOMBRE_COMPLETO}</td>
            <td>{$reg->FECHA_INICIO}</td>
            <td>{$reg->FECHA_FIN}</td>
            <td>{$reg->NUM_HABITACION}</td>
            <td>{$reg->NOMBRE_HABITACION}</td>
            <td>
                <form method='post'>
                    <input type='hidden' name='reservacionId' value='{$reg->NUMERO_RESERVACION}'>
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
