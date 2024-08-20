<?php
include '../Clases/BasedeDatos.php';

$conexion = new Database();
$conexion->conectarDB();

$ID_HABITACION = $_POST['ID_HABITACION'];
$nuevo_estado = $_POST['nuevo_estado'];
$inconveniente = addslashes($_POST['inconveniente']);  
echo "Inconveniente recibido: " . $inconveniente . "<br>"; 

$consulta = "UPDATE HABITACION SET ESTADO_HABITACION = '$nuevo_estado' WHERE ID_HABITACION = $ID_HABITACION";

try {
    $conexion->ejecuta($consulta);

    if ($nuevo_estado == 'mantenimiento') {
        $updateReservaEstado = "UPDATE RESERVACION
                                JOIN DETALLE_RESERVACION ON RESERVACION.ID_RESERVACION = DETALLE_RESERVACION.RESERVACION
                                SET RESERVACION.ESTADO_RESERVACION = 'inconsistencia'
                                WHERE DETALLE_RESERVACION.HABITACION = $ID_HABITACION
                                  AND DETALLE_RESERVACION.FECHA_INICIO >= NOW()
                                  AND RESERVACION.ESTADO_RESERVACION = 'proceso'";
        
        $conexion->ejecuta($updateReservaEstado);

        $updateReservaMotivo = "UPDATE RESERVACION
                                JOIN DETALLE_RESERVACION ON RESERVACION.ID_RESERVACION = DETALLE_RESERVACION.RESERVACION
                                SET RESERVACION.INCONSISTENCIA = '$inconveniente'
                                WHERE DETALLE_RESERVACION.HABITACION = $ID_HABITACION
                                  AND DETALLE_RESERVACION.FECHA_INICIO >= NOW()
                                  AND RESERVACION.ESTADO_RESERVACION = 'inconsistencia'";
        
        echo $updateReservaMotivo . "<br>";
        
        $conexion->ejecuta($updateReservaMotivo);

    } elseif ($nuevo_estado == 'disponible') {
        $revertirReservaEstado = "UPDATE RESERVACION
                                  JOIN DETALLE_RESERVACION ON RESERVACION.ID_RESERVACION = DETALLE_RESERVACION.RESERVACION
                                  SET RESERVACION.ESTADO_RESERVACION = 'proceso', RESERVACION.INCONSISTENCIA = NULL
                                  WHERE DETALLE_RESERVACION.HABITACION = $ID_HABITACION
                                    AND DETALLE_RESERVACION.FECHA_INICIO >= NOW()
                                    AND RESERVACION.ESTADO_RESERVACION = 'inconsistencia'";
        
        $conexion->ejecuta($revertirReservaEstado);
    }

    header("Location: ../Views/busqueda_habitaciones.php?success=2");
    exit;
} catch (Exception $e) {
    echo "Error al actualizar el estado: " . $e->getMessage();
    exit;
}

$conexion->desconectarBD();
?>
