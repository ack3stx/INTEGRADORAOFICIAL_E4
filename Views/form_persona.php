<?php
session_start();
if(isset($_SESSION["rol"])){
    $rol=$_SESSION["rol"];
    switch ($rol) {
        case 'recepcionista':
            header("Location:Panel_Recepcionista.php");
        break;
        case 'administrador':
            header("Location:Panel_Admin.php");
        break;
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
            <form id="form-persona" action="../Scripts/info_persona.php" method="post" style="margin: 0 auto; width: 80%;">
                <div id="persona">
                <label for="staffName">Nombre:</label>
                <input class="form-control me-2" type="text" id="nombre" name="nombre" required  maxlength="30"  onkeypress="return sololetras(event);"    ><br>
                <label for="staffName">Apellido Paterno:</label>
                <input class="form-control me-2" type="text" id="ap_paterno" name="ap_paterno" required maxLength="30"  onkeypress="return sololetras(event);"  ><br>
                <label for="staffName">Apellido Materno:</label>
                <input class="form-control me-2" type="text" id="ap_materno" name="ap_materno" required  maxLength="30" onkeypress="return sololetras(event);" ><br>
                <label for="staffName">Fecha Nacimiento:</label>
                <input class="form-control me-2" type="date" id="f_nac" name="f_nac" required><br>
                <label for="staffName">Direccion:</label>
                <input class="form-control me-2" type="text" id="direccion" name="direccion" required maxLength=100; ><br>
                <label for="staffName">Ciudad:</label>
                <input class="form-control me-2" type="text" id="ciudad" name="ciudad"  required maxLength="50" onkeypress="return sololetras(event);"  ><br>
                <label for="staffName">Estado:</label>
                <input class="form-control me-2" type="text" id="estado" name="estado" required maxLength="50"  onkeypress="return sololetras(event);" ><br>
                <label for="staffName">Codigo Postal:</label>
                <input class="form-control me-2" type="text" id="cd_postal" name="cd_postal" required maxLength="5"  onkeypress="return solonumeros(event);" ><br>
                <label for="staffName">Pais:</label>
                <input class="form-control me-2" type="text" id="pais" name="pais" required maxLength="50"  onkeypress="return sololetras(event);" ><br>
                <label for="staffName">Genero:</label>
                <select class="form-control me-2" id="genero" name="genero" required>
                  <option class="form-control me-2" value="H">Hombre</option>
                  <option class="form-control me-2" value="M">Mujer</option>
                </select><br>
                <label for="staffName">Telefono:</label>
                <input class="form-control me-2" type="tel" id="telefono" name="telefono" maxLength="10" required  oninput="validartelefono(this)"  ><br>
                <button type="submit" class="btn" style="background-color: rgba(214, 13, 13, 0.5);">Continuar</button>
            </form>
        </div>    
    <script>
           function sololetras (e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = " abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        especiales = [8,13];
        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }
        if(letras.indexOf(tecla)== -1 && !tecla_especial){
            alert("Solo letras");
            return false;
        }
    }

    function solonumeros (e) {
        if(window.event){
            keynum = evt.keyCode;
        }
        else {
            keynum = evt.which;
        }

        if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 0){
            return true;
        }
        else{
            alert("Solo numeros");
            return false;
        }

    }
    

function validartelefono(input){
    input.value = input.value.replace(/\D/g, '');
    
};
    </script>    
</body>
</html>