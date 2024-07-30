<?php
session_start();
if ($_SESSION["rol"] == "usuario") {
    include '../Clases/BasedeDatos.php';

    $db = new Database();
    $db->conectarDB();
    $user_id = $_SESSION['usuario'];

    // Consulta para obtener los datos del usuario
    $consulta = "SELECT u.nombre_usuario, u.correo, p.nombre, p.apellido_paterno, p.apellido_materno, p.fecha_de_nacimiento, 
                 p.direccion, p.ciudad, p.estado, p.codigo_postal, p.pais, p.genero, p.numero_de_telefono 
                 FROM usuarios u 
                 LEFT JOIN persona p ON u.id_usuario = p.usuario 
                 WHERE u.nombre_usuario = '$user_id'";
    $usuario = $db->seleccionar($consulta);
    $db->desconectarBD();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/GaelEstilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/panelusuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Datos personales</title>
    <style>
        .hidden { display: none; }
        .btn-toggle { display: flex; justify-content: flex-end; margin-bottom: 20px; }
        .input-group { margin-bottom: 20px; }
        .section-title { font-weight: bold; }
        .container { width: 80%; margin: 50px auto; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f8f9fa; }
        .is-invalid { border-color: #dc3545; }

        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 60%;
            margin: 50px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 strong, .section-title, hr, #pepon {
            color: rgb(116, 13, 13);
        }
        .section-title {
            font-weight: bold;
            font-size: 1.1rem;
        }
        hr {
            margin: 1rem 0;
        }
        .edit-link {
            text-decoration: none;
            color: #0d6efd;
        }
        .edit-link:hover {
            text-decoration: underline;
            color: rgb(116, 13, 13);
        }
        .verified {
            color: green;
            font-weight: bold;
        }

        .btn-danger {
            background-color: transparent;
            border: none;
            color: rgb(116, 13, 13);
        }
        .btn-danger:hover {
            background-color: rgba(116, 13, 13);
        }
    </style>
</head>
<body>

<header>
    <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4 ">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="index.php">
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
              <a class="nav-link" href="../index.php #2424"><label>SERVICIOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
</li>

         

            <li class="nav-item">
              <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>

<?php
  echo ' 
        <div class="header-content">
            <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                    <span class="material-symbols-outlined ">
                        account_circle
                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li><a class="dropdown-item" href="panelusuario.php"><span class="material-symbols-outlined lia"></span>Gestionar cuenta</a></li>
                    <li><a class="dropdown-item" href="panelusuario.php"><span class="material-symbols-outlined">travel_explore</span>Historial de Reservación</a></li>
                    <li><a class="dropdown-item" href="../Scripts/Cerrar_Sesion.php"><span class="material-symbols-outlined">logout 
                    <?php
                    
                    
                    ?>
                    </span>Cerrar sesión</a></li>
                </ul>
                
                
            </div>
        </div>
    </div>';

?>

          </ul>
        </div>
      </div>
    </nav>
  </div>
    </header>

    <br><br><br><br><br><br>
    <div class="container mt-3">
        <h1><strong>Datos personales</strong></h1>
        <p>Consulta tus datos</p>
        <hr class="mb-4">

        <?php if (empty($usuario)): ?>
            <p class="text-danger">No se encontraron datos del usuario.</p>
        <?php else: ?>
            <form id="datosForm" action="datospersonales.php" method="post">
                <!-- Sección para datos del usuario -->
                <div class="section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="section-title">Nombre de usuario</p>
                            <p id="nombreUsuario"><?= htmlspecialchars($usuario[0]->nombre_usuario) ?></p>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="section-title">Dirección de email</p>
                            <p id="email"><?= htmlspecialchars($usuario[0]->correo) ?></p>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <!-- Sección para datos de la persona -->
                <div class="section">
                    <h2>Datos Personales</h2>
                    <?php 
                    $campos_persona = [
                        'nombre' => 'Nombre', 'apellido_paterno' => 'Apellido Paterno','apellido_materno' => 'Apellido Materno','fecha_de_nacimiento' => 'Fecha de Nacimiento', 'direccion' => 'Dirección','ciudad' => 'Ciudad','estado' => 'Estado','codigo_postal' => 'Código Postal', 'pais' => 'País', 'genero' => 'Género','numero_de_telefono' => 'Número de Teléfono'
                    ];

                    foreach ($campos_persona as $campo => $titulo) {
                        $valor = htmlspecialchars($usuario[0]->$campo ?? '');
                    ?>
                        <div class="section">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="section-title"><?= $titulo ?></p>
                                    <p id="<?= $campo ?>Texto"><?= $valor ?></p>
                                </div>
                            </div>
                        </div>
                        <hr class="mb-4">
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="datospersonales.php" class="btn btn-danger">Modificar mi información</a>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
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
