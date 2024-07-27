<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();
extract($_POST);

if (isset($id_reservacion)) {
    $cancelacion = "UPDATE `integradora_rol_usuariosv2`.`reservacion` SET `estado_reservacion` = 'cancelada' WHERE `id_reservacion` = $id_reservacion";
    $db->ejecuta($cancelacion);
}

$db->desconectarBD();

header("Location:../Views/notificaciones.php");
?>
