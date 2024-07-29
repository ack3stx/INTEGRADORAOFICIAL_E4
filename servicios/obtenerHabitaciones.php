<?php 
    include '../Clases/BasedeDatos.php';
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
    
            $data = new Database();
            $data->conectarDB();
            $disponibilidad = $data->disponibilidad($startDate, $endDate);
            $disponibilidadkingsize = $data->disponibilidad_kingsize($startDate, $endDate);
            $disponibilidadsencilla = $data->disponibilidad_sencilla($startDate, $endDate);

            $cantidad = [
                "doble" => $disponibilidad,
                "king-size " => $disponibilidadkingsize,
                "sencilla" => $disponibilidadsencilla
            ];

            $data->desconectarBD();

            echo json_encode($cantidad);
        } 
    } 
    else {
        echo "Parámetros no recibidos correctamente.";
    }
?>