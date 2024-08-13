<?php
    include '../Clases/BasedeDatos.php';
    session_start();
    $db = new Database();
    $db->conectarDB();
    
    $id_usuario = $_SESSION['id_usuario'];
    extract($_POST);    

    $db->registro($nombre,$ap_paterno,$ap_materno,$f_nac,$direccion,$ciudad,$estado,$cd_postal,$pais,$genero,$telefono,$id_usuario);
    
        $huesped= "SELECT HUESPED.ID_HUESPED AS HUESPED
                            FROM PERSONA INNER JOIN USUARIOS ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
                            INNER JOIN HUESPED ON PERSONA.ID_PERSONA = HUESPED.PERSONA_HUESPED
                            WHERE USUARIOS.ID_USUARIO= :id";

        $stmt = $db->prepare($huesped);
        $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $huesped= $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['huesped'] = $huesped['HUESPED'];
        header("Location:../index.php");
    
        exit();
?>