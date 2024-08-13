<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();
extract($_POST);

if (isset($ID_RESERVACION)) {
    $cancelacion = "UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`RESERVACION` SET `ESTADO_RESERVACION` = 'cancelada' WHERE `ID_RESERVACION` = $ID_RESERVACION";
    $db->ejecuta($cancelacion);
}

$db->desconectarBD();

header("Location:../Views/notificaciones_recepcionista.php");
?>