<?php
session_start();
if ($_SESSION["rol"] == "usuario") {

    include '../Clases/BasedeDatos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener datos del formulario
        $correo_act = $_POST['correo'] ?? '';
        $nombre_user = $_POST['nombre_usuario'] ?? '';
        $contraseña_nueva = $_POST['password'] ?? '';

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

        // Validaciones de servidor
        $errores = [];
        if (empty($nombre) || empty($apellido_paterno) || empty($apellido_materno) || empty($fecha_de_nacimiento) || empty($direccion) || empty($ciudad) || empty($estado) || empty($codigo_postal) || empty($pais) || empty($genero) || empty($numero_de_telefono)) {
            $errores[] = "Todos los campos son obligatorios.";
        }

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

        if (empty($errores)) {
            $db = new Database();
            $db->conectarDB();

            $obtener_id = "SELECT id_usuario FROM usuarios WHERE nombre_usuario = '" . $_SESSION['usuario'] . "'";
            $id_result = $db->seleccionar($obtener_id);

            if (!empty($id_result)) {
                $id = $id_result[0]->id_usuario;

                if (!empty($nombre_user)) {
                    $consulta = "UPDATE usuarios SET nombre_usuario = '$nombre_user' WHERE id_usuario = $id";
                    $db->ejecuta($consulta);
                    $_SESSION['mensaje'] = "Nombre de usuario actualizado correctamente.";
                }

                if (!empty($correo_act)) {
                    $consulta = "UPDATE usuarios SET correo = '$correo_act' WHERE id_usuario = $id";
                    $db->ejecuta($consulta);
                    $_SESSION['mensaje'] = "Correo electrónico actualizado correctamente.";
                }

                if (!empty($contraseña_nueva)) {
                    $hash_nueva_contraseña = password_hash($contraseña_nueva, PASSWORD_DEFAULT);
                    $consulta = "UPDATE usuarios SET password = '$hash_nueva_contraseña' WHERE id_usuario = $id";
                    $db->ejecuta($consulta);
                    $_SESSION['mensaje'] = "Contraseña actualizada correctamente.";
                }

                // Actualizar datos de la tabla PERSONA
                $consulta_persona = "SELECT id_persona FROM persona WHERE usuario = $id";
                $persona_result = $db->seleccionar($consulta_persona);

                if (!empty($persona_result)) {
                    $id_persona = $persona_result[0]->id_persona;
                    $consulta_update_persona = "UPDATE persona SET 
                        nombre = '$nombre', 
                        apellido_paterno = '$apellido_paterno', 
                        apellido_materno = '$apellido_materno', 
                        fecha_de_nacimiento = '$fecha_de_nacimiento', 
                        direccion = '$direccion', 
                        ciudad = '$ciudad', 
                        estado = '$estado', 
                        codigo_postal = '$codigo_postal', 
                        pais = '$pais', 
                        genero = '$genero', 
                        numero_de_telefono = '$numero_de_telefono' 
                        WHERE id_persona = $id_persona";
                    $db->ejecuta($consulta_update_persona);
                    $_SESSION['mensaje'] = "Datos personales actualizados correctamente.";
                } else {
                    $consulta_insert_persona = "INSERT INTO persona (nombre, apellido_paterno, apellido_materno, fecha_de_nacimiento, direccion, ciudad, estado, codigo_postal, pais, genero, numero_de_telefono, usuario) VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$fecha_de_nacimiento', '$direccion', '$ciudad', '$estado', '$codigo_postal', '$pais', '$genero', '$numero_de_telefono', $id)";
                    $db->ejecuta($consulta_insert_persona);
                    $_SESSION['mensaje'] = "Datos personales añadidos correctamente.";
                }

                $db->desconectarBD();
            }
        } else {
            $_SESSION['mensaje'] = implode("<br>", $errores);
        }
    } else {
        $db = new Database();
        $db->conectarDB();
        $user_id = $_SESSION['usuario'];
        
        $consulta = "SELECT u.nombre_usuario, u.correo, u.password, 
                            p.nombre, p.apellido_paterno, p.apellido_materno, p.fecha_de_nacimiento, 
                            p.direccion, p.ciudad, p.estado, p.codigo_postal, p.pais, p.genero, p.numero_de_telefono 
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
    <link rel="stylesheet" href="../Estilos/datosp.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Datos personales</title>
    <style>
        .hidden { display: none; }
        .btn-toggle { display: flex; justify-content: flex-end; margin-bottom: 20px; }
        .input-group { margin-bottom: 20px; }
        .section-title { font-weight: bold; }
        .container { width: 80%; margin: 50px auto; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f8f9fa; }
        .is-invalid { border-color: #dc3545; }
    </style>
</head>
<body>
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
        <p>Actualiza tus datos y descubre cómo se utilizan</p>
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
                        <button type="button" id="btnEditarNombreUsuario" class="btn btn-primary">Editar</button>
                    </div>
                    <div id="formNombreUsuario" class="hidden">
                        <input type="text" name="nombre_usuario" class="form-control mb-2" placeholder="Nombre de usuario" value="<?= htmlspecialchars($usuario[0]->nombre_usuario) ?>">
                        <button type="button" id="btnCancelarNombreUsuario" class="btn btn-secondary">Cancelar</button>
                        <button type="button" id="btnListoNombreUsuario" class="btn btn-success">Listo</button>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="section-title">Dirección de email</p>
                            <p id="email"><?= htmlspecialchars($usuario[0]->correo) ?></p>
                        </div>
                        <button type="button" id="btnEditarEmail" class="btn btn-primary">Editar</button>
                    </div>
                    <div id="formEmail" class="hidden">
                        <input type="email" name="correo" class="form-control mb-2" placeholder="Correo electrónico" value="<?= htmlspecialchars($usuario[0]->correo) ?>">
                        <button type="button" id="btnCancelarEmail" class="btn btn-secondary">Cancelar</button>
                        <button type="button" id="btnListoEmail" class="btn btn-success">Listo</button>
                    </div>
                </div>

                <hr class="mb-4">

                <div class="section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="section-title">Contraseña</p>
                            <p id="password">******</p>
                        </div>
                        <button type="button" id="btnEditarPassword" class="btn btn-primary">Editar</button>
                    </div>
                    <div id="formPassword" class="hidden">
                        <input type="password" name="password" class="form-control mb-2" placeholder="Nueva contraseña">
                        <button type="button" id="btnCancelarPassword" class="btn btn-secondary">Cancelar</button>
                        <button type="button" id="btnListoPassword" class="btn btn-success">Listo</button>
                    </div>
                </div>

                <hr class="mb-4">

                <!-- Sección para datos de la persona -->
                <div class="section">
                    <h2>Datos Personales</h2>
                    <?php 
                    $campos_persona = [
                        'nombre' => 'Nombre',
                        'apellido_paterno' => 'Apellido Paterno',
                        'apellido_materno' => 'Apellido Materno',
                        'fecha_de_nacimiento' => 'Fecha de Nacimiento',
                        'direccion' => 'Dirección',
                        'ciudad' => 'Ciudad',
                        'estado' => 'Estado',
                        'codigo_postal' => 'Código Postal',
                        'pais' => 'País',
                        'genero' => 'Género',
                        'numero_de_telefono' => 'Número de Teléfono'
                    ];

                    foreach ($campos_persona as $campo => $titulo) {
                        $valor = htmlspecialchars($usuario[0]->$campo ?? '');
                        $clase_peligro = empty($valor) ? 'is-invalid' : '';
                    ?>
                        <div class="section">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="section-title"><?= $titulo ?></p>
                                    <p id="<?= $campo ?>Texto"><?= $valor ?></p>
                                </div>
                                <button type="button" id="btnEditar<?= ucfirst($campo) ?>" class="btn btn-primary">Editar</button>
                            </div>
                            <div id="form<?= ucfirst($campo) ?>" class="hidden">
                                <input type="text" name="<?= $campo ?>" class="form-control mb-2 <?= $clase_peligro ?>" placeholder="<?= $titulo ?>" value="<?= $valor ?>">
                                <button type="button" id="btnCancelar<?= ucfirst($campo) ?>" class="btn btn-secondary">Cancelar</button>
                                <button type="button" id="btnListo<?= ucfirst($campo) ?>" class="btn btn-success">Listo</button>
                            </div>
                        </div>
                        <hr class="mb-4">
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" id="btnConfirmar" class="btn btn-success">Confirmar cambios</button>
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
                document.getElementById(formId).classList.add('hidden');
                document.getElementById(buttonId).classList.remove('hidden');
                disableButtons.forEach(btn => {
                    document.getElementById(btn).disabled = false;
                });
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

        // Validaciones en el frontend
        document.getElementById('datosForm').addEventListener('submit', function(event) {
            let isValid = true;
            const inputs = this.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');

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
