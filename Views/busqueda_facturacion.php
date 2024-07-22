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
      <a class="navbar-brand" href="panel_recepcionista2.php">Hotel Laguna Inn</a>
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
  <div class="container mt-5">
        <h2 class="mb-4">Consultar Informacion De La Facturacion</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="nombre">Numero De Reservacion</label>
                <input name="N_reservacion" type="text" class="form-control" id="nombre" placeholder="Porfavor Ingrese El Numero De La Reservacion.">
            </div>
            <button type="submit" class="btn btn-danger">Buscar</button>

        </form>
    </div>
    <?php

    
    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);

    if (empty($N_reservacion))
    {
    
            }
    else{
      $cadena = "CALL Consultar_Informacion_Facturacion('$N_reservacion');";

    $tabla = $db->seleccionar($cadena);


    echo "
            <table class='table table-hover'>
                <thead class='table-dark'>
                    <tr>
                    <th>nombre</th><th>apellido_paterno</th><th>apellido_materno</th><th>RFC</th><th>direccion</th><th>monto_total</th><th>metodo_pago</th>
                    </tr>
                </thead>
                <tbody>
            ";
            foreach($tabla as $reg)
            {
                echo "<tr>";
                echo "<td> $reg->nombre </td>";
                echo "<td> $reg->apellido_paterno </td>";
                echo "<td> $reg->apellido_materno </td>";
                echo "<td> $reg->rfc </td>";
                echo "<td> $reg->direccion </td>";
                echo "<td> $reg->monto_total </td>";
                echo "<td> $reg->metodo_pago </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

    }
            $db->desconectarBD();

            
          ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>