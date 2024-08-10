<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <link rel="stylesheet" href="../Estilos/historial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            padding-top: 100px;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #dc3545;
            text-align: center;
            margin-bottom: 30px;
        }
        h6 {
            font-size: 1rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 20px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4">
        <div class="container-fluid">
            <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="../index.php">
                <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center col-lg-9" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link" href="../index.php">INICIO</a></li>
                    <li class="nav-item"><a class="nav-link" href="nosotros.php">NOSOTROS</a></li>
                    <li class="nav-item"><a class="nav-link" href="vistahab.php">HABITACIONES</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#2424">SERVICIOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="Contacto.php">CONTACTANOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="Calendario.php">RESERVAR AHORA</a></li>
                </ul>
            </div>
            <div class="header-content">
                <div class="dropdown">
                    <button class="btn dropdown-toggle olap" type="button" id="btnusr">
                        <span class="material-symbols-outlined">account_circle</span>
                    </button>
                    <ul class="dropdown-menu glass">
                        <li><a class="dropdown-item" href="panelusuario.php"><span class="material-symbols-outlined lia">manage_accounts</span>Gestionar cuenta</a></li>
                        <li><a class="dropdown-item" href="ver_datos_personales.php"><span class="material-symbols-outlined lia">person</span>Datos Personales</a></li>
                        <li><a class="dropdown-item" href="datospersonales.php"><span class="material-symbols-outlined lia">edit</span>Modificar mis Datos</a></li>
                        <li><a class="dropdown-item" href="historialreservaciones.php"><span class="material-symbols-outlined">travel_explore</span>Historial de Reservación</a></li>
                        <li><a class="dropdown-item" href="../Scripts/Cerrar_Sesion.php"><span class="material-symbols-outlined">logout</span>Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<br>
<div class="container">
    <h1>Historial de Reservaciones</h1>
    <h6>Para proceder con la cancelación de su reservación, dispone de un plazo de 72 horas Una Vez Realizada Su Reservación. Si requiere asistencia adicional o aclaraciones.</h6>
    <h6>Por favor comuníquese al número 871 720 3020.</h6>

    <?php
    include '../Clases/BasedeDatos.php';
    $db = new Database();
    $db->conectarDB();

    $usuario = $_SESSION["usuario"];

    $consulta = "SELECT
        RESERVACION.ID_RESERVACION AS FOLIO_RESERVA,
        RESERVACION.ESTADO_RESERVACION AS ESTADO,
        RESERVACION.FECHA_ AS FECHA_RESERVACION,
        CONCAT(PERSONA.NOMBRE, ' ', PERSONA.APELLIDO_PATERNO, ' ', PERSONA.APELLIDO_MATERNO) AS NOMBRE_COMPLETO,
        T_HABITACION.NOMBRE AS TIPO_HABITACION,
        COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_HABITACIONES,
        SUM(T_HABITACION.PRECIO * DATEDIFF(DETALLE_RESERVACION.FECHA_FIN, DETALLE_RESERVACION.FECHA_INICIO)) AS COSTO_TOTAL
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
        HABITACION ON DETALLE_RESERVACION.HABITACION = HABITACION.ID_HABITACION
    INNER JOIN
        T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
    WHERE
        USUARIOS.NOMBRE_USUARIO = '$usuario'
    GROUP BY
        RESERVACION.ID_RESERVACION, T_HABITACION.NOMBRE
    ORDER BY
        RESERVACION.FECHA_ DESC";

    $resultado = $db->seleccionar($consulta);

    $reservaciones = [];

    foreach ($resultado as $value) {
        $folio_reserva = $value->FOLIO_RESERVA;
        
        if (!isset($reservaciones[$folio_reserva])) {
            $reservaciones[$folio_reserva] = [
                'NOMBRE_COMPLETO' => $value->NOMBRE_COMPLETO,
                'ESTADO' => $value->ESTADO,
                'FECHA_RESERVACION' => $value->FECHA_RESERVACION,
                'TIPOS_HABITACION' => [],
                'COSTO_TOTAL' => 0
            ];
        }
        
        $reservaciones[$folio_reserva]['TIPOS_HABITACION'][] = [
            'TIPO_HABITACION' => $value->TIPO_HABITACION,
            'CANTIDAD_HABITACIONES' => $value->CANTIDAD_HABITACIONES,
            'PRECIO_HABITACION' => $value->COSTO_TOTAL
        ];
        
        $reservaciones[$folio_reserva]['COSTO_TOTAL'] += $value->COSTO_TOTAL;
    }

    foreach ($reservaciones as $folio_reserva => $reservacion) {
        ?>
<div class="d-flex justify-content-center">
    <div class="card mb-3" style="width: 100%;">
        <div class="card-body text-start">
            <h5 class="card-title">Reservación Folio: <?php echo $folio_reserva; ?></h5>
                Nombre: <?php echo $reservacion['NOMBRE_COMPLETO']; ?><br>
                Estado: <?php echo $reservacion['ESTADO']; ?><br>
                Fecha de reservación: <?php echo $reservacion['FECHA_RESERVACION']; ?><br>
                <?php foreach ($reservacion['TIPOS_HABITACION'] as $tipo) { ?>
                    Tipo de Habitación: <?php echo $tipo['TIPO_HABITACION']; ?> <br>
                    Cantidad de Habitaciones: <?php echo $tipo['CANTIDAD_HABITACIONES']; ?> <br>
                <?php } ?>
                Costo Total: <?php echo $reservacion['COSTO_TOTAL']; ?><br><br>
            <?php if ($reservacion['ESTADO'] == 'proceso'): ?>
                <form action="cancelar_reservacion_huesped.php" method="post">
                    <input type="hidden" name="id_reservacion" value="<?php echo $folio_reserva; ?>">
                    <button type="submit" class="btn btn-danger">Cancelar Reservación</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>


        <?php
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
