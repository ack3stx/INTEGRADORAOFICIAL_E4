<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();
extract($_POST);

if (isset($id_reservacion)) {
    $cancelacion = "UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`RESERVACION` SET `ESTADO_RESERVACION` = 'cancelada' WHERE `ID_RESERVACION` = $id_reservacion";
    $db->ejecuta($cancelacion);
}

$db->desconectarBD();

header("Location:../Views/notificaciones_recepcionista.php");
?>