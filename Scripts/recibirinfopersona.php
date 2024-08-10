RECIBIR INFO PERSONA DE CHAT 

<?php
include '../Clases/BasedeDatos.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificar que todos los campos requeridos estén presentes
    if (!isset($_POST['persona'], $_POST['habitaciones'], $_POST['cantidad'], $_POST['fechainicio'], $_POST['fechafin'], $_POST['facturacion'])) {
        echo json_encode(["estatus"=>false, "error" => "Faltan parámetros."]);
        exit;
    }

    // Decodificar JSON y manejar errores
    $persona = json_decode($_POST['persona'], true);
    $habitaciones = json_decode($_POST['habitaciones'], true);
    $facturacion = json_decode($_POST['facturacion'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["estatus" => false, "error" => "Error en el formato JSON."]);
        exit;
    }

    $cantidad = $_POST['cantidad'];
    $fechainicio = $_POST['fechainicio'] . " 15:00:00"; 
    $fechafin = $_POST['fechafin'] . " 12:00:00";

    date_default_timezone_set('America/Monterrey');
    $fecha = date('Y-m-d H:i:s');
    
    $recepcionista = null;
    $estado_reservacion = 'proceso';

    // Conectar a la base de datos
    $data = new Database();
    $data->conectarDB();

    if (!$data->PDOLocal) {
        echo json_encode(["estatus" => false, "error" => "No se pudo conectar a la base de datos."]);
        exit;
    }

    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
        
        // Obtener ID de usuario
        $consulta = "SELECT id_usuario as id FROM usuarios WHERE nombre_usuario = :usuario";
        $stmt = $data->prepare($consulta);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado && isset($resultado['id'])) {
            $id_usuario = $resultado['id'];

            // Verificar si existe una reservación pasada
            $reservacionPasada = "SELECT huesped.id_huesped AS huesped
                                  FROM PERSONA 
                                  INNER JOIN USUARIOS ON PERSONA.usuario = USUARIOS.id_usuario
                                  INNER JOIN huesped ON PERSONA.id_persona = huesped.persona_huesped
                                  WHERE usuarios.nombre_usuario = :usuario";

            $stmt = $data->prepare($reservacionPasada);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
            $stmt->execute();
            $resultadoPasado = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($resultadoPasado && isset($resultadoPasado[0]['huesped'])) {
                $id_huesped = $resultadoPasado[0]['huesped'];
                $data->reservacionpasada($id_huesped, $recepcionista, $fecha, $estado_reservacion);
            } else {
                // Registrar nueva persona
                $data->registro(
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
                $data->reservacion($recepcionista, $fecha, $estado_reservacion);
            }

            // Registrar detalles de reservación
            foreach ($habitaciones as $habitacion) {
                $titular = null; 
                $ninos = $habitacion['niños'];
                $adultos = $habitacion['adultos'];
                $tipo_habitacion = $habitacion['tipo'];
    
                $data->detalle_reservacion($fechainicio, $fechafin, $titular, $ninos, $adultos, $tipo_habitacion);
            }

            // Registrar pago
            $data->detalle_pago('tarjeta', $cantidad);

            // Registrar facturación si existe
            if($facturacion !== null){
                $data->facturacion($facturacion['nombre'], $facturacion['ap_paterno'], $facturacion['ap_materno'], $facturacion['rfc'], $facturacion['direccion']);
            } else {
                echo "No se ha facturado";
            }

            // Respuesta exitosa
            echo json_encode(["estatus" => true, "message" => "Reservación realizada con éxito."]);
            exit;

        } else {
            echo json_encode(["estatus"=>false, "error" => "Usuario no encontrado."]);
            exit;
        }
    } else {
        echo json_encode(["estatus"=>false, "error" => "No hay usuario en sesión."]);
        exit;
    }
} else {
    echo json_encode(["estatus"=>false, "error" => "Método no permitido."]);
    exit;
}
?>