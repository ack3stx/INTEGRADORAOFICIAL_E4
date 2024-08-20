<?php
session_start();

include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

$consultan="SELECT 
    RESERVACION.ID_RESERVACION, 
    RESERVACION.ESTADO_RESERVACION, 
    DETALLE_PAGO.MONTO_TOTAL, 
    DETALLE_PAGO.METODO_PAGO
FROM 
    RESERVACION
JOIN 
    DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION
ORDER BY 
    RESERVACION.ID_RESERVACION DESC
LIMIT 1;
";
$con1=$db->seleccionar($consultan);

$consulten= "
SELECT
DETALLE_RESERVACION.FECHA_INICIO, 
DETALLE_RESERVACION.FECHA_FIN, 
DETALLE_PAGO.MONTO_TOTAL,
DETALLE_PAGO.METODO_PAGO,
T_HABITACION.NOMBRE AS TIPO_HABITACION,
COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_HABITACIONES,
(T_HABITACION.PRECIO * COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION)) AS PRECIO_TOTAL_POR_TIPO
FROM 
DETALLE_PAGO
JOIN 
RESERVACION ON DETALLE_PAGO.RESERVACION = RESERVACION.ID_RESERVACION
JOIN 
HUESPED ON RESERVACION.HUESPED = HUESPED.ID_HUESPED
JOIN 
PERSONA ON HUESPED.PERSONA_HUESPED = PERSONA.ID_PERSONA
JOIN 
USUARIOS ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
JOIN 
DETALLE_RESERVACION ON DETALLE_RESERVACION.RESERVACION = RESERVACION.ID_RESERVACION
JOIN 
HABITACION ON DETALLE_RESERVACION.HABITACION = HABITACION.ID_HABITACION
JOIN 
T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
WHERE 
RESERVACION.ID_RESERVACION = {$con1->ID_RESERVACION}
GROUP BY 
DETALLE_RESERVACION.FECHA_INICIO, 
DETALLE_RESERVACION.FECHA_FIN, 
DETALLE_PAGO.MONTO_TOTAL,
DETALLE_PAGO.METODO_PAGO,
T_HABITACION.NOMBRE, 
T_HABITACION.PRECIO;
";
$datos_facturacion=$db->seleccionar($consulten);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
</head>
<body>
  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Roboto', sans-serif;
    }
    .container {
      max-width: 600px;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-top: 50px;
      position: relative;
    }
    h2, h4 {
      color: #dc3545;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
    .form-control, .form-select {
      border-radius: 0.25rem;
      border-color: #dc3545;
    }
    .form-check-input:checked {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .form-check-input:focus {
      border-color: #dc3545;
    }
    #billingForm {
      border-top: 1px solid #e0e0e0;
      padding-top: 15px;
      margin-top: 15px;
    }
    footer {
      margin-top: 50px;
      text-align: center;
    }
    .footer-link {
      color: #dc3545;
      text-decoration: none;
    }
    .footer-link:hover {
      text-decoration: underline;
    }
    .back-button {
      position: absolute;
      top: 10px;
      right: 10px;
    }
  </style>
  
    <a href="Panel_Recepcionista.php" class="btn btn-danger back-button">Regresar</a>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">RESUMEN DE TU RESERVA</h2>
<?php
    echo "<h3>FOLIO $con1->ID_RESERVACION</h3><br>
    <label>Estado: $con1->ESTADO_RESERVACION</label>
    <label>Metodo Pago: $con1->METODO_PAGO</label>";

    foreach ($datos_facturacion as $facturacion) {
        echo "<label>FECHA DEL CHECK IN: {$facturacion->FECHA_INICIO}</label><br>
        <label>FECHA DEL CHECK OUT: {$facturacion->FECHA_FIN}</label><br>
        <label>Tipo de Habitación: {$facturacion->TIPO_HABITACION}</label><br>
        <label>Cantidad de Habitaciones: {$facturacion->CANTIDAD_HABITACIONES}</label><br>
        <label>Precio Total por Tipo: {$facturacion->PRECIO_TOTAL_POR_TIPO}</label><br><br>";

        $precio_total_reservacion += $facturacion->PRECIO_TOTAL_POR_TIPO;
    }

    echo "<label>Monto Total De La Reservacion: {$precio_total_reservacion}</label><br>
        <label>Método De Pago: {$datos_facturacion[0]->METODO_PAGO}</label><br>";
?>
    <footer class="mt-4">
      <p>&copy; 2024 Compañía. Hotel Laguna Inn. Todos los derechos reservados.</p>
    </footer>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
