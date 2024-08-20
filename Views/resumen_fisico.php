<?php
session_start();

include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

// Consulta para obtener el último ID de reserva
$conid = "SELECT MAX(RESERVACION.ID_RESERVACION) AS ID FROM RESERVACION;";
$id_reserva = $db->seleccionar($conid);

// Verificar si la consulta devolvió resultados
if ($id_reserva && count($id_reserva) > 0) {
    $id_res = $id_reserva[0]['ID'];  // Ajuste para acceder correctamente al ID

    // Consulta para obtener los detalles de la reserva usando el último ID
    $consultan = "SELECT 
                    RESERVACION.ID_RESERVACION AS FOLIO,
                    RESERVACION.ESTADO_RESERVACION, 
                    DETALLE_PAGO.MONTO_TOTAL, 
                    DETALLE_PAGO.METODO_PAGO
                  FROM 
                    RESERVACION
                  JOIN 
                    DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION
                  WHERE RESERVACION.ID_RESERVACION = $id_res;";
    
    $con1 = $db->seleccionar($consultan);
    
    // Consulta para obtener los detalles adicionales de la reserva
    $consulten = "
    SELECT
        DETALLE_RESERVACION.FECHA_INICIO, 
        DETALLE_RESERVACION.FECHA_FIN, 
        HABITACION.NUM_HABITACION,
        T_HABITACION.NOMBRE AS TIPO_HABITACION,
        COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_HABITACIONES
    FROM 
        DETALLE_RESERVACION
    JOIN 
        HABITACION ON DETALLE_RESERVACION.HABITACION = HABITACION.ID_HABITACION
    JOIN 
        T_HABITACION ON HABITACION.TIPO_HABITACION = T_HABITACION.ID_TIPO_HABITACION
    WHERE 
        DETALLE_RESERVACION.RESERVACION = $id_res
    GROUP BY 
        DETALLE_RESERVACION.FECHA_INICIO, 
        DETALLE_RESERVACION.FECHA_FIN, 
        HABITACION.NUM_HABITACION,
        T_HABITACION.NOMBRE;
    ";
    
    $datos_facturacion = $db->seleccionar($consulten);
} else {
    echo "No se encontró una reserva reciente.";
    exit;
}
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
if ($con1 && count($con1) > 0) {
    echo "<h3>FOLIO: {$con1[0]['FOLIO']}</h3><br>
          <label>Estado: {$con1[0]['ESTADO_RESERVACION']}</label><br>
          <label>Método Pago: {$con1[0]['METODO_PAGO']}</label><br>
          <label>Monto Total: {$con1[0]['MONTO_TOTAL']}</label><br>";

    foreach ($datos_facturacion as $facturacion) {
        echo "<label>FECHA DEL CHECK IN: {$facturacion['FECHA_INICIO']}</label><br>
              <label>FECHA DEL CHECK OUT: {$facturacion['FECHA_FIN']}</label><br>
              <label>Cantidad de Habitaciones: {$facturacion['CANTIDAD_HABITACIONES']}</label><br>
              <label>Tipo de Habitación: {$facturacion['TIPO_HABITACION']}</label><br>";
    }
} else {
    echo "<p>No se encontraron detalles para la reserva seleccionada.</p>";
}
?>
    <footer class="mt-4">
      <p>&copy; 2024 Compañía. Hotel Laguna Inn. Todos los derechos reservados.</p>
    </footer>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
