<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=PT+Sans:wight@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/estilos.css">

    <title>Contactanos</title>

</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid text-center mb-3">
    <a class="navbar-brand mr-5" href="#">
      <img class="navbar-brand-img" src="img/logo_hotel_nvar.jpeg" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mb-3 mr-5 text-dark">
          <a class="nav-link active fs-5 nav-link-hover" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item mr-5 ">
          <a class="nav-link fs-5 nav-link-hover" href="#">Nosotros</a>
        </li>
        <li class="nav-item mr-5 ">
          <a class="nav-link fs-5 nav-link-hover" href="#">Habitaciones</a>
        </li>
        <li class="nav-item mr-5">
          <a class="nav-link fs-5 nav-link-hover" href="#">Amenidades</a>
        </li>
        <li class="nav-item mr-5">
          <a class="nav-link fs-5 nav-link-hover" href="#">Contacto</a>
        </li>
        <li class="nav-item mr-5">
          <a class="nav-link fs-5 nav-link-hover" href="#" style="white-space: nowrap;">Iniciar Sesión</a>
        </li>
        <li class="nav-item mr-5">
          <button type="button" class="btn btn-outline-danger fs-5 btn-hover ">Reservar Ahora</button>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 d-flex align-items-center justify-content-center">

  <div class="row">
    <div class="col-lg-3 col-md-12 contact-info">
      <h5>Información de contacto</h5>
      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i> 
        <strong>Hotel Laguna INN Torreón, Coah</strong><br>
        <a href="tel:8715732505" class="text-decoration-none text-dark"><i class="fas fa-phone"></i> Teléfono: 87-15-73-25-05</a>
      </div>
      <div class="social-icons mt-3 ">
        <a href="https://www.facebook.com/hotellagunainntrc/" class="mr-2"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/hotellagunainntrc/"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-7 col-md-12">
      <form id="contact-form">
        <div class="row mb-3">
          <div class="col-lg-6 col-sm-12">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
          </div>
          <br>
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
        <button type="submit" class="btn btn-primary bg-danger justify-content-center btn-enviar-mensaje">ENVIAR MENSAJE</button>
      </form>
      <div id="form-messages" class="mt-3"></div>
    </div>
  </div>
</div>
<br>
<br>
<br>
<br>
<div class="row">
  <div class="barra_abajo col-12 lg-12 md-12 sm-12 bg-danger text-center text-white">
            <h2>Contáctanos</h2>
            <p>Perif. Raúl López Sánchez 9034, Colonia Nueva Laguna Sur, CP 27110 Torreón, Coahuila, México</p>
            </div>
    </div>
<script>
  $(document).ready(function() {
    $('#contact-form').submit(function(event) {
      event.preventDefault(); // Evita el envío tradicional del formulario
      $.ajax({
        type: 'POST',
        url: 'http://localhost:5000/send_email',
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
