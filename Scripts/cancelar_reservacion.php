<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();
extract($_POST);

if (isset($ID_RESERVACION)) {
    $registrar_inconveniente = "UPDATE `integradora_rol_usuariosv2`.`reservacion` SET `ESTADO_RESERVACION` = 'incoveniente' WHERE `ID_RESERVACION` = '$ID_RESERVACION';";
    $db->ejecuta($registrar_inconveniente);
}

$db->desconectarBD();

header("Location:../Views/notificaciones.php");
?>
