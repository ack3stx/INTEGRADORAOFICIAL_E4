<?php
session_start();

if ($_SESSION["rol"] == "usuario") {
    include '../Clases/BasedeDatos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $correo_act = $_POST['correo'] ?? '';
        $nombre_user = $_POST['nombre_usuario'] ?? '';
        $contraseña_actual = $_POST['password_actual'] ?? '';
        $contraseña_nueva = $_POST['password_nueva'] ?? '';
        $contraseña_nueva_confirm = $_POST['password_nueva_confirm'] ?? '';

        $nombre = $_POST['nombre'] ?? '';
        $apellido_paterno = $_POST['apellido_paterno'] ?? '';
        $apellido_materno = $_POST['apellido_materno'] ?? '';
        $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $ciudad = $_POST['ciudad'] ?? '';
        $estado = $_POST['estado'] ?? '';
        $codigo_postal = $_POST['codigo_postal'] ?? '';
        $pais = $_POST['pais'] ?? '';
        $genero = $_POST['genero'] ?? '';
        $numero_de_telefono = $_POST['numero_de_telefono'] ?? '';

        $errores = [];

        // Validación de los campos
        $required_fields = [
            'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_de_nacimiento',
            'direccion', 'ciudad', 'estado', 'codigo_postal', 'pais', 'genero', 'numero_de_telefono'
        ];
        foreach ($required_fields as $field) {
            if (empty($$field)) {
                $errores[] = "El campo $field es obligatorio.";
            }
        }

        // Validaciones específicas
        if (!empty($numero_de_telefono) && !preg_match('/^[0-9]+$/', $numero_de_telefono)) {
            $errores[] = "El número de teléfono solo debe contener números.";
        }
        if (!empty($nombre) && preg_match('/[0-9]/', $nombre)) {
            $errores[] = "El nombre no debe contener números.";
        }
        if (!empty($apellido_paterno) && preg_match('/[0-9]/', $apellido_paterno)) {
            $errores[] = "El apellido paterno no debe contener números.";
        }
        if (!empty($apellido_materno) && preg_match('/[0-9]/', $apellido_materno)) {
            $errores[] = "El apellido materno no debe contener números.";
        }
        if (!empty($pais) && preg_match('/[0-9]/', $pais)) {
            $errores[] = "El país no debe contener números.";
        }
        if (!empty($estado) && preg_match('/[0-9]/', $estado)) {
            $errores[] = "El estado no debe contener números.";
        }
        if (!empty($ciudad) && preg_match('/[0-9]/', $ciudad)) {
            $errores[] = "La ciudad no debe contener números.";
        }

        $fecha_actual = date('Y-m-d');
        $fecha_minima = '1950-01-01';
        if ($fecha_de_nacimiento < $fecha_minima || $fecha_de_nacimiento > $fecha_actual) {
            $errores[] = "La fecha de nacimiento debe estar entre 1950-01-01 y $fecha_actual.";
        }

        if (!empty($contraseña_nueva) || !empty($contraseña_nueva_confirm)) {
            if ($contraseña_nueva !== $contraseña_nueva_confirm) {
                $errores[] = "Las contraseñas nuevas no coinciden.";
            }
            if (empty($contraseña_actual)) {
                $errores[] = "Debe ingresar la contraseña actual.";
            }
        }

        if (empty($errores)) {
            $db = new Database();
            $db->conectarDB();

            $obtener_id = "SELECT id_usuario, password FROM usuarios WHERE nombre_usuario = '" . $_SESSION['usuario'] . "'";
            $id_result = $db->seleccionar($obtener_id);

            if (!empty($id_result)) {
                $id = $id_result[0]->id_usuario;
                $hash_contraseña_actual = $id_result[0]->password;

                $nombre_usuario_actualizado = false;
                $correo_actualizado = false;
                $contraseña_actualizada = false;
                $datos_personales_actualizados = false;
                $datos_personales_insertados = false;

                // Actualizar contraseña
                if (!empty($contraseña_nueva)) {
                    if (password_verify($contraseña_actual, $hash_contraseña_actual)) {
                        $hash_nueva_contraseña = password_hash($contraseña_nueva, PASSWORD_DEFAULT);
                        $consulta = "UPDATE usuarios SET password = '$hash_nueva_contraseña' WHERE id_usuario = $id";
                        $db->ejecuta($consulta);
                        $_SESSION['mensaje'] = "Contraseña actualizada correctamente.";
                        $contraseña_actualizada = true;
                    } else {
                        $errores[] = "La contraseña actual es incorrecta.";
                    }
                }

                if (empty($errores)) {
                    // Actualizar nombre de usuario
                    if (!empty($nombre_user)) {
                        $consulta = "UPDATE usuarios SET nombre_usuario = '$nombre_user' WHERE id_usuario = $id";
                        $db->ejecuta($consulta);
                        $nombre_usuario_actualizado = true;
                    }

                    // Actualizar correo
                    if (!empty($correo_act)) {
                        $consulta = "UPDATE usuarios SET correo = '$correo_act' WHERE id_usuario = $id";
                        $db->ejecuta($consulta);
                        $correo_actualizado = true;
                    }

                    // Actualizar datos personales
                    $consulta_persona = "SELECT id_persona FROM persona WHERE usuario = $id";
                    $persona_result = $db->seleccionar($consulta_persona);

                    if (!empty($persona_result)) {
                        $id_persona = $persona_result[0]->id_persona;
                        $consulta_update_persona = "UPDATE persona SET 
                            nombre = '$nombre', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', 
                            fecha_de_nacimiento = '$fecha_de_nacimiento', direccion = '$direccion', ciudad = '$ciudad', 
                            estado = '$estado', codigo_postal = '$codigo_postal', pais = '$pais', genero = '$genero', 
                            numero_de_telefono = '$numero_de_telefono' WHERE id_persona = $id_persona";
                        $db->ejecuta($consulta_update_persona);
                        $_SESSION['mensaje'] = "Datos personales actualizados correctamente.";
                        $datos_personales_actualizados = true;
                    } else {
                        $consulta_insert_persona = "INSERT INTO persona (nombre, apellido_paterno, apellido_materno, fecha_de_nacimiento, direccion, ciudad, estado, codigo_postal, pais, genero, numero_de_telefono, usuario) VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_de_nacimiento', '$direccion', '$ciudad', '$estado', '$codigo_postal', '$pais', '$genero', '$numero_de_telefono', $id)";
                        $db->ejecuta($consulta_insert_persona);
                        $_SESSION['mensaje'] = "Datos personales añadidos correctamente.";
                        $datos_personales_insertados = true;
                    }

                    $db->desconectarBD();

                    if ($nombre_usuario_actualizado || $correo_actualizado || $contraseña_actualizada) {
                        session_destroy();
                        header('Location: Login.php');
                        exit();
                    } else {
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
            $_SESSION['mensaje'] = implode("<br>", $errores);
            header('Location: datospersonales.php');
            exit();
        }
    } else {
        $db = new Database();
        $db->conectarDB();
        $user_id = $_SESSION['usuario'];

        $consulta = "SELECT u.nombre_usuario, u.correo, u.password, p.nombre, p.apellido_paterno, p.apellido_materno, p.fecha_de_nacimiento, p.direccion, p.ciudad, p.estado, p.codigo_postal, p.pais, p.genero, p.numero_de_telefono 
                     FROM usuarios u 
                     LEFT JOIN persona p ON u.id_usuario = p.usuario 
                     WHERE u.nombre_usuario = '$user_id'";
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

        <h1><strong>Datos personales</strong></h1>
        <p id="pepon">Actualiza tus datos y descubre cómo se utilizan</p>
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
                        <button type="button" id="btnEditarNombreUsuario" class="btn btn-danger">Editar</button>
                    </div>
                    <div id="formNombreUsuario" class="hidden">
                        <input type="text" name="nombre_usuario" class="form-control mb-2" placeholder="Nombre de usuario" value="<?= htmlspecialchars($usuario[0]->nombre_usuario) ?>">
                        <button type="button" id="btnCancelarNombreUsuario" class="btn btn-danger">Cancelar</button>
                        <button type="button" id="btnListoNombreUsuario" class="btn btn-danger">Listo</button>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="section-title">Dirección de email</p>
                            <p id="email"><?= htmlspecialchars($usuario[0]->correo) ?></p>
                        </div>
                        <button type="button" id="btnEditarEmail" class="btn btn-danger">Editar</button>
                    </div>
                    <div id="formEmail" class="hidden">
                        <input type="email" name="correo" class="form-control mb-2" placeholder="Correo electrónico" value="<?= htmlspecialchars($usuario[0]->correo) ?>">
                        <button type="button" id="btnCancelarEmail" class="btn btn-danger">Cancelar</button>
                        <button type="button" id="btnListoEmail" class="btn btn-danger">Listo</button>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="section-title">Contraseña</p>
                            <p id="password">******</p>
                        </div>
                        <button type="button" id="btnEditarPassword" class="btn btn-danger">Editar</button>
                    </div>
                    <div id="formPassword" class="hidden">
                        <input type="password" name="password_actual" class="form-control mb-2" placeholder="Contraseña actual">
                        <input type="password" name="password_nueva" class="form-control mb-2" placeholder="Nueva contraseña">
                        <input type="password" name="password_nueva_confirm" class="form-control mb-2" placeholder="Confirmar nueva contraseña">
                        <button type="button" id="btnCancelarPassword" class="btn btn-danger">Cancelar</button>
                        <button type="button" id="btnListoPassword" class="btn btn-danger">Listo</button>
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
                        $clase_peligro = empty($valor) ? 'is-invalid' : '';
                        $inputType = ($campo == 'fecha_de_nacimiento') ? 'date' : 'text';
                        if ($campo == 'genero') {
                            $inputType = 'select';
                        }
                    ?>
                        <div class="section">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="section-title"><?= $titulo ?></p>
                                    <p id="<?= $campo ?>Texto"><?= $valor ?></p>
                                </div>
                                <button type="button" id="btnEditar<?= ucfirst($campo) ?>" class="btn btn-danger">Editar</button>
                            </div>
                            <div id="form<?= ucfirst($campo) ?>" class="hidden">
                                <?php if ($inputType == 'select'): ?>
                                    <select name="<?= $campo ?>" class="form-control mb-2 <?= $clase_peligro ?>">
                                        <option value="M" <?= $valor == 'M' ? 'selected' : '' ?>>M</option>
                                        <option value="F" <?= $valor == 'F' ? 'selected' : '' ?>>F</option>
                                    </select>
                                <?php else: ?>
                                    <input type="<?= $inputType ?>" name="<?= $campo ?>" class="form-control mb-2 <?= $clase_peligro ?>" placeholder="<?= $titulo ?>" value="<?= $valor ?>" 
                                    <?php if ($campo == 'fecha_de_nacimiento') echo "min='1950-01-01' max='" . date('Y-m-d') . "'"; ?>>
                                <?php endif; ?>
                                <button type="button" id="btnCancelar<?= ucfirst($campo) ?>" class="btn btn-danger">Cancelar</button>
                                <button type="button" id="btnListo<?= ucfirst($campo) ?>" class="btn btn-danger">Listo</button>
                            </div>
                        </div>
                        <hr class="mb-4">
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" id="btnConfirmar" class="btn btn-danger" disabled>Confirmar cambios</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script>
        const toggleSection = (buttonId, formId, disableButtons) => {
            document.getElementById(buttonId).addEventListener('click', () => {
                document.getElementById(formId).classList.remove('hidden');
                document.getElementById(buttonId).classList.add('hidden');
                disableButtons.forEach(btn => {
                    document.getElementById(btn).disabled = true;
                });
            });

            document.getElementById('btnCancelar' + formId.replace('form', '')).addEventListener('click', () => {
                document.getElementById(formId).classList.add('hidden');
                document.getElementById(buttonId).classList.remove('hidden');
                disableButtons.forEach(btn => {
                    document.getElementById(btn).disabled = false;
                });
            });

            document.getElementById('btnListo' + formId.replace('form', '')).addEventListener('click', () => {
                const inputs = document.querySelectorAll('#' + formId + ' input, #' + formId + ' select');
                let isValid = true;
                
                inputs.forEach(input => {
                    if (input.value.trim() === '') {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }

                    if (input.name === 'numero_de_telefono' && /\D/.test(input.value)) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    }

                    if (['nombre', 'apellido_paterno', 'apellido_materno', 'pais', 'estado', 'ciudad'].includes(input.name) && /\d/.test(input.value)) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    }

                    if (input.name === 'fecha_de_nacimiento') {
                        const fecha = new Date(input.value);
                        const fechaMinima = new Date('1950-01-01');
                        const fechaMaxima = new Date();
                        if (fecha < fechaMinima || fecha > fechaMaxima) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        }
                    }
                });

                if (isValid) {
                    document.getElementById(formId).classList.add('hidden');
                    document.getElementById(buttonId).classList.remove('hidden');
                    disableButtons.forEach(btn => {
                        document.getElementById(btn).disabled = false;
                    });
                    document.getElementById('btnConfirmar').disabled = false;
                }
            });
        };

        toggleSection('btnEditarNombreUsuario', 'formNombreUsuario', ['btnEditarEmail', 'btnEditarPassword']);
        toggleSection('btnEditarEmail', 'formEmail', ['btnEditarNombreUsuario', 'btnEditarPassword']);
        toggleSection('btnEditarPassword', 'formPassword', ['btnEditarNombreUsuario', 'btnEditarEmail']);

        <?php foreach ($campos_persona as $campo => $titulo) { ?>
            toggleSection('btnEditar<?= ucfirst($campo) ?>', 'form<?= ucfirst($campo) ?>', ['btnEditarNombreUsuario', 'btnEditarEmail', 'btnEditarPassword', 
                <?php foreach ($campos_persona as $campo_inner => $titulo_inner) { if ($campo != $campo_inner) echo "'btnEditar" . ucfirst($campo_inner) . "',"; } ?> 
            ]);
        <?php } ?>

        document.getElementById('datosForm').addEventListener('submit', function(event) {
            let isValid = true;
            const inputs = this.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], select');

            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }

                if (input.name === 'numero_de_telefono' && /\D/.test(input.value)) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }

                if (['nombre', 'apellido_paterno', 'apellido_materno', 'pais', 'estado', 'ciudad'].includes(input.name) && /\d/.est(input.value)) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }

                if (input.name === 'fecha_de_nacimiento') {
                    const fecha = new Date(input.value);
                    const fechaMinima = new Date('1950-01-01');
                    const fechaMaxima = new Date();
                    if (fecha < fechaMinima || fecha > fechaMaxima) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
                alert("Por favor, corrige los errores en el formulario.");
            }
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
