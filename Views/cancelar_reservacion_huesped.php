<?php
session_start();
include '../Clases/BasedeDatos.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_reservacion = $_POST['id_reservacion'];
  
  $db = new Database();
  $db->conectarDB();

  $consulta = "CALL CANCELAR_RESERVACION_72HRS($id_reservacion)";
  $db->ejecuta($consulta);

  $consultaUpdate = "UPDATE DETALLE_PAGO SET MONTO_TOTAL = 0 WHERE RESERVACION = $id_reservacion";
  $db->ejecuta($consultaUpdate);

  header("Location: historialreservaciones.php");
  exit();
}

?>