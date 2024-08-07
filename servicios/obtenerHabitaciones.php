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
            
            $gentedoble = "SELECT T_HABITACION.cantidad_max_adultos as adultos, T_HABITACION.cantidad_max_niños as niños
            from T_HABITACION
            where T_HABITACION.nombre='Doble';";
            $doblegente = $data->seleccionar($gentedoble);
            
            $gentekingsize = "SELECT T_HABITACION.cantidad_max_adultos as adultos, T_HABITACION.cantidad_max_niños as niños
            from T_HABITACION
            where T_HABITACION.nombre='King Size';";
            $kingsizegente = $data->seleccionar($gentekingsize);

            $gentesencilla = "SELECT T_HABITACION.cantidad_max_adultos as adultos, T_HABITACION.cantidad_max_niños as niños
            from T_HABITACION
            where T_HABITACION.nombre='Sencilla';";
           $sencillagente = $data->seleccionar($gentesencilla);

           $preciodoble = "SELECT t_habitacion.precio as precio from t_habitacion where t_habitacion.nombre = 'Doble';";
           $dobles = $data->seleccionar($preciodoble);

           $precioskingsize = "SELECT t_habitacion.precio as precio from t_habitacion where t_habitacion.nombre = 'King Size';";
           $kingsizes = $data->seleccionar($precioskingsize);

           $preciosencilla = "SELECT t_habitacion.precio as precio from t_habitacion where t_habitacion.nombre = 'Sencilla';";
           $sencillas = $data->seleccionar($preciosencilla);


            $cantidad = [
                "doble" => $disponibilidad,
                "king-size " => $disponibilidadkingsize,
                "sencilla" => $disponibilidadsencilla,
                "genteD" => $doblegente,
                "genteK" => $kingsizegente,
                "genteS" => $sencillagente,
                "precioD" => $dobles,
                "precioK" => $kingsizes,
                "precioS" => $sencillas
                

            ];

            $data->desconectarBD();

            echo json_encode($cantidad);
        } 
    } 
    else {
        echo "Parámetros no recibidos correctamente.";
    }
?>