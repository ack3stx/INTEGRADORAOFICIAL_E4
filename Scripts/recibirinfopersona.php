<?php
include '../Clases/BasedeDatos.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['persona']) && isset($_POST['habitaciones']) && isset($_POST['cantidad']) && isset($_POST['fechainicio']) && isset($_POST['fechafin'])) {
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

       $usuario = $_SESSION["usuario"];

       $consulta = "SELECT usuarios.id_usuario as id FROM usuarios WHERE usuarios.nombre_usuario = '$usuario'";
        $stmt = $data->prepare($consulta);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
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

            $reservacion= $data->reservacion($recepcionista,$fecha_actual,$estado_reservacion);

            
        }

}
}