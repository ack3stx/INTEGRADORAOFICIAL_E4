<?php
include '../Clases/BasedeDatos.php';
session_start();
$db = new Database();
$db->conectarDB();

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    
    if (isset($nombre, $ap_paterno, $ap_materno, $f_nac, $direccion, $ciudad, $estado, $cd_postal, $pais, $genero, $telefono)) {
        $db->registro($nombre, $ap_paterno, $ap_materno, $f_nac, $direccion, $ciudad, $estado, $cd_postal, $pais, $genero, $telefono, $_SESSION['id_usuario']);

        $huesped = "SELECT HUESPED.ID_HUESPED AS HUESPED
                        FROM PERSONA 
                        INNER JOIN USUARIOS ON PERSONA.USUARIO = USUARIOS.ID_USUARIO
                        INNER JOIN HUESPED ON PERSONA.ID_PERSONA = HUESPED.PERSONA_HUESPED
                        WHERE USUARIOS.ID_USUARIO= :id;";
        $stmt = $db->prepare($huesped);
        $stmt->bindParam(':id', $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->execute();
        $huespedes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($huesped_result)) {
            $_SESSION['huesped'] = $huespedes['HUESPED']; 
        }

        header("Location:../index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
 
         <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 50%; 
            background-color: #fff;
            padding: 2%; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 2% auto 0;
        }
        h2 {
            color: #333;
            margin-bottom: 1%; 
        }
        label {
            color: #666;
            font-size: 14px;
        }
        .form-control {
            border-radius: 4px;
            border: 1px solid #ccc;
            padding: 0.8%; 
        }
        .btn {
            width: 100%;
            padding: 1%; 
            border-radius: 4px;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: rgba(214, 13, 13, 0.8);
        }
    </style>
    <title>Información Personal</title>
</head>
<body>
    <br><br>
    <h2 class="text-center">POR FAVOR COMPLETA TU INFORMACION ANTES DE REALIZAR UNA RESERVA</h2>
    <br><br>
        <div class="container">
            <form id="form-persona" action="" method="post" style="margin: 0 auto; width: 80%;">
                <div id="persona">
                <label for="staffName">Nombre:</label>
                <input class="form-control me-2" type="text" id="nombre" name="nombre" required ><br>
                <label for="staffName">Apellido Paterno:</label>
                <input class="form-control me-2" type="text" id="ap_paterno" name="ap_paterno" required ><br>
                <label for="staffName">Apellido Materno:</label>
                <input class="form-control me-2" type="text" id="ap_materno" name="ap_materno" required ><br>
                <label for="staffName">Fecha Nacimiento:</label>
                <input class="form-control me-2" type="date" id="f_nac" name="f_nac" required><br>
                <label for="staffName">Direccion:</label>
                <input class="form-control me-2" type="text" id="direccion" name="direccion" required><br>
                <label for="staffName">Ciudad:</label>
                <input class="form-control me-2" type="text" id="ciudad" name="ciudad" required ><br>
                <label for="staffName">Estado:</label>
                <input class="form-control me-2" type="text" id="estado" name="estado" required><br>
                <label for="staffName">Codigo Postal:</label>
                <input class="form-control me-2" type="text" id="cd_postal" name="cd_postal" required ><br>
                <label for="staffName">Pais:</label>
                <input class="form-control me-2" type="text" id="pais" name="pais" required ><br>
                <label for="staffName">Genero:</label>
                <select class="form-control me-2" id="genero" name="genero" required>
                  <option class="form-control me-2" value="H">Hombre</option>
                  <option class="form-control me-2" value="M">Mujer</option>
                </select><br>
                <label for="staffName">Telefono:</label>
                <input class="form-control me-2" type="text" id="telefono" name="telefono" required ><br>
                <button type="submit" class="btn" style="background-color: rgba(214, 13, 13, 0.5);">Continuar</button>
            </form>
        </div>    
        
</body>
</html>