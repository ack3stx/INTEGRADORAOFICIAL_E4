<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionista.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="panel_recepcionista.php">Hotel Laguna Inn</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
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
            <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              Tomasillo
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
              <li><a class="dropdown-item" href="#">Historial</a></li>
              <li><a class="dropdown-item" href="#">Opciones</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../Php/Cerrar_Sesion.php">Cerrar Sesión</a></li>
            </ul>
          </div>
          <i class="fas fa-user text-white ml-2"></i>
        </div>
      </div>
    </div>
  </nav>
        <div class="container d-flex justify-content-center">
    <form class="d-flex justify-content-center w-100" role="search" method="post">
      <select name="estado" id="">
        <option value="activa">activa</option>
        <option value="finalizada">finalizada</option>
        <option value="cancelada">cancelada</option>
      </select>
        <input class="form-control me-2" type="number" id="checkout" name="numero" placeholder="Numero De La Reservacion">
        <label class="color-hotel" for="checkin">Fecha inicio:</label>
        <input class="form-control me-2 width" type="date" id="checkin" name="fecha1" style="width: 150px;">
        <label class="color-hotel" for="checkout">Fecha fin:</label>
        <input class="form-control me-2 width" type="date" id="checkout" name="fecha2" style="width: 150px;">
        <button class="btn btn-outline-danger" type="submit">Buscar</button>
    </form>
</div>
<?php 
    include '../Clases/BasedeDatos.php';
    $conexion = new Database();
    $conexion->conectarDB();
    extract($_POST);
    if($_POST)
    {
      if (empty($numero) and empty($fecha1) and empty($fecha2))
      {
        $consulta = "select distinct concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as Nombre_Huesped, persona.numero_de_telefono,
reservacion.fecha_,reservacion.estado_reservacion,count(detalle_reservacion.id_detalle_reservacion) as Cantidad_de_habitaciones
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
where reservacion.estado_reservacion='$estado'
group by Nombre, persona.numero_de_telefono,reservacion.fecha_,reservacion.estado_reservacion";

      }
      else if (empty($numero))
      {
        $consulta = "select distinct concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as Nombre_Huesped, persona.numero_de_telefono,
reservacion.fecha_,reservacion.estado_reservacion,count(detalle_reservacion.id_detalle_reservacion) as Cantidad_de_habitaciones
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
where reservacion.fecha_ between '$fecha1' and '$fecha2'
group by Nombre, persona.numero_de_telefono,reservacion.fecha_,reservacion.estado_reservacion";
      }
      else
      {
        $consulta = "select distinct concat(persona.nombre,' ',persona.apellido_paterno,' ',persona.apellido_materno) as Nombre_Huesped, persona.numero_de_telefono,
reservacion.fecha_,reservacion.estado_reservacion,count(detalle_reservacion.id_detalle_reservacion) as Cantidad_de_habitaciones
from usuarios
inner join persona on persona.usuario=usuarios.id_usuario
inner join huesped on huesped.persona_huesped=persona.id_persona
inner join reservacion on reservacion.huesped=huesped.id_huesped
inner join detalle_reservacion on detalle_reservacion.reservacion=reservacion.id_reservacion
where reservacion.id_reservacion=$numero
group by Nombre, persona.numero_de_telefono,reservacion.fecha_,reservacion.estado_reservacion";
      }


        $tabla = $conexion->seleccionar($consulta);

        echo "
            <table class='table table-hover'>
                <thead class='table-dark'>
                    <tr>
                    <th>Nombre</th><th>Telefono</th><th>Fecha Reservacion</th><th>Estado Reservacion</th><th>Cantidad Habitaciones</th>
                    </tr>
                </thead>
                <tbody>
            ";
            foreach($tabla as $reg)
            {
                echo "<tr>";
                echo "<td> $reg->Nombre_Huesped </td>";
                echo "<td> $reg->numero_de_telefono </td>";
                echo "<td> $reg->fecha_ </td>";
                echo "<td> $reg->estado_reservacion </td>";
                echo "<td> $reg->Cantidad_de_habitaciones </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $conexion->desconectarBD();

    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>