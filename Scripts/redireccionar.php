<?php
    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);
    $consulta="UPDATE DETALLE_PAGO
SET METODO_PAGO = '$metodo'
WHERE ID_DETALLE_PAGO = (SELECT MAX(ID_DETALLE_PAGO) FROM DETALLE_PAGO);";

    $db->ejecuta($consulta);

    header('Location: ../views/check2.php');

?>