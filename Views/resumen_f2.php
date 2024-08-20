<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container mt-5 mx-auto">
    <h2 class="mb-4 text-center">RESUMEN DE TU RESERVA</h2>
<?php
session_start();

include '../Clases/BasedeDatos.php';
$db = new Database();
$db->conectarDB();

$conid="SELECT 
            MAX(RESERVACION.ID_RESERVACION) AS ID
        FROM 
            RESERVACION;";

$id_reserva=$db->seleccionar($conid);

$id_res=$id_reserva->ID;

$consultan="SELECT 
    RESERVACION.ID_RESERVACION AS FOLIO,
    RESERVACION.ESTADO_RESERVACION, 
    DETALLE_PAGO.MONTO_TOTAL, 
    DETALLE_PAGO.METODO_PAGO
FROM 
    RESERVACION
JOIN 
    DETALLE_PAGO ON RESERVACION.ID_RESERVACION = DETALLE_PAGO.RESERVACION
WHERE RESERVACION.ID_RESERVACION = (
        SELECT 
            MAX(RESERVACION.ID_RESERVACION)
        FROM 
            RESERVACION
    );
";
$con1=$db->seleccionar($consultan);

$consulten= "
SELECT
DETALLE_RESERVACION.FECHA_INICIO, 
DETALLE_RESERVACION.FECHA_FIN, 
DETALLE_PAGO.MONTO_TOTAL,
DETALLE_PAGO.METODO_PAGO,
T_HABITACION.NOMBRE AS TIPO_HABITACION,
COUNT(DETALLE_RESERVACION.ID_DETALLE_RESERVACION) AS CANTIDAD_HABITACIONES
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
RESERVACION.ID_RESERVACION = (
        SELECT 
            MAX(RESERVACION.ID_RESERVACION)
        FROM 
            RESERVACION
    );
GROUP BY 
DETALLE_RESERVACION.FECHA_INICIO, 
DETALLE_RESERVACION.FECHA_FIN, 
DETALLE_PAGO.MONTO_TOTAL,
DETALLE_PAGO.METODO_PAGO,
T_HABITACION.NOMBRE, 
T_HABITACION.PRECIO;
";
$datos_facturacion=$db->seleccionar($consulten);

    echo "<h3>FOLIKSJHFJKAHFHO: $id_res </h3><br>
    <label>FOLIASJDHAJFHKAHFJHFKAHO: $id_reserva->ID </label>
    <label>FOLIO: $id_reserva[0] </label>
    <label>FOLIO: $id_reserva[0]->ID </label>
    <label>FOLIO: $con1->FOLIO </label>
    <label>FOLIO: $con1[0]->FOLIO </label>
    <label>FOLIO: $con1[0] </label>
    <label>Estado: $con1->ESTADO_RESERVACION</label>
    <label>Metodo Pago: $con1->METODO_PAGO</label>";
    echo $id_res;

    foreach ($datos_facturacion as $facturacion) {
        echo "<label>FECHA DEL CHECK IN: {$facturacion->FECHA_INICIO}</label><br>
        <label>FECHA DEL CHECK OUT: {$facturacion->FECHA_FIN}</label><br>
        <label>Tipo de Habitación: {$facturacion->TIPO_HABITACION}</label><br>
        <label>Cantidad de Habitaciones: {$facturacion->CANTIDAD_HABITACIONES}</label><br>";
    }

    echo "<label>Monto Total De La Reservacion: {$datos_facturacion[0]->MONTO_TOTAL} </label><br>
        <label>Método De Pago: {$datos_facturacion[0]->METODO_PAGO}</label><br>";
?>
  </div>
</body>
</html>