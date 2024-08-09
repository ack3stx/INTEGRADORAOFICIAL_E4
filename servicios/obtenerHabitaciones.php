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
            
            $gentedoble = "SELECT T_HABITACION.CANTIDAD_MAX_ADULTOS as adultos, T_HABITACION.CANTIDAD_MAX_NIÑOS as ninos
            from T_HABITACION
            where T_HABITACION.NOMBRE='Doble';";
            $doblegente = $data->seleccionar($gentedoble);
            
            $gentekingsize = "SELECT T_HABITACION.CANTIDAD_MAX_ADULTOS as adultos, T_HABITACION.CANTIDAD_MAX_NIÑOS as ninos
            from T_HABITACION
            where T_HABITACION.NOMBRE='King Size';";
            $kingsizegente = $data->seleccionar($gentekingsize);

            $gentesencilla = "SELECT T_HABITACION.CANTIDAD_MAX_ADULTOS as adultos, T_HABITACION.CANTIDAD_MAX_NIÑOS as ninos
            from T_HABITACION
            where T_HABITACION.NOMBRE='Sencilla';";
           $sencillagente = $data->seleccionar($gentesencilla);

           $preciodoble = "SELECT T_HABITACION.PRECIO as precio from T_HABITACION where T_HABITACION.NOMBRE = 'Doble';";
           $dobles = $data->seleccionar($preciodoble);

           $precioskingsize = "SELECT T_HABITACION.PRECIO as precio from T_HABITACION where T_HABITACION.NOMBRE = 'King Size';";
           $kingsizes = $data->seleccionar($precioskingsize);

           $preciosencilla = "SELECT T_HABITACION.PRECIO as precio from T_HABITACION where T_HABITACION.NOMBRE = 'Sencilla';";
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