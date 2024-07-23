<?php
require_once '../Clases/BasedeDatos.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_submitted'])) {
    $tipoHabitacion = $_POST['roomStatus'];
    
    echo "Tipo de habitación: " . $tipoHabitacion;
    
    $db = new Database();
    $db->conectarDB();
    $db->agregarHabitaciones($tipoHabitacion);
    $db->desconectarBD();
    
    if (isset($_SESSION["rol"])) {
        switch ($_SESSION["rol"]) {
            case 'recepcionista':
                header("Location: ../Views/busqueda_habitaciones_recepcionista.php?success=1");
                break;
            case 'administrador':
                header("Location: ../Views/busqueda_habitaciones.php?success=1");
                break;
            default:
                break;
        }
    } else {
        header("Location: ../Views/Iniciar_sesion.php");
    }
    exit();
} else {
    echo "Formulario no enviado correctamente";
}
?>

