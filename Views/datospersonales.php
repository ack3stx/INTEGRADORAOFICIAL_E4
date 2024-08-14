<?php
session_start();

if ($_SESSION["rol"] == "usuario") {
    include '../Clases/BasedeDatos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errores = [];
        $actualizar_usuario = false;
        $actualizar_persona = false;

        if (isset($_POST['tipo_formulario']) && $_POST['tipo_formulario'] === 'usuario') {
            $correo_act = $_POST['correo'] ?? '';
            $nombre_user = $_POST['nombre_usuario'] ?? '';
            $contraseña_actual = $_POST['password_actual'] ?? '';
            $contraseña_nueva = $_POST['password_nueva'] ?? '';
            $contraseña_nueva_confirm = $_POST['password_nueva_confirm'] ?? '';

            if (strlen($nombre_user) > 10) {
                $errores[] = "El nombre de usuario no debe tener más de 10 caracteres.";
            }

            if (!filter_var($correo_act, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El correo debe ser válido y contener '@'.";
            }

            if (strlen($nombre_user) === 0) {
                $errores[] = "Nombre de usuario no valido.";
            }

            if (!empty($contraseña_nueva) || !empty($contraseña_nueva_confirm)) {
                if (strlen($contraseña_nueva) < 6) {
                    $errores[] = "La nueva contraseña debe tener al menos 6 caracteres.";
                }
                if ($contraseña_nueva !== $contraseña_nueva_confirm) {
                    $errores[] = "Las contraseñas nuevas no coinciden.";
                }
                if (empty($contraseña_actual)) {
                    $errores[] = "Debe ingresar la contraseña actual.";
                }
            }

            // Validar si el nombre de usuario ya existe en la base de datos
            if (!empty($nombre_user)) {
                $db = new Database();
                $db->conectarDB();

                $consulta_nombre = "SELECT COUNT(*) AS count FROM USUARIOS WHERE NOMBRE_USUARIO = '$nombre_user' AND NOMBRE_USUARIO != '" . $_SESSION['usuario'] . "'";
                $resultado_nombre = $db->seleccionar($consulta_nombre);

                if ($resultado_nombre[0]->count > 0) {
                    $errores[] = "Este nombre de usuario ya existe.";
                }
            }

            if (empty($errores)) {
                $db = new Database();
                $db->conectarDB();

                $obtener_id = "SELECT ID_USUARIO, PASSWORD FROM USUARIOS WHERE NOMBRE_USUARIO = '" . $_SESSION['usuario'] . "'";
                $id_result = $db->seleccionar($obtener_id);

                if (!empty($id_result)) {
                    $id = $id_result[0]->ID_USUARIO;
                    $hash_contraseña_actual = $id_result[0]->PASSWORD;

                    $nombre_usuario_actualizado = false;
                    $correo_actualizado = false;
                    $contraseña_actualizada = false;

                    // con este actualizamos la contraseña
                    if (!empty($contraseña_nueva)) {
                        if (password_verify($contraseña_actual, $hash_contraseña_actual)) {
                            $hash_nueva_contraseña = password_hash($contraseña_nueva, PASSWORD_DEFAULT);
                            $consulta = "UPDATE USUARIOS SET PASSWORD = '$hash_nueva_contraseña' WHERE ID_USUARIO = $id";
                            $db->ejecuta($consulta);
                            $contraseña_actualizada = true;
                        } else {
                            $errores[] = "La contraseña actual es incorrecta.";
                        }
                    }

                    if (empty($errores)) {
                        // con esto actualizamos el nombre de usuario
                        if (!empty($nombre_user)) {
                            $consulta = "UPDATE USUARIOS SET NOMBRE_USUARIO = '$nombre_user' WHERE ID_USUARIO = $id";
                            $db->ejecuta($consulta);
                            $nombre_usuario_actualizado = true;
                        }

                        // con esto actualizamos el correo
                        if (!empty($correo_act)) {
                            $consulta = "UPDATE USUARIOS SET CORREO = '$correo_act' WHERE ID_USUARIO = $id";
                            $db->ejecuta($consulta);
                            $correo_actualizado = true;
                        }

                        $db->desconectarBD();

                        if ($nombre_usuario_actualizado || $correo_actualizado || $contraseña_actualizada) {
                            session_destroy();
                            header('Location: Login.php');
                            exit();
                        }
                    } else {
                        $_SESSION['mensaje'] = implode("<br>", $errores);
                        header('Location: datospersonales.php');
                        exit();
                    }
                }
            } else {
                $_SESSION['mensaje'] = implode("<br>", $errores);
                header('Location: datospersonales.php');
                exit();
            }
        }

        if (isset($_POST['tipo_formulario']) && $_POST['tipo_formulario'] === 'persona') {
            $nombre = $_POST['NOMBRE'] ?? '';
            $apellido_paterno = $_POST['APELLIDO_PATERNO'] ?? '';
            $apellido_materno = $_POST['APELLIDO_MATERNO'] ?? '';
            $fecha_de_nacimiento = $_POST['FECHA_DE_NACIMIENTO'] ?? '';
            $direccion = $_POST['DIRECCION'] ?? '';
            $ciudad = $_POST['CIUDAD'] ?? '';
            $estado = $_POST['ESTADO'] ?? '';
            $codigo_postal = $_POST['CODIGO_POSTAL'] ?? '';
            $pais = $_POST['PAIS'] ?? '';
            $genero = $_POST['GENERO'] ?? '';
            $numero_de_telefono = $_POST['NUMERO_DE_TELEFONO'] ?? '';

            

            if (strlen($numero_de_telefono) < 10) {
                $errores[] = "El numero de telefono debe contener al menos 10 digitos.";
            }
             // Validar si el número de teléfono ya existe en la base de datos
             if (!empty($numero_de_telefono)) {
                $db = new Database();
                $db->conectarDB();
            
                $consulta_telefono = "SELECT COUNT(*) AS count FROM PERSONA WHERE NUMERO_DE_TELEFONO = '$numero_de_telefono' AND USUARIO != (SELECT ID_USUARIO FROM USUARIOS WHERE NOMBRE_USUARIO = '" . $_SESSION['usuario'] . "')";
                $resultado_telefono = $db->seleccionar($consulta_telefono);
            
                if ($resultado_telefono[0]->count > 0) {
                    $errores[] = "Este número de teléfono ya está registrado.";
                }
            }
            

            if (empty($errores)) {
                $db = new Database();
                $db->conectarDB();

                $obtener_id = "SELECT ID_USUARIO FROM USUARIOS WHERE NOMBRE_USUARIO = '" . $_SESSION['usuario'] . "'";
                $id_result = $db->seleccionar($obtener_id);

                if (!empty($id_result)) {
                    $id = $id_result[0]->ID_USUARIO;
        
                    // Selecciona el ID_PERSONA correspondiente al usuario
                    $consulta_persona = "SELECT ID_PERSONA FROM PERSONA WHERE USUARIO = $id";
                    $persona_result = $db->seleccionar($consulta_persona);
        
                    if (!empty($persona_result)) {
                        $ID_PERSONA = $persona_result[0]->ID_PERSONA;
                        $CONSULTA_UPDATE_PERSONA = "UPDATE PERSONA SET 
                            NOMBRE = '$nombre', APELLIDO_PATERNO = '$apellido_paterno', APELLIDO_MATERNO = '$apellido_materno', 
                            FECHA_DE_NACIMIENTO = '$fecha_de_nacimiento', DIRECCION = '$direccion', CIUDAD = '$ciudad', 
                            ESTADO = '$estado', CODIGO_POSTAL = '$codigo_postal', PAIS = '$pais', GENERO = '$genero', 
                            NUMERO_DE_TELEFONO = '$numero_de_telefono' WHERE ID_PERSONA = $ID_PERSONA";
                        $db->ejecuta($CONSULTA_UPDATE_PERSONA);
                        $_SESSION['mensaje'] = "Datos personales actualizados correctamente.";
                    } else {
                        // Inserción de una nueva entrada en PERSONA
                        $CONSULTA_INSERT_PERSONA = "INSERT INTO PERSONA (NOMBRE, APELLIDO_PATERNO, APELLIDO_MATERNO, FECHA_DE_NACIMIENTO, DIRECCION, CIUDAD, ESTADO, CODIGO_POSTAL, PAIS, GENERO, NUMERO_DE_TELEFONO, USUARIO) 
                        VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_de_nacimiento', '$direccion', '$ciudad', '$estado', '$codigo_postal', '$pais', '$genero', '$numero_de_telefono', $id)";
                        $db->ejecuta($CONSULTA_INSERT_PERSONA);
                        $_SESSION['mensaje'] = "Datos personales añadidos correctamente.";
                        
                    }
                    

                    $db->desconectarBD();
                    header('Location: datospersonales.php');
                    exit();
                }
               
            } else {
                $_SESSION['mensaje'] = implode("<br>", $errores);
                header('Location: datospersonales.php');
                exit();
            }
        }
    } else {
        $db = new Database();
        $db->conectarDB();
        $user_id = $_SESSION['usuario'];

        $consulta = "SELECT U.NOMBRE_USUARIO, U.CORREO, U.PASSWORD, P.NOMBRE, P.APELLIDO_PATERNO, P.APELLIDO_MATERNO, P.FECHA_DE_NACIMIENTO, P.DIRECCION, P.CIUDAD, P.ESTADO, P.CODIGO_POSTAL, P.PAIS, P.GENERO, P.NUMERO_DE_TELEFONO 
                     FROM USUARIOS U 
                     LEFT JOIN PERSONA P ON U.ID_USUARIO = P.USUARIO 
                     WHERE U.NOMBRE_USUARIO = '$user_id'";
        $usuario = $db->seleccionar($consulta);
        $db->desconectarBD();
    }
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
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <style>
        .hidden { display: none; }
        .btn-toggle { display: flex; justify-content: flex-end; margin-bottom: 20px; }
        .input-group { margin-bottom: 20px; }
        .section-title { font-weight: bold; }
        .container { width: 80%; margin: 50px auto; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f8f9fa; }
        .is-invalid { border-color: #dc3545; }
        .invalid-feedback { display: block; }
        .is-valid { border-color: #28a745; }
        .valid-feedback { display: block; color: #28a745; }

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
                    <?php
                    
                    
                    ?>
                    
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
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?php 
                echo $_SESSION['mensaje']; 
                unset($_SESSION['mensaje']); 
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h1><strong>Datos de mi cuenta</strong></h1>
        <p id="pepon">Actualiza tus datos y descubre cómo se utilizan</p>
        <hr class="mb-4">

        <?php if (empty($usuario)): ?>
            <p class="text-danger">No se encontraron datos del usuario.</p>
        <?php else: ?>
            <form id="formUsuario" action="datospersonales.php" method="post">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Contraseña</p>
                <p id="passwordTexto">******</p>
            </div>
            <button type="button" id="btnEditarPassword" class="btn btn-danger">Editar</button>
        </div>
        <div id="formPassword" class="hidden">
            <input type="password" id="passwordActual" name="password_actual" class="form-control mb-2" placeholder="Contraseña actual">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <input type="password" id="passwordNueva" name="password_nueva" class="form-control mb-2" placeholder="Nueva contraseña">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <input type="password" id="passwordNuevaConfirm" name="password_nueva_confirm" class="form-control mb-2" placeholder="Confirmar nueva contraseña">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarPassword" class="btn btn-danger">Cancelar</button>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button type="submit" id="btnGuardarUsuario" class="btn btn-danger">Guardar cambios</button>
    </div>
</form>

<form id="formPersona" action="datospersonales.php" method="post">
    <input type="hidden" name="tipo_formulario" value="persona">
    <h1><strong>Mis datos</strong></h1>
    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Nombre</p>
                <p id="NOMBRETexto"><?= htmlspecialchars($usuario[0]->NOMBRE ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarNombre" class="btn btn-danger">Editar</button>
        </div>
        <div id="formNombre" class="hidden">
            <input type="text" id="NOMBRE" name="NOMBRE" class="form-control mb-2 <?= empty($usuario[0]->NOMBRE) ? 'is-invalid' : '' ?>" placeholder="Nombre" value="<?= htmlspecialchars($usuario[0]->NOMBRE ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarNombre" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Apellido Paterno</p>
                <p id="APELLIDO_PATERNOTexto"><?= htmlspecialchars($usuario[0]->APELLIDO_PATERNO ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarApellidoPaterno" class="btn btn-danger">Editar</button>
        </div>
        <div id="formApellidoPaterno" class="hidden">
            <input type="text" id="APELLIDO_PATERNO" name="APELLIDO_PATERNO" class="form-control mb-2 <?= empty($usuario[0]->APELLIDO_PATERNO) ? 'is-invalid' : '' ?>" placeholder="Apellido Paterno" value="<?= htmlspecialchars($usuario[0]->APELLIDO_PATERNO ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarApellidoPaterno" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Apellido Materno</p>
                <p id="APELLIDO_MATERNOTexto"><?= htmlspecialchars($usuario[0]->APELLIDO_MATERNO ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarApellidoMaterno" class="btn btn-danger">Editar</button>
        </div>
        <div id="formApellidoMaterno" class="hidden">
            <input type="text" id="APELLIDO_MATERNO" name="APELLIDO_MATERNO" class="form-control mb-2 <?= empty($usuario[0]->APELLIDO_MATERNO) ? 'is-invalid' : '' ?>" placeholder="Apellido Materno" value="<?= htmlspecialchars($usuario[0]->APELLIDO_MATERNO ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarApellidoMaterno" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Fecha de Nacimiento</p>
                <p id="FECHA_DE_NACIMIENTOTexto"><?= htmlspecialchars($usuario[0]->FECHA_DE_NACIMIENTO ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarFechaNacimiento" class="btn btn-danger">Editar</button>
        </div>
        <div id="formFechaNacimiento" class="hidden">
            <input type="date" id="FECHA_DE_NACIMIENTO" name="FECHA_DE_NACIMIENTO" class="form-control mb-2 <?= empty($usuario[0]->FECHA_DE_NACIMIENTO) ? 'is-invalid' : '' ?>" value="<?= htmlspecialchars($usuario[0]->FECHA_DE_NACIMIENTO ?? '') ?>" min="1950-01-01" max="<?= date('Y-m-d', strtotime('-18 years')) ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarFechaNacimiento" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Dirección</p>
                <p id="DIRECCIONTexto"><?= htmlspecialchars($usuario[0]->DIRECCION ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarDireccion" class="btn btn-danger">Editar</button>
        </div>
        <div id="formDireccion" class="hidden">
            <input type="text" id="DIRECCION" name="DIRECCION" class="form-control mb-2 <?= empty($usuario[0]->DIRECCION) ? 'is-invalid' : '' ?>" placeholder="Dirección" value="<?= htmlspecialchars($usuario[0]->DIRECCION ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarDireccion" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Ciudad</p>
                <p id="CIUDADTexto"><?= htmlspecialchars($usuario[0]->CIUDAD ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarCiudad" class="btn btn-danger">Editar</button>
        </div>
        <div id="formCiudad" class="hidden">
            <input type="text" id="CIUDAD" name="CIUDAD" class="form-control mb-2 <?= empty($usuario[0]->CIUDAD) ? 'is-invalid' : '' ?>" placeholder="Ciudad" value="<?= htmlspecialchars($usuario[0]->CIUDAD ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarCiudad" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Estado</p>
                <p id="ESTADOTexto"><?= htmlspecialchars($usuario[0]->ESTADO ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarEstado" class="btn btn-danger">Editar</button>
        </div>
        <div id="formEstado" class="hidden">
            <input type="text" id="ESTADO" name="ESTADO" class="form-control mb-2 <?= empty($usuario[0]->ESTADO) ? 'is-invalid' : '' ?>" placeholder="Estado" value="<?= htmlspecialchars($usuario[0]->ESTADO ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarEstado" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Código Postal</p>
                <p id="CODIGO_POSTALTexto"><?= htmlspecialchars($usuario[0]->CODIGO_POSTAL ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarCodigoPostal" class="btn btn-danger">Editar</button>
        </div>
        <div id="formCodigoPostal" class="hidden">
            <input type="text" id="CODIGO_POSTAL" name="CODIGO_POSTAL" class="form-control mb-2 <?= empty($usuario[0]->CODIGO_POSTAL) ? 'is-invalid' : '' ?>" placeholder="Código Postal" value="<?= htmlspecialchars($usuario[0]->CODIGO_POSTAL ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarCodigoPostal" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">País</p>
                <p id="PAISTexto"><?= htmlspecialchars($usuario[0]->PAIS ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarPais" class="btn btn-danger">Editar</button>
        </div>
        <div id="formPais" class="hidden">
            <input type="text" id="PAIS" name="PAIS" class="form-control mb-2 <?= empty($usuario[0]->PAIS) ? 'is-invalid' : '' ?>" placeholder="País" value="<?= htmlspecialchars($usuario[0]->PAIS ?? '') ?>">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarPais" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Género</p>
                <p id="GENEROTexto"><?= htmlspecialchars($usuario[0]->GENERO ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarGenero" class="btn btn-danger">Editar</button>
        </div>
        <div id="formGenero" class="hidden">
            <select id="GENERO" name="GENERO" class="form-control mb-2 <?= empty($usuario[0]->GENERO) ? 'is-invalid' : '' ?>">
                <option value="M" <?= ($usuario[0]->GENERO ?? '') == 'M' ? 'selected' : '' ?>>Masculino</option>
                <option value="F" <?= ($usuario[0]->GENERO ?? '') == 'F' ? 'selected' : '' ?>>Femenino</option>
            </select>
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarGenero" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="section">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="section-title">Número de Teléfono</p>
                <p id="NUMERO_DE_TELEFONOTexto"><?= htmlspecialchars($usuario[0]->NUMERO_DE_TELEFONO ?? '') ?></p>
            </div>
            <button type="button" id="btnEditarNumeroDeTelefono" class="btn btn-danger">Editar</button>
        </div>
        <div id="formNumeroDeTelefono" class="hidden">
            <input type="text" id="NUMERO_DE_TELEFONO" name="NUMERO_DE_TELEFONO" class="form-control mb-2 <?= empty($usuario[0]->NUMERO_DE_TELEFONO) ? 'is-invalid' : '' ?>" placeholder="Número de Teléfono" value="<?= htmlspecialchars($usuario[0]->NUMERO_DE_TELEFONO ?? '') ?>" maxlength="10">
            <div class="invalid-feedback"></div>
            <div class="valid-feedback"></div>
            <button type="button" id="btnCancelarNumeroDeTelefono" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    <hr class="mb-4">

    <div class="d-flex justify-content-end mt-4">
    <button type="submit" id="btnGuardarUsuario" class="btn btn-danger">Guardar cambios</button>
    </div>
</form>


        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const formUsuario = document.getElementById('formUsuario');
        const formPersona = document.getElementById('formPersona');

        const passwordActual = formUsuario.querySelector('#passwordActual');
        const passwordNueva = formUsuario.querySelector('#passwordNueva');
        const passwordNuevaConfirm = formUsuario.querySelector('#passwordNuevaConfirm');
        const btnGuardarUsuario = formUsuario.querySelector('#btnGuardarUsuario');
        const numeroDeTelefono = formPersona.querySelector('#NUMERO_DE_TELEFONO');
        const fechaNacimiento = formPersona.querySelector('#FECHA_DE_NACIMIENTO');
        const codigoPostal = formPersona.querySelector('#CODIGO_POSTAL');
        const direccion = formPersona.querySelector('#DIRECCION');
        const btnGuardarCambios = formPersona.querySelector('#btnGuardarCambios');

        const fieldsToValidate = [
            'NOMBRE', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'PAIS', 'ESTADO', 'CIUDAD'
        ];

        function validarContraseñas() {
            let errores = false;

            if (passwordActual.value.trim() === '') {
                passwordActual.classList.add('is-invalid');
                passwordActual.nextElementSibling.textContent = 'Debe ingresar la contraseña actual.';
                errores = true;
            } else {
                passwordActual.classList.remove('is-invalid');
                passwordActual.classList.add('is-valid');
                passwordActual.nextElementSibling.textContent = '';
            }

            if (passwordNueva.value !== passwordNuevaConfirm.value) {
                passwordNuevaConfirm.classList.add('is-invalid');
                passwordNuevaConfirm.nextElementSibling.textContent = 'Las contraseñas no coinciden.';
                errores = true;
            } else {
                passwordNuevaConfirm.classList.remove('is-invalid');
                passwordNuevaConfirm.classList.add('is-valid');
                passwordNuevaConfirm.nextElementSibling.textContent = '';
            }

            if (passwordNueva.value.length > 0 && passwordNueva.value.length < 6) {
                passwordNueva.classList.add('is-invalid');
                passwordNueva.nextElementSibling.textContent = 'La nueva contraseña debe tener al menos 6 caracteres.';
                errores = true;
            } else {
                passwordNueva.classList.remove('is-invalid');
                passwordNueva.classList.add('is-valid');
                passwordNueva.nextElementSibling.textContent = '';
            }

            btnGuardarUsuario.disabled = errores;
            return !errores;
        }

        function validarNumeroDeTelefono() {
            let errores = false;
            if (numeroDeTelefono.value.length < 10 || /[^0-9]/.test(numeroDeTelefono.value)) {
                numeroDeTelefono.classList.add('is-invalid');
                numeroDeTelefono.nextElementSibling.textContent = 'El número de teléfono debe tener 10 dígitos y solo contener números.';
                errores = true;
            } else {
                numeroDeTelefono.classList.remove('is-invalid');
                numeroDeTelefono.classList.add('is-valid');
                numeroDeTelefono.nextElementSibling.textContent = '';
            }

            btnGuardarCambios.disabled = errores;
            return !errores;
        }

        function validarCampoSinCaracteresEspeciales(event) {
            const regex = /[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g;
            if (regex.test(event.target.value)) {
                event.target.classList.add('is-invalid');
                event.target.nextElementSibling.textContent = 'No se permiten caracteres especiales.';
                btnGuardarCambios.disabled = true;
            } else {
                event.target.classList.remove('is-invalid');
                event.target.classList.add('is-valid');
                event.target.nextElementSibling.textContent = '';
                btnGuardarCambios.disabled = false;
            }
        }

        function validarCodigoPostal(event) {
            const regex = /[^a-zA-Z0-9]/g;
            if (regex.test(event.target.value)) {
                event.target.classList.add('is-invalid');
                event.target.nextElementSibling.textContent = 'El código postal no puede contener caracteres especiales.';
                btnGuardarCambios.disabled = true;
            } else {
                event.target.classList.remove('is-invalid');
                event.target.classList.add('is-valid');
                event.target.nextElementSibling.textContent = '';
                btnGuardarCambios.disabled = false;
            }
        }

        passwordActual.addEventListener('input', validarContraseñas);
        passwordNueva.addEventListener('input', validarContraseñas);
        passwordNuevaConfirm.addEventListener('input', validarContraseñas);

        numeroDeTelefono.addEventListener('input', validarNumeroDeTelefono);
        codigoPostal.addEventListener('input', validarCodigoPostal);
        direccion.addEventListener('input', function() {
            validarCampoSinCaracteresEspeciales({ target: direccion });
        });

        fieldsToValidate.forEach(fieldName => {
            const field = formPersona.querySelector(`#${fieldName}`);
            field.addEventListener('input', validarCampoSinCaracteresEspeciales);
        });

        fechaNacimiento.addEventListener('input', function () {
            const fechaNacimientoValue = new Date(fechaNacimiento.value);
            const fechaMinima = new Date();
            const fechaMinima2 = new Date();
            fechaMinima.setFullYear(fechaMinima.getFullYear() - 18);
            fechaMinima2.setFullYear(fechaMinima2.getFullYear() - 74);

            if (fechaNacimientoValue > fechaMinima) {
                fechaNacimiento.classList.add('is-invalid');
                fechaNacimiento.nextElementSibling.textContent = 'Debe ser mayor de 18 años.';
                btnGuardarCambios.disabled = true;
            } else if (fechaNacimientoValue < fechaMinima2) {
                fechaNacimiento.classList.add('is-invalid');
                fechaNacimiento.nextElementSibling.textContent = 'Fecha no válida.';
                btnGuardarCambios.disabled = true;
            } else {
                fechaNacimiento.classList.remove('is-invalid');
                fechaNacimiento.classList.add('is-valid');
                fechaNacimiento.nextElementSibling.textContent = '';
                btnGuardarCambios.disabled = false;
            }
        });

        function mostrarErrorYDesplazarse(form, input) {
            const inputContainer = input.closest('.section').querySelector('div.hidden');
            inputContainer.classList.remove('hidden');
            const offset = inputContainer.getBoundingClientRect().top + window.scrollY - 100;
            window.scrollTo({ top: offset, behavior: 'smooth' });
            input.focus();
        }

        formUsuario.addEventListener('submit', function (event) {
            let valid = validarContraseñas();
            if (!valid) {
                event.preventDefault();
                const firstInvalidInput = formUsuario.querySelector('.is-invalid');
                if (firstInvalidInput) {
                    mostrarErrorYDesplazarse(formUsuario, firstInvalidInput);
                }
            }
        });

        formPersona.addEventListener('submit', function (event) {
            let valid = true;
            fieldsToValidate.forEach(fieldName => {
                const field = formPersona.querySelector(`#${fieldName}`);
                validarCampoSinCaracteresEspeciales({ target: field });
                if (field.classList.contains('is-invalid')) {
                    valid = false;
                }
            });
            if (!valid) {
                event.preventDefault();
                const firstInvalidInput = formPersona.querySelector('.is-invalid');
                if (firstInvalidInput) {
                    mostrarErrorYDesplazarse(formPersona, firstInvalidInput);
                }
            }

            const validTelefono = validarNumeroDeTelefono();
            if (!validTelefono) {
                event.preventDefault();
                mostrarErrorYDesplazarse(formPersona, numeroDeTelefono);
            }

            const validCodigoPostal = validarCodigoPostal({ target: codigoPostal });
            if (!validCodigoPostal) {
                event.preventDefault();
                mostrarErrorYDesplazarse(formPersona, codigoPostal);
            }
        });

        // Validación de letras y números
        const inputLettersOnly = ['NOMBRE', 'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'CIUDAD', 'PAIS', 'ESTADO'];
        const inputNumbersOnly = ['NUMERO_DE_TELEFONO'];

        inputLettersOnly.forEach(id => {
            const input = document.querySelector(`#${id}`);
            if (input) {
                input.addEventListener('keypress', function (event) {
                    if (/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/.test(event.key)) {
                        event.preventDefault();
                    }
                });
            }
        });

        inputNumbersOnly.forEach(id => {
            const input = document.querySelector(`#${id}`);
            if (input) {
                input.addEventListener('keypress', function (event) {
                    if (/\D/.test(event.key) || input.value.length >= 10) {
                        event.preventDefault();
                    }
                });
            }
        });

        const disableFormButtons = (disableFormId, isDisabled) => {
            const form = document.getElementById(disableFormId);
            const buttons = form.querySelectorAll('button');
            buttons.forEach(button => {
                button.disabled = isDisabled;
            });
        };

        const toggleSection = (buttonId, formId, disableButtons, disableFormId) => {
            document.getElementById(buttonId).addEventListener('click', () => {
                document.getElementById(formId).classList.remove('hidden');
                document.getElementById(buttonId).classList.add('hidden');
                disableButtons.forEach(btn => {
                    document.getElementById(btn).classList.add('hidden');
                });
                disableFormButtons(disableFormId, true);
            });
        };

        const cancelSection = (cancelBtnId, buttonId, formId, disableButtons, disableFormId) => {
            document.getElementById(cancelBtnId).addEventListener('click', () => {
                document.getElementById(formId).classList.add('hidden');
                document.getElementById(buttonId).classList.remove('hidden');
                disableButtons.forEach(btn => {
                    document.getElementById(btn).classList.remove('hidden');
                });
                disableFormButtons(disableFormId, false);
            });
        };

        // Ocultar y mostrar las secciones correspondientes al perfil de usuario y los detalles de la persona
        toggleSection('editarPerfilUsuario', 'formUsuario', ['editarPerfilPersona', 'btnEditarDireccion'], 'formPersona');
        cancelSection('cancelarEdicionUsuario', 'editarPerfilUsuario', 'formUsuario', ['editarPerfilPersona', 'btnEditarDireccion'], 'formPersona');

        toggleSection('editarPerfilPersona', 'formPersona', ['editarPerfilUsuario', 'btnEditarDireccion'], 'formUsuario');
        cancelSection('cancelarEdicionPersona', 'editarPerfilPersona', 'formPersona', ['editarPerfilUsuario', 'btnEditarDireccion'], 'formUsuario');

        toggleSection('btnEditarDireccion', 'formDireccion', ['editarPerfilUsuario', 'editarPerfilPersona'], 'formUsuario');
        cancelSection('cancelarEdicionDireccion', 'btnEditarDireccion', 'formDireccion', ['editarPerfilUsuario', 'editarPerfilPersona'], 'formUsuario');
    });
</script>




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