<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();
extract($_POST);

if (isset($ID_RESERVACION)) {
    $cancelacion = "UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`RESERVACION` SET `ESTADO_RESERVACION` = 'incoveniente' WHERE `ID_RESERVACION` = $ID_RESERVACION";
    $problema = "UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`RESERVACION` SET `INCONSISTENCIA` = ':problema' WHERE `ID_RESERVACION` = $ID_RESERVACION"; 

    try {
        $db->ejecuta($cancelacion);
        $db->ejecuta($problema);
    } catch (Exception $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
        exit;
    }
}

$db->desconectarBD();

header("Location:../Views/notificaciones.php");
?>
