<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/check2.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <?php
            include '../Clases/BasedeDatos.php';
            $db=new Database();
            $db->conectarDB();

            extract($_POST);
            
            $hash = password_hash($contra,PASSWORD_DEFAULT);

            $cadena = "CALL RegistrarUsuarioHuesped('$usuario','$hash','$correo');";

            $db->ejecuta($cadena);
            
            echo "<div class='contenedor mx-auto opacity-75'>
      <div class='confirm'>
        <svg class='confirm__progress'>
          <circle class='confirm__value' cx='50%' cy='50%' r='54' />
        </svg>
        <div class='confirm__inner'></div>
      </div>
      <div class='contenedorxd' style='box-shadow: black;'>
        <h1>¡REGISTRO EXITOSO!</h1>
    </div>
  </div>";
  header("refresh:3;../Views/Login.php");
        ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>