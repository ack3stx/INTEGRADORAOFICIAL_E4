<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionista.css">
    <title>Hotel Laguna Inn</title>
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
            <a class="nav-link" href="busqueda_reserva.php">
              <i class="fas fa-book"></i> Reservaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_habitaciones.php">
              <i class="fas fa-bed"></i> Habitaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_huesped.php">
              <i class="fas fa-users"></i> Huesped
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_empleados.php">
              <i class="fas fa-bed"></i> Personal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reportes_hotel.php">
              <i class="fas fa-bed"></i> Hotel
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="busqueda_facturacion.php">
              <i class="fas fa-bed"></i> Facturacion
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="notificaciones.php">
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
            <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tomasillo
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
              <li><a class="dropdown-item" href="#">Historial</a></li>
              <li><a class="dropdown-item" href="#">Opciones</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="../Php/Cerrar_Sesion.php">Cerrar Sesión</a></li>
            </ul>
          </div>
          <i class="fas fa-user text-white ml-2"></i>
        </div>
      </div>
    </div>
  </nav>

  <div class="container d-flex justify-content-center mt-4">
    <form class="d-flex justify-content-center w-100 flex-wrap" role="search" method="post">
      <select class="form-select me-2 mb-2" name="estado">
        <option value="activa">Activa</option>
        <option value="finalizada">Finalizada</option>
        <option value="cancelada">Cancelada</option>
      </select>
      <input class="form-control me-2 mb-2" type="number" name="numero" placeholder="Número de la Reservación">
      <input class="form-control me-2 mb-2" type="date" name="fecha1">
      <input class="form-control me-2 mb-2" type="date" name="fecha2">
      <button class="btn btn-outline-danger mb-2" type="submit">Buscar</button>
    </form>
  </div>

  <div class="container">
    <?php 
      include '../Clases/BasedeDatos.php';
      $conexion = new Database();
      $conexion->conectarDB();
      extract($_POST);
      if ($_POST) {
        if (empty($numero) && empty($fecha1) && empty($fecha2)) {
          $consulta = "SELECT DISTINCT CONCAT(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion, COUNT(detalle_reservacion.id_detalle_reservacion) AS Cantidad_de_habitaciones
          FROM usuarios
          INNER JOIN persona ON persona.usuario=usuarios.id_usuario
          INNER JOIN huesped ON huesped.persona_huesped=persona.id_persona
          INNER JOIN reservacion ON reservacion.huesped=huesped.id_huesped
          INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion=reservacion.id_reservacion
          WHERE reservacion.estado_reservacion='$estado'
          GROUP BY Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion";
        } elseif (empty($numero)) {
          $consulta = "SELECT DISTINCT CONCAT(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion, COUNT(detalle_reservacion.id_detalle_reservacion) AS Cantidad_de_habitaciones
          FROM usuarios
          INNER JOIN persona ON persona.usuario=usuarios.id_usuario
          INNER JOIN huesped ON huesped.persona_huesped=persona.id_persona
          INNER JOIN reservacion ON reservacion.huesped=huesped.id_huesped
          INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion=reservacion.id_reservacion
          WHERE reservacion.fecha_ BETWEEN '$fecha1' AND '$fecha2'
          GROUP BY Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion";
        } else {
          $consulta = "SELECT DISTINCT CONCAT(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) AS Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion, COUNT(detalle_reservacion.id_detalle_reservacion) AS Cantidad_de_habitaciones
          FROM usuarios
          INNER JOIN persona ON persona.usuario=usuarios.id_usuario
          INNER JOIN huesped ON huesped.persona_huesped=persona.id_persona
          INNER JOIN reservacion ON reservacion.huesped=huesped.id_huesped
          INNER JOIN detalle_reservacion ON detalle_reservacion.reservacion=reservacion.id_reservacion
          WHERE reservacion.id_reservacion=$numero
          GROUP BY Nombre_Huesped, persona.numero_de_telefono, reservacion.fecha_, reservacion.estado_reservacion";
        }

        $tabla = $conexion->seleccionar($consulta);
        echo "<div class='table-responsive'>";
        echo "<table class='table table-hover table-bordered table-danger'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Fecha Reservación</th>";
        echo "<th>Estado Reservación</th>";
        echo "<th>Cantidad Habitaciones</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($tabla as $reg) {
          echo "<tr>";
          echo "<td>{$reg->Nombre_Huesped}</td>";
          echo "<td>{$reg->numero_de_telefono}</td>";
          echo "<td>{$reg->fecha_}</td>";
          echo "<td>{$reg->estado_reservacion}</td>";
          echo "<td>{$reg->Cantidad_de_habitaciones}</td>";
          echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        $conexion->desconectarBD();
      }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
