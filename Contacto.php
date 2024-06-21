<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
  <link rel="stylesheet" href="estilos/estilos.css">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .navbar-custom {
            background-color: #800020; /* Wine color */
        }
        .navbar-custom .nav-link {
            color: white;
        }
        .navbar-custom .nav-link:hover {
            color: #d3d3d3; /* Light grey on hover */
        }
        .navbar-custom .navbar-brand {
            color: white;
        }
        .navbar-custom .navbar-brand:hover {
            color: #d3d3d3; /* Light grey on hover */
        }
        .navbar-custom .btn-primary {
            background-color: green;
            border-color: green;
        }
        .navbar-custom .btn-primary:hover {
            background-color: #004d00;
            border-color: #004d00;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            LOS CEDROS HOTEL INN Torreón
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Habitaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Amenidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Destinos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">[EN]</a>
                </li>
            </ul>
            <form class="form-inline">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Reservar Ahora</button>
            </form>
        </div>
    </nav>
<div class="container mt-5">
  <div class="row">
    <div class="col-lg-3 col-md-12 contact-info">
      <h5>Información de contacto</h5>
      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i> 
        <strong>Hotel Laguna INN Torreón, Coah</strong><br>
        <a href="tel:8715732505" class="text-decoration-none"><i class="fas fa-phone"></i> Teléfono: 87-15-73-25-05</a>
      </div>
      <div class="social-icons mt-3">
        <a href="#" class="mr-2"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-7 col-md-12">
      <form id="contact-form">
        <div class="row mb-3">
          <div class="col-lg-6 col-sm-12">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
          </div>
          <div class="col-lg-6 col-sm-12">
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
          </div>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" id="correo" name="correo" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Mensaje" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">ENVIAR MENSAJE</button>
      </form>
      <div id="form-messages" class="mt-3"></div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#contact-form').submit(function(event) {
      event.preventDefault(); // Evita el envío tradicional del formulario
      $.ajax({
        type: 'POST',
        url: 'http://localhost:5000/send_email', // Asegúrate de que esta URL es correcta
        data: $(this).serialize(), // Serializa el formulario para enviar los datos
        success: function(response) {
          $('#form-messages').html('<div class="alert alert-success">' + response.message + '</div>');
          $('#contact-form')[0].reset(); // Reinicia el formulario
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Error desconocido';
          $('#form-messages').html('<div class="alert alert-danger">Hubo un error al enviar el mensaje: ' + errorMessage + '</div>');
        }
      });
    });
  });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
