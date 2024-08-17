<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
<?php
session_start();
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

extract($_POST);

$errores = [];
$consulta_usuario = "SELECT COUNT(*) AS count FROM USUARIOS WHERE NOMBRE_USUARIO = '$usuario'";
$resultado = $db->seleccionar($consulta_usuario);

if ($resultado[0]->count > 0) {
    $errores[] = "El nombre de usuario '$usuario' ya está en uso. Por favor, elige otro.";
    $_SESSION['error_message'] = implode("<br>", $errores);
    header("refresh:0.1; url=../Views/busqueda_empleados.php");
    exit();
}

if (empty($errores)) {
    $hash = password_hash($contra, PASSWORD_DEFAULT);

    $cadena = "CALL RegistrarUsuarioRecepcionista('$usuario','$hash','$correo');";
    $db->ejecuta($cadena);

    $cadena = "CALL Registrarrecepcionistapersona('$nombre', '$ap_paterno', '$ap_materno', '$f_nac', '$direccion', '$ciudad', '$estado', '$cd_postal', '$pais', '$genero', '$telefono','$curp', '$f_cont', '$nss', '$afore', '$num2');";
    $db->ejecuta($cadena);

    echo "<div class='contenedor mx-auto opacity-75'>
            <div class='confirm'>
                <svg class='confirm__progress'>
                    <circle class='confirm__value' cx='50%' cy='50%' r='54' />
                </svg>
                <div class='confirm__inner'></div>
            </div>
            <div class='contenedorxd' style='box-shadow: black;'>
                <h1>¡REGISTRO EXITOSO!</h1>
            </div>
        </div>";
    header("Location:../Views/Panel_Admin.php");
} 

$db->desconectarBD();
?>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>