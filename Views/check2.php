<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <link rel="stylesheet" href="../Estilos/check2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <div class="contenedor">
      <div class="confirm">
        <svg class="confirm__progress">
          <circle class="confirm__value" cx="50%" cy="50%" r="54" />
        </svg>
        <div class="confirm__inner"></div>
      </div>
      <div class="contenedorxd" style="box-shadow: black;">
        <h5>Hotel Laguna Inn</h5>
        <h1>¡Pago exitoso!</h1>
        <h2>Gracias por tu preferencia</h2>
        <h3>Disfruta tu estancia en nuestro hotel</h3>
        <?php
 header("refresh:2;../views/Panel_Recepcionista.php");
 ?>
    </div>
  </div>
  <script src="../Js/check2.js"></script>
</body>
</html>
