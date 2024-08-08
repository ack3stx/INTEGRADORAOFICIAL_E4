<?php
include '../Clases/BasedeDatos.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['persona']) && isset($_POST['habitaciones']) && isset($_POST['cantidad']) && isset($_POST['fechainicio']) && isset($_POST['fechafin']) && isset($_POST['facturacion']) ) {
        $persona = json_decode($_POST['persona'], true);
        $habitaciones = json_decode($_POST['habitaciones'], true);
        $facturacion = json_decode($_POST['facturacion'], true);
        $cantidad = $_POST['cantidad'];
        $fechainicio = $_POST['fechainicio'];
        $fechafin = $_POST['fechafin'];
        

        $fecha_actual = date('Y-m-d H:i:s');
        $estado_reservacion = 'proceso';

        $data = new Database();
        $data->conectarDB();

        $recep = $_SESSION["usuario"];
        $consulta = "select recepcionista.ID_RECEPCIONISTA as id from usuarios
inner join persona on persona.USUARIO=usuarios.ID_USUARIO
inner join recepcionista on recepcionista.PERSONA_RECEPCIONISTA=persona.ID_PERSONA
where usuarios.NOMBRE_USUARIO= :recep";
            $stmt = $data->prepare($consulta);
            $stmt->bindParam(':recep', $recep, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            $recepcionista=$resultado['id'];

        if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];

            
                $id_usuario = 78;

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
                     $detalle_pago = $data->detalle_pago('tarjeta', $cantidad);
                     if($facturacion === null){
                        echo "No se ha facturado";
                       }
                       else{
                         $data->facturacion($facturacion['nombre'], $facturacion['ap_paterno'], $facturacion['ap_materno'], $facturacion['rfc'], $facturacion['direccion']);
                       }

                    
                   }

                

                
            } 
        } 
    } 
?>
