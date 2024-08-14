<?php
include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

$ID_RESERVACION = $_POST['ID_RESERVACION'];
$problema = $_POST['problema'];

if (isset($ID_RESERVACION)) {
    $cancelacion = "UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`RESERVACION` 
                    SET `ESTADO_RESERVACION` = 'incoveniente' 
                    WHERE `ID_RESERVACION` = $ID_RESERVACION";
    
        
    $problema_sql = "UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`RESERVACION` 
                     SET `INCONSISTENCIA` = '$problema_escapado' 
                     WHERE `ID_RESERVACION` = $ID_RESERVACION"; 

    try {
        $db->ejecuta($cancelacion);
        $db->ejecuta($problema_sql);
    } catch (Exception $e) {
        echo "Error al ejecutar la consulta: " . $e->getMessage();
        exit;
    }
}

$db->desconectarBD();

header("Location:../Views/notificaciones.php");
exit;
?>
