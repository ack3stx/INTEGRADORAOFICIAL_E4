<?php
include '../Clases/BasedeDatos.php';
session_start();



if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    
    if (isset($_POST['persona']) && isset($_POST['habitaciones']) && isset($_POST['cantidad']) && isset($_POST['fechainicio']) && isset($_POST['fechafin']) && isset($_POST['facturacion']) ) {

       
        $persona = json_decode($_POST['persona'], true);
        $habitaciones = json_decode($_POST['habitaciones'], true);
        $facturacion = json_decode($_POST['facturacion'], true);
        $cantidad = $_POST['cantidad'];
    
        $fechainicio = $_POST['fechainicio'] . " 15:00:00"; 
        $fechafin = $_POST['fechafin'] . " 12:00:00";
    

        date_default_timezone_set('America/Monterrey');
        $fecha = date('Y-m-d H:i:s');
       
    

        $recepcionista = null;
        $estado_reservacion = 'proceso';

        $data = new Database();
        $data->conectarDB();

        if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];

            

            $consulta = "SELECT USUARIOS.ID_USUARIO as ID FROM USUARIOS WHERE USUARIOS.NOMBRE_USUARIO = :usuario";
            $stmt = $data->prepare($consulta);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado && isset($resultado['ID'])) {
                $id_usuario = $resultado['ID'];

                
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
                  
                     $ninos = $habitacion['ninos'];
                     $adultos = $habitacion['adultos'];
                     $tipo_habitacion = $habitacion['tipo'];
    
                     $detalle = $data->detalle_reservacion($fechainicio, $fechafin,'', $ninos, $adultos, $tipo_habitacion);
                    }


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