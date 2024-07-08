<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            echo "<div class='alert alert-danger'>Usario no existe</div>";
            header("refresh:1;Login.php");
        }
    } 
    catch (Exception $e)
    {
        die ("ERROR: " . $e->getMessage());
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>