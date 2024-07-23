<?php
        include '../Clases/BasedeDatos.php';
        $db=new Database();
        $db->conectarDB();

        extract($_POST);


        $cadena = "CALL Consultar_Informacion_Facturacion('$N_reservacion');";

        $tabla = $db->seleccionar($cadena);

        $db->desconectarBD();

    ?>