<?php
    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);
    $consulta="SET @max_id = (SELECT MAX(ID_DETALLE_PAGO) FROM DETALLE_PAGO);

UPDATE DETALLE_PAGO
SET METODO_PAGO = '$metodo'
WHERE ID_DETALLE_PAGO = @max_id;";

    $db->ejecuta($consulta);

    if ($nombreFactura && $apellidoPaternoFactura && $apellidoMaternoFactura && $direccion && $rfc) {
        $db->facturacion($nombreFactura,$apellidoPaternoFactura,$apellidoMaternoFactura,$rfc,$direccion);
    }

    header('Location: ../Views/Panel_Recepcionista.php');

?>