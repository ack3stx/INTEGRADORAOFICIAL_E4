<?php
include '../Clases/BasedeDatos.php';

$conexion = new Database();
$conexion->conectarDB();

$ID_HABITACION = $_POST['ID_HABITACION'];
$nuevo_estado = $_POST['nuevo_estado'];

$consulta = "UPDATE HABITACION SET ESTADO_HABITACION = '$nuevo_estado' WHERE ID_HABITACION = $ID_HABITACION";

try {
    $conexion->ejecuta($consulta);
    header("Location: ../Views/busqueda_habitaciones.php?success=1");
} catch (Exception $e) {
    echo "Error al actualizar el estado: " . $e->getMessage();
    exit;
}

$conexion->desconectarBD();
?>
