<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wight@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="estilos/estilos.css">
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ">
  <div class="container-fluid">
    <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="#">
      <img src="img/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav text-center">
        <li class="nav-item">
          <a class="nav-link" href="#"><label>INICIO</label></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><label>NOSOTROS</label></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><label>HABITACIONES</label></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><label>SERVICIOS</label></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><label>CONTACTANOS</label></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><label>INICIAR SESION</label></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><label>RESERVAR AHORA</label></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>
<div id="main-content" class="container mt-5 pt-5">
  <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 contact-info">
      <h5>Información de contacto</h5>
      <div class="info-item">
        <i class="fas fa-map-marker-alt"></i> 
        <strong>Hotel Laguna INN Torreón, Coah</strong><br>
        <a href="tel:8715732505" class="text-decoration-none"><i class="fas fa-phone"></i> Teléfono: 87-15-73-25-05</a><br>
        <a href="tel:8714556389" class="text-decoration-none"><i class="fas fa-phone"></i> Teléfono: 87-14-55-63-89</a>
      </div>
      <div class="social-icons mt-3">
        <a href="https://www.facebook.com/hotellagunainntrc/" class="mr-2"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/hotellagunainntrc/"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="col-lg-6 col-md-12">
      <form id="contact-form">
        <div class="row mb-3">
          <div class="col-lg-6 col-sm-12">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
          </div>
          <div class="col-lg-6 col-sm-12 mt-3 mt-lg-0">
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" required>
          </div>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" id="correo" name="correo" placeholder="Email" required>
        </div>
        <div class="mb-3">
          <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Mensaje" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">ENVIAR MENSAJE</button>
      </form>
      <div id="form-messages" class="mt-3"></div>
    </div>
  </div>
</div>

<div class="barra_abajo text-center text-white mt-5">
  <h2>Contáctanos</h2>
  <p>Calz Prof Ramón Méndez 3300, Nuevo Torreón, 27060 Torreón, Coah.</p>
  <h4>Acerca de este hotel </h4>
    <p>Este hotel tranquilo se encuentra a 3 km del parque recreativo Bosque Venustiano Carranza, a 5 km de la animada Plaza Mayor Torreón y a 6 km del centro cultural Arocena Laguna, A.C.
    
    Hora de registro de entrada: 3:00 p.m.
    Hora de registro de salida: 12:00 p.m.</p>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $('#contact-form').submit(function(event) {
      event.preventDefault(); // Evita el envío tradicional del formulario
      $.ajax({
        type: 'POST',
        url: 'http://192.168.100.45:5000/send_email',
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
</body>
</html>
