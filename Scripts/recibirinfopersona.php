<?php
include '../Clases/BasedeDatos.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['persona']) && isset($_POST['habitaciones']) && isset($_POST['cantidad']) && isset($_POST['fechainicio']) && isset($_POST['fechafin']) ) {
        $persona = json_decode($_POST['persona'], true);
        $habitaciones = json_decode($_POST['habitaciones'], true);
        $cantidad = $_POST['cantidad'];
        $fechainicio = $_POST['fechainicio'];
        $fechafin = $_POST['fechafin'];
        

        $fecha_actual = date('Y-m-d H:i:s');
        $recepcionista = null;
        $estado_reservacion = 'proceso';

        $data = new Database();
        $data->conectarDB();

        if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];

            $consulta = "SELECT usuarios.id_usuario as id FROM usuarios WHERE usuarios.nombre_usuario = :usuario";
            $stmt = $data->prepare($consulta);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && isset($resultado['id'])) {
                $id_usuario = $resultado['id'];

              
                $registro = $data->registro(
                    $persona['nombre'], 
                    $persona['ap_paterno'], 
                    $persona['ap_materno'], 
                    $persona['f_nac'], 
                    $persona['direccion'], 
                    $persona['ciudad'], 
                    $persona['estado'], 
                    $persona['cd_postal'], 
                    $persona['pais'], 
                    $persona['genero'], 
                    $persona['telefono'], 
                    $id_usuario
                );
 
                
                
                    $reservacion = $data->reservacion($recepcionista, $fecha_actual, $estado_reservacion);

                    foreach ($habitaciones as $habitacion) {
                   $titular = null; 
                   $ninos = $habitacion['niños'];
                   $adultos = $habitacion['adultos'];
                   $tipo_habitacion = $habitacion['tipo'];
    
                     $detalle = $data->detalle_reservacion($fechainicio, $fechafin, $titular, $ninos, $adultos, $tipo_habitacion);

                    
                   }

                    

                
                
                $detalle_pago = $data->detalle_pago('tarjeta', $cantidad);

                
            } 
        } 
    } 
} 
?>
