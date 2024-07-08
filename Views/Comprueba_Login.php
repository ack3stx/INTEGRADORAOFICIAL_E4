<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    try
    {
        $conexion=new PDO("mysql:host=localhost; dbname=INTEGRADORA_ROL_USUARIOSv2","root","");
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select correo,contraseña from usuarios where correo= :correo and contraseña= :contra";

        $resultado=$conexion->prepare($sql);
        $correo=htmlentities(addslashes($_POST["correo"]));
        $contra=htmlentities(addslashes($_POST["contra"]));

        $resultado->bindValue(":correo",$correo);
        $resultado->bindValue(":contra",$contra);

        $resultado->execute();

        $numero_registro=$resultado->rowCount();
        if ($numero_registro!=0)
        {
            header("location:Panel_Recepcionista.php");
        }
        else
        {
            header("location:Login.php");
        }
    } 
    catch (Exception $e)
    {
        die ("ERROR: " . $e->getMessage());
    }
    ?>
</body>
</html>