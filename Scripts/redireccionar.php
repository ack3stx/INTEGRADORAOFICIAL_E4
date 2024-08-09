<?php
    include '../Clases/BasedeDatos.php';
    $db=new Database();
    $db->conectarDB();

    extract($_POST);
    
    header('Location: ../views/check2.php');

?>