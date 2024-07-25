<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información de Pago</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Estilos/estilos_panel_recepcionistaF.css">
</head>
<body>
  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Roboto', sans-serif;
    }
    .container {
      max-width: 600px;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-top: 50px;
    }
    h2, h4 {
      color: #dc3545;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
    .form-control, .form-select {
      border-radius: 0.25rem;
      border-color: #dc3545;
    }
    .form-check-input:checked {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .form-check-input:focus {
      border-color: #dc3545;
    }
    #billingForm {
      border-top: 1px solid #e0e0e0;
      padding-top: 15px;
      margin-top: 15px;
    }
    footer {
      margin-top: 50px;
      text-align: center;
    }
    .footer-link {
      color: #dc3545;
      text-decoration: none;
    }
    .footer-link:hover {
      text-decoration: underline;
    }
  </style>
  <script>
    function toggleBilling() {
      var checkbox = document.getElementById("facturar");
      var billingForm = document.getElementById("billingForm");
      billingForm.style.display = checkbox.checked ? "block" : "none";
    }
  </script>

  <div class="container mt-5">
    <h2 class="mb-4 text-center">INFORMACIÓN DE PAGO</h2>
    <form>
      <h4 class="mb-3">Método de Pago</h4>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="metodoPago" id="tarjetaCredito" value="tarjetaCredito" checked>
        <label class="form-check-label" for="tarjetaCredito">
          Tarjeta de Crédito o Tarjeta de Débito
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="metodoPago" id="efectivo" value="efectivo">
        <label class="form-check-label" for="efectivo">
          Efectivo
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="metodoPago" id="transferencia" value="transferencia">
        <label class="form-check-label" for="transferencia">
          Transferencia
        </label>
      </div>

      <!-- Resumen del costo total -->
      <div class="mb-3 mt-4">
        <h4>Resumen de la Reserva</h4>
        <p>Habitación: <?php echo isset($_GET['nombreHabitacion']) ? $_GET['nombreHabitacion'] : 'N/A'; ?></p>
        <p>Número de días: <?php echo isset($_GET['diasEstancia']) ? $_GET['diasEstancia'] : 'N/A'; ?></p>
        <p>Costo por día: <?php echo isset($_GET['precioHabitacion']) ? $_GET['precioHabitacion'] : 'N/A'; ?></p>
        <p><strong>Costo Total: <?php echo isset($_GET['costoTotal']) ? $_GET['costoTotal'] : 'N/A'; ?></strong></p>
      </div>

      <div class="form-check mb-3 mt-4">
        <input type="checkbox" class="form-check-input" id="facturar" onclick="toggleBilling()">
        <label class="form-check-label" for="facturar">Desea Facturar</label>
      </div>

      <div id="billingForm" style="display: none;">
        <h4 class="mb-3">Datos de Facturación</h4>
        <div class="mb-3">
          <label for="nombreFactura" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombreFactura" placeholder="Nombre completo">
        </div>
        <div class="mb-3">
          <label for="apellidoPaternoFactura" class="form-label">Apellido Paterno</label>
          <input type="text" class="form-control" id="apellidoPaternoFactura" placeholder="Apellido Paterno">
        </div>
        <div class="mb-3">
          <label for="apellidoMaternoFactura" class="form-label">Apellido Materno</label>
          <input type="text" class="form-control" id="apellidoMaternoFactura" placeholder="Apellido Materno">
        </div>
        <div class="mb-3">
          <label for="direccion" class="form-label">Dirección</label>
          <input type="text" class="form-control" id="direccion" placeholder="Calle 123, Ciudad, País">
        </div>
        <div class="mb-3">
          <label for="rfc" class="form-label">RFC</label>
          <input type="text" class="form-control" id="rfc" placeholder="RFC">
        </div>
      </div>

      <button type="submit" class="btn btn-danger w-100">Ingresar Información del Pago</button>
    </form>
    <footer class="mt-4">
      <p>&copy; 2024 Compañía. Hotel Laguna Inn. Todos los derechos reservados.</p>
    </footer>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
