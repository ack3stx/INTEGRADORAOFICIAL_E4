<?php

use Stripe\Terminal\Location;

    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);

    switch ($tipo) {
        case 'sencilla':
            $update="UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`T_HABITACION` SET `PRECIO` = $costo WHERE (`ID_TIPO_HABITACION` = '3')";
            break;
        case 'doble':
            $update="UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`T_HABITACION` SET `PRECIO` = $costo WHERE (`ID_TIPO_HABITACION` = '1')";
            break;
        case 'king size':
            $update="UPDATE `INTEGRADORA_ROL_USUARIOSv2`.`T_HABITACION` SET `PRECIO` = $costo WHERE (`ID_TIPO_HABITACION` = '2')";
            break;
    }
    header('Location: ../Views/costos.php?status=correcto');

    $db->ejecuta($update);

?>