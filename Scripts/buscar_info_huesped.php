<?php
        include '../Clases/BasedeDatos.php';
        $db=new Database();
        $db->conectarDB();

        extract($_POST);


        $cadena = "CALL info_huesped('$n_reservacion');";

        $tabla = $db->seleccionar($cadena);

        $db->desconectarBD();

    ?>