<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Facturacion</title>
</head>
<body>
<form style="width: 50%; height: 100%; justify-content: center; align-items: center; margin:auto;" id="facturacion" action="../Scripts/redireccionar2.php" method="post">
         <h4 class="mb-3 text-center">Datos de Facturación</h4><br><br>
        <div class="mb-3">
          <label for="nombreFactura" class="form-label">Nombre</label><br><br>
          <input type="text" class="form-control" id="nombreFactura" name="nombreFactura" placeholder="Nombre completo" required><br><br>
        </div>
        <div class="mb-3">
          <label for="apellidoPaternoFactura" class="form-label">Apellido Paterno</label><br><br>
          <input type="text" class="form-control" id="apellidoPaternoFactura" name="apellidoPaternoFactura" placeholder="Apellido Paterno" required><br><br>
        </div>
        <div class="mb-3">
          <label for="apellidoMaternoFactura" class="form-label">Apellido Materno</label><br><br>
          <input type="text" class="form-control" id="apellidoMaternoFactura" name="apellidoMaternoFactura" placeholder="Apellido Materno" required><br><br>
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label><br><br>
          <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Calle 123, Ciudad, País" required><br><br>
        </div>
        <div class="mb-3">
          <label for="rfc" class="form-label">RFC</label><br><br>
          <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" required><br><br>
        </div>


        <button class="w-100 btn btn-primary btn-lg" type="submit">Continuar</button>
                
            </form> 
    
</body>
</html>