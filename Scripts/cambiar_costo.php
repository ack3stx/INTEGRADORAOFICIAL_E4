<?php

use Stripe\Terminal\Location;

    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);

    switch ($tipo) {
        case 'sencilla':
            $update="UPDATE integradora_rol_usuariosv2.t_habitacion SET precio = $costo WHERE (id_tipo_habitacion = '3')";
            break;
        case 'doble':
            $update="UPDATE `integradora_rol_usuariosv2`.`t_habitacion` SET `precio` = $costo WHERE (`id_tipo_habitacion` = '1')";
            break;
        case 'king size':
            $update="UPDATE `integradora_rol_usuariosv2`.`t_habitacion` SET `precio` = $costo WHERE (`id_tipo_habitacion` = '2')";
            break;
    }
    header('Location: ../Views/costos.php?status=correcto');

    $db->ejecuta($update);

?>