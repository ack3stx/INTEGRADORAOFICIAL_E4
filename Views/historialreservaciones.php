<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="../Estilos/historial.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<header>
    <div class="row">
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
            <li class="nav-item">
              <a class="nav-link" href="../index.php"><label>INICIO</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="nosotros.php"><label>NOSOTROS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vistahab.php"><label>HABITACIONES</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php#2424"><label>SERVICIOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>

<?php
if(isset($_SESSION["usuario"])){
  echo ' 
       <div class="header-content">
            <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                    <span class="material-symbols-outlined ">
                        account_circle
                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li>
                        <a class="dropdown-item" href="panelusuario.php">
                            <span class="material-symbols-outlined lia">manage_accounts</span>
                            Gestionar cuenta
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="ver_datos_personales.php">
                            <span class="material-symbols-outlined lia">person</span>
                            Datos Personales
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="datospersonales.php">
                            <span class="material-symbols-outlined lia">edit</span>
                            Modificar mis Datos
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="historialreservaciones.php">
                            <span class="material-symbols-outlined">travel_explore</span>
                            Historial de Reservación
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../Scripts/Cerrar_Sesion.php">
                            <span class="material-symbols-outlined">logout</span>
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>';
} else {
  echo '   <li class="nav-item">
              <a class="nav-link" href="Views/Login.php"><label>INICIAR SESION</label></a>
            </li>';
}
?>

          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>

<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

$usuario = $_SESSION["usuario"];

$consulta = "SELECT DISTINCT 
                CONCAT(persona.nombre, ' ', persona.apellido_paterno, ' ', persona.apellido_materno) AS Nombre_Huesped, 
                reservacion.id_reservacion AS folio_reserva, 
                reservacion.estado_reservacion AS estado, 
                reservacion.FECHA_ AS fecha_reservacion,
                detalle_reservacion.FECHA_INICIO as fecha_inicio,
                detalle_reservacion.FECHA_FIN as fecha_fin,
                t_habitacion.NOMBRE as tipo_habitacion,
                t_habitacion.PRECIO as precio_habitacion
            FROM usuarios
            INNER JOIN persona ON persona.usuario = usuarios.id_usuario
            INNER JOIN huesped ON huesped.persona_huesped = persona.id_persona
            INNER JOIN reservacion ON reservacion.huesped = huesped.id_huesped
            INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion = reservacion.id_reservacion
            JOIN habitacion ON detalle_reservacion.HABITACION = habitacion.ID_HABITACION
            JOIN t_habitacion ON habitacion.TIPO_HABITACION = t_habitacion.ID_TIPO_HABITACION
            WHERE usuarios.nombre_usuario = '$usuario'";

$resultado = $db->seleccionar($consulta);

foreach ($resultado as $value) {
    $fechaInicio = new DateTime($value->fecha_inicio);
    $fechaFin = new DateTime($value->fecha_fin);
    $interval = $fechaInicio->diff($fechaFin);
    $diasEstancia = $interval->days;
    $sumaCostos = $value->precio_habitacion * $diasEstancia;
    $fecha_reservacion = $value->fecha_reservacion;

    if ($fecha_reservacion) {
        $fecha_reservacion_timestamp = strtotime($fecha_reservacion);

        if ($fecha_reservacion_timestamp !== false) {
            $diferencia_horas = (time() - $fecha_reservacion_timestamp) / 3600;
            $han_pasado_72_horas = $diferencia_horas > 72;
        } else {
            echo "Error al convertir la fecha de reservación a timestamp.<br>";
        }
    } else {
        echo "Fecha de Reservación no definida.<br>";
        $han_pasado_72_horas = true; 
    }
    ?>

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title">Reservacion Folio: <?php echo $value->folio_reserva; ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">
                Nombre: <?php echo $value->Nombre_Huesped; ?><br>
                Estado : <?php echo $value->estado; ?><br>
                Fecha de reservación: <?php echo $value->fecha_reservacion; ?><br>
                Noches : <?php echo $diasEstancia; ?><br>
                Costo Total: <?php echo $sumaCostos; ?><br><br>
            </h6>
            <p class="card-text"></p>
            <a href="historialreservaciones.php?folio_reserva=<?php echo $value->folio_reserva; ?>" class="btn btn-primary">Ver Detalles</a><br><br>
            <br>
            <?php if ($value->estado == 'proceso' && !$han_pasado_72_horas): ?>
                <form id="cancelForm" action="cancelar_reservacion_huesped.php" method="post">
                    <input type="hidden" name="id_reservacion" value="<?php echo $value->folio_reserva; ?>">
                    <button type="button" class="btn btn-danger" style="margin-left: 70%; margin-top: -25%;" data-bs-toggle="modal" data-bs-target="#confirmCancelModal">Cancelar Reservacion</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php
}
?>

<?php
if (isset($_GET['folio_reserva'])) {
    $folio_reserva = $_GET['folio_reserva'];
    $consulta_detalle = "SELECT 
                            detalle_reservacion.titular_habitacion AS titular, 
                            reservacion.id_reservacion AS folio_reserva, 
                            reservacion.estado_reservacion AS estado, 
                            TIMESTAMPDIFF(DAY, detalle_reservacion.fecha_inicio, detalle_reservacion.fecha_fin) AS noches,
                            reservacion.FECHA_ AS fecha_reservacion,
                            detalle_reservacion.FECHA_INICIO as fecha_inicio,
                            detalle_reservacion.FECHA_FIN as fecha_fin,
                            t_habitacion.NOMBRE as tipo_habitacion,
                            t_habitacion.PRECIO as precio_habitacion
                          FROM usuarios
                          INNER JOIN persona ON persona.usuario = usuarios.id_usuario
                          INNER JOIN huesped ON huesped.persona_huesped = persona.id_persona
                          INNER JOIN reservacion ON reservacion.huesped = huesped.id_huesped
                          INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion = reservacion.id_reservacion
                          JOIN habitacion ON detalle_reservacion.HABITACION = habitacion.ID_HABITACION
                          JOIN t_habitacion ON habitacion.TIPO_HABITACION = t_habitacion.ID_TIPO_HABITACION
                          WHERE usuarios.nombre_usuario = '$usuario'
                          AND reservacion.id_reservacion = '$folio_reserva'";

    $resultado_detalle = $db->seleccionar($consulta_detalle);

    foreach ($resultado_detalle as $value) {
        $fechaInicio = new DateTime($value->fecha_inicio);
        $fechaFin = new DateTime($value->fecha_fin);
        $interval = $fechaInicio->diff($fechaFin);
        $diasEstancia = $interval->days;
        $sumaCostos = $value->precio_habitacion * $diasEstancia;
        ?>

        <div class="card" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title">Detalles de Reservacion Folio: <?php echo $value->folio_reserva; ?></h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">
                    Titular: <?php echo $value->titular; ?><br>
                    Estado : <?php echo $value->estado; ?><br>
                    Fecha de reservación: <?php echo $value->fecha_reservacion; ?><br>
                    Fecha Inicio: <?php echo $value->fecha_inicio; ?><br>
                    Fecha Fin: <?php echo $value->fecha_fin; ?><br>
                    Noches : <?php echo $diasEstancia; ?><br>
                    Costo por noche: <?php echo $value->precio_habitacion; ?><br>
                    Costo Total: <?php echo $sumaCostos; ?><br><br>
                </h6>
            </div>
        </div>

        <?php
    }
}
?>

<!-- MODALS -->

<!-- BOTON DE VER DETALLES -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle de tu reservación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php        
        $query = "SELECT 
                    detalle_reservacion.titular_habitacion AS titular, 
                    reservacion.id_reservacion AS folio_reserva, 
                    reservacion.estado_reservacion AS estado, 
                    TIMESTAMPDIFF(DAY, detalle_reservacion.fecha_inicio, detalle_reservacion.fecha_fin) AS noches,
                    reservacion.FECHA_ AS fecha_reservacion,
                    detalle_reservacion.FECHA_INICIO as fecha_inicio,
                    detalle_reservacion.FECHA_FIN as fecha_fin,
                    t_habitacion.NOMBRE as tipo_habitacion,
                    t_habitacion.PRECIO as precio_habitacion
                  FROM usuarios
                  INNER JOIN persona ON persona.usuario = usuarios.id_usuario
                  INNER JOIN huesped ON huesped.persona_huesped = persona.id_persona
                  INNER JOIN reservacion ON reservacion.huesped = huesped.id_huesped
                  INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion = reservacion.id_reservacion
                  JOIN habitacion ON detalle_reservacion.HABITACION = habitacion.ID_HABITACION
                  JOIN t_habitacion ON habitacion.TIPO_HABITACION = t_habitacion.ID_TIPO_HABITACION
                  WHERE usuarios.nombre_usuario = '$usuario'
                  AND reservacion.id_reservacion = '$folio_reserva'";

        $resultados = $db->seleccionar($query);
        foreach ($resultados as $value) {
        ?>
        
        Titular de la habitación: <?php echo $value->titular; ?><br>
        Fecha Inicial Reservacion: <?php echo $value->fecha_inicio; ?><br>
        Fecha Final Reservacion: <?php echo $value->fecha_fin; ?><br>
        Tipo de Habitacion Reservada: <?php echo $value->tipo_habitacion; ?><br>
        Costo por noche: <?php echo $value->precio_habitacion; ?><br>
        <?php 
        $fechaInicio = new DateTime($value->fecha_inicio);
        $fechaFin = new DateTime($value->fecha_fin);
        $interval = $fechaInicio->diff($fechaFin);
        $diasEstancia = $interval->days;
        $valorT = $value->precio_habitacion * $diasEstancia;
        ?>
        Precio total por el tipo de habitacion: <?php echo $valorT; ?><br><br>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmCancelModal" tabindex="-1" aria-labelledby="confirmCancelModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="confirmCancelModalLabel">Confirmar Cancelación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas cancelar esta reservación?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, mantener reservación</button>
        <button type="button" class="btn btn-danger" id="confirmCancelButton">Sí, cancelar reservación</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cancelModalLabel">Cancelación Exitosa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Para consultar sobre los temas de reembolso por favor comuníquese con el número 87-15-73-25-05 para dicha aclaración.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeSuccessModal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('confirmCancelButton').addEventListener('click', function() {
    var form = document.getElementById('cancelForm');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Ocultar el modal de confirmación
            var confirmCancelModal = bootstrap.Modal.getInstance(document.getElementById('confirmCancelModal'));
            confirmCancelModal.hide();
            // Mostrar el modal de cancelación exitosa
            var cancelModal = new bootstrap.Modal(document.getElementById('cancelModal'));
            cancelModal.show();
            
            // Añadir listener para recargar la página cuando se cierre el modal de cancelación exitosa
            document.getElementById('closeSuccessModal').addEventListener('click', function() {
                location.reload();
            });
        }
    };
    xhr.send(new URLSearchParams(new FormData(form)).toString());
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
