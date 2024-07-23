<?php
session_start();

include '../Clases/BasedeDatos.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo_act = $_POST['correo_act'] ?? '';
    $contraseña_actual = $_POST['password_actual'] ?? '';
    $contraseña_nueva = $_POST['password_nueva'] ?? '';
    $nombre_user = $_POST['nombre_user'] ?? '';

    $db = new Database();
    $db->conectarDB();

    $obtener_id = "SELECT id_usuario, password FROM USUARIOS WHERE nombre_usuario = '" . $_SESSION['usuario'] . "'"; 
    $id_result = $db->seleccionar($obtener_id);

    if (!empty($id_result)) {
        $id = $id_result[0]->id_usuario;
        $hash_contraseña_actual = $id_result[0]->password;

        if (!empty($correo_act)) {
            $consulta = "CALL actualizar_informacion_correo_electronico ('$correo_act', $id)";
            $db->ejecuta($consulta);
            $_SESSION['mensaje'] = "Información de correo actualizada correctamente.";
        }

        if (!empty($contraseña_actual) && !empty($contraseña_nueva)) {
            if (password_verify($contraseña_actual, $hash_contraseña_actual)) {
                $hash_nueva_contraseña = password_hash($contraseña_nueva, PASSWORD_DEFAULT);
                $consulta = "CALL actualizar_informacion_contraseña('$hash_nueva_contraseña', $id)";
                $db->ejecuta($consulta);
                $_SESSION['mensaje'] = "Contraseña actualizada correctamente.";
            } else {
                $_SESSION['mensaje'] = "La contraseña actual es incorrecta.";
            }
        }

        if (!empty($nombre_user)) {
            $consulta = "CALL actualizar_informacion_nombre_usuario ('$nombre_user', $id)";
            $db->ejecuta($consulta);
            $_SESSION['mensaje'] = "Nombre de usuario actualizado correctamente. Su sesión terminará en 5 segundos.";
            $db->desconectarBD();
            session_write_close();
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Informacion Cuenta</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'>
            </head>
            <body>
                <div class='container mt-3'>
                    <div class='alert alert-info alert-dismissible fade show' role='alert'>
                        {$_SESSION['mensaje']}
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = 'Login.php';
                    }, 5000); // 5000 ms = 5 seconds
                </script>
                <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
            </body>
            </html>";
            exit();
        }
    }

    $db->desconectarBD();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/estilos_panel_busqueda.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Informacion Cuenta</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container-fluid">
        <a class="navbar-brand" href="panel_recepcionista.php">Hotel Laguna Inn</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <i class="fas fa-bed"></i> Huesped
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notificaciones.php">
                        <i class="fas fa-bed"></i> Notificaciones
                    </a>
                </li>
            </ul>
            <div class="header-right">
                <div class="btn-group">
                    <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu dropdown-menu-right">
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
<div class="container mt-3">
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?php 
            echo $_SESSION['mensaje']; 
            unset($_SESSION['mensaje']); 
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="usuario_confirar" class="form-label">Nuevo Nombre De Usuario</label>
            <input type="text" class="form-control" id="usuario_confirar" name="nombre_user">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nuevo Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="correo_act">
            <div id="emailHelp" class="form-text">Checa que tengas bien agregado el correo</div>
        </div>
        <div class="mb-3">
            <label for="password_actual" class="form-label">Contraseña Actual</label>
            <input type="password" class="form-control" id="password_actual" name="password_actual">
        </div>
        <div class="mb-3">
            <label for="password_nueva" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password_nueva" name="password_nueva">
        </div>
        <div class="mb-3">
            <label for="password_confirmar" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="password_confirmar" name="password_confirmar">
        </div>
        <button type="submit" class="btn btn-danger">Confirmar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
