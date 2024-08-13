<?php
    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);

    if ($nombreFactura && $apellidoPaternoFactura && $apellidoMaternoFactura && $direccion && $rfc) {
        $db->facturacion($nombreFactura,$apellidoPaternoFactura,$apellidoMaternoFactura,$rfc,$direccion);
    }

    header('Location: ../Views/check2.php');

?>