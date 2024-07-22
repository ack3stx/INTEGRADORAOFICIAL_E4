<?php
require_once '../Clases/BasedeDatos.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_submitted'])) {
    $tipoHabitacion = $_POST['roomStatus'];
    
    echo "Tipo de habitación: " . $tipoHabitacion;
    
    $db = new Database();
    $db->conectarDB();
    $db->agregarHabitaciones($tipoHabitacion);
    $db->desconectarBD();
    
    header("Location: ../Views/busqueda_habitaciones.php?success=1");
    exit();
} else {
    echo "Formulario no enviado correctamente";
}
?>

