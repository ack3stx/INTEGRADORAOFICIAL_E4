<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
</head>
<?php
  session_start();
  include '../Clases/BasedeDatos.php';
  
  $db = new Database();
  $db->conectarDB();

  if(isset($_SESSION["rol"]) && $_SESSION["rol"] == "recepcionista") {
?>
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
              <i class="fas fa-users"></i>incidencias
            </a>
          </li>
        </ul>
        <div class="header-right">
          <div class="btn-group">
          <?php
            if (isset($_SESSION["usuario"])) {
              echo "<button class='btn btn-danger dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='false'>
                      ".$_SESSION["usuario"]."
                    </button>";
            }
          ?>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a class="dropdown-item" href="cambiar_datos_cuenta_recepcionista.php">Cuenta</a></li>
              
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-danger" href="../Scripts/Cerrar_Sesion.php">Cerrar Sesión</a></li>
            </ul>
          </div>
          <i class="fas fa-user text-white ml-2"></i>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="search-form">
          <h1 class="text-center">Buscar Información De Los Huéspedes</h1>
          <form action="" method="POST">
            <div class="form-group">
              <label for="inputBusqueda">Número de Reservación</label>
              <input type="number" class="form-control" id="inputBusqueda" placeholder="Ingrese el número de la reservación." name="n_reservacion">
            </div>
            <button type="submit" class="btn btn-danger btn-block">Buscar</button>
            <br>
          </form>
        </div>
      </div>
    </div>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    // Verifica si el campo n_reservacion no está vacío y no excede los 10 caracteres (puedes ajustar este número según lo necesites)
    if (!empty($n_reservacion)) {
        if (strlen($n_reservacion) > 10) {
            echo "<p>El número de reservación es demasiado largo. Por favor, ingresa un número de reservación válido.</p>";
        } else {
            $cadena = "CALL info_huesped('$n_reservacion');";
            $tabla = $db->seleccionar($cadena);

            if (empty($tabla)) {
                echo "<p>No se encontraron reservaciones.</p>";
            } else {
                echo "
                <div class='table-responsive'>
                    <table class='table table-hover table-bordered table-danger'>
                        <thead class='table-dark'>
                            <tr>
                                <th>NOMBRE COMPLETO</th>
                                <th>FECHA DE NACIMIENTO</th>
                                <th>DIRECCIÓN COMPLETA</th>
                                <th>GÉNERO</th>
                                <th>NÚMERO DE TELÉFONO</th>
                            </tr>
                        </thead>
                        <tbody>
                ";

                foreach ($tabla as $reg) {
                    echo "
                            <tr>
                                <td>{$reg->NOMBRE_COMPLETO}</td>
                                <td>{$reg->FECHA_DE_NACIMIENTO}</td>
                                <td>{$reg->DIRECCION_COMPLETA}</td>
                                <td>{$reg->GENERO}</td>
                                <td>{$reg->NUMERO_DE_TELEFONO}</td>
                            </tr>
                    ";
                }

                echo "
                        </tbody>
                    </table>
                </div>
                <br>
                ";
            }

            $db->desconectarBD();
        }
    } else {
        echo "<p>No se encontró ningún número de reservación proporcionado.</p>";
    }
}
?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <?php
    $db->desconectarBD();
  } else {
  ?>
<head>
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
<?php
  }
?>
</body>
</html>
