<?php
include '../Clases/BasedeDatos.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['persona']) && isset($_POST['habitaciones']) && isset($_POST['cantidad']) && isset($_POST['fechainicio']) && isset($_POST['fechafin']) && isset($_POST['metodo'])) {
        $persona = json_decode($_POST['persona'], true);
        $habitaciones = json_decode($_POST['habitaciones'], true);
        $cantidad = $_POST['cantidad'];
        $metodo = $_POST['metodo'];
        

        $fechainicio = $_POST['fechainicio'] . " 15:00:00"; 
        $fechafin = $_POST['fechafin'] . " 12:00:00";
    

        date_default_timezone_set('America/Monterrey');
        $fecha = date('Y-m-d H:i:s');
       
        $estado_reservacion = 'proceso';

        $data = new Database();
        $data->conectarDB();

        $recep = $_SESSION["usuario"];
        $consulta = "SELECT RECEPCIONISTA.ID_RECEPCIONISTA AS ID 
                      FROM USUARIOS
                      INNER JOIN PERSONA ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
                      INNER JOIN RECEPCIONISTA ON RECEPCIONISTA.PERSONA_RECEPCIONISTA = PERSONA.ID_PERSONA
                      WHERE USUARIOS.NOMBRE_USUARIO = :recep";

            $stmt = $data->prepare($consulta);
            $stmt->bindParam(':recep', $recep, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $recepcionista=$resultado['ID'];

        if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];

                $id_usuario = 75;

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
 
                
                
                    $reservacion = $data->reservacion($recepcionista, $fecha, $estado_reservacion);

                    foreach ($habitaciones as $habitacion) {
                   $titular = null; 
                   $ninos = $habitacion['niños'];
                   $adultos = $habitacion['adultos'];
                   $tipo_habitacion = $habitacion['tipo'];
    
                     $detalle = $data->detalle_reservacion($fechainicio, $fechafin, $titular, $ninos, $adultos, $tipo_habitacion);
                     

                    
                   }

                   $detalle_pago = $data->detalle_pago($metodo, $cantidad);

                

                
            } 
        } 
    } 
?>
