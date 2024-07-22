<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wight@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../Estilos/GaelEstilos.css">
</head>

<body>
  <style>
    .icono-si {
      font-size: 40px;
      margin-right: 20px;

    }

    .diplay {
      display: flex;
    }

    .no-compañero {
      display: flex;
      width: 100%;
      height: 100%;
    }

    .ai {
      width: 50%;

    }

    .pagina {
      font-size: 100%;
    }

    .pagina:hover {
      font-size: 140%;
      color: black;
    }
  </style>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="../index.php">
          <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;"
            class="rounded-circle rounded-1">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav text-center">
            <li class="nav-item">
              <a class="nav-link" href="../index.php"><label>INICIO</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="nosotros.php"><label>NOSOTROS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vistahab.php"><label>HABITACIONES</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php #2424"><label>SERVICIOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>
            <?php
            session_start();
            if (isset($_SESSION["usuario"])) {

              echo '<div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="material-symbols-outlined ">
                        account_circle

                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined lia">
                                person
                            </span> Gestionar cuenta </a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                travel_explore
                            </span>Historial de Reservación</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                add_comment
                            </span>Comentarios</a></li>
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                favorite
                            </span>Favoritos</a></li>
                    <li><a class="dropdown-item" href="../Php/Cerrar_Sesion.php"><span class="material-symbols-outlined">
                                logout
                            </span>Cerrar sesión</a></li>
                </ul>
            </div>';


            } else {
              echo '   <li class="nav-item">
              <a class="nav-link" href="Views/Login.php"><label>INICIAR SESION</label></a>
            </li>';
            }

            ?>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
  </header>
  <div id="main-content" class="container mt-5 pt-5">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 contact-info">
        <h5>Información de contacto</h5>
        <div class="info-item">
          <i class="fas fa-map-marker-alt"></i>
          <strong>Hotel Laguna INN Torreón, Coah</strong><br>
          <a href="tel:8715732505" class="text-decoration-none"><i class="fas fa-phone"></i> Teléfono:
            87-15-73-25-05</a><br>
          <a href="tel:8714556389" class="text-decoration-none"><i class="fas fa-phone"></i> Teléfono:
            87-14-55-63-89</a>
        </div>
        <div class="social-icons mt-3">
          <a href="https://www.facebook.com/hotellagunainntrc/" class="mr-2"><i class="fab fa-facebook-f"></i></a>
          <a href="https://www.instagram.com/hotellagunainntrc/"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <br>
      <br>
      <div class="col-lg-6 col-md-12">
        <form id="contact-form" action="../Scripts/send_email.php" method="POST">
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
            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Mensaje"
              required></textarea>
          </div>
          <button type="submit" class="btn btn-primary w-100">ENVIAR MENSAJE</button>
        </form>
        <div id="form-messages" class="mt-3"></div>
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
          echo '<div class="alert alert-success">Mensaje enviado exitosamente.</div>';
        }
        ?>

      </div>
    </div>
  </div>
  <!--PIE DE PAGINAA-->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h2>Contáctanos</h2>
        <p><i class="fa-solid fa-house"></i> Av. de la Cantera 8510, Colonia Las Misiones I, CP 31115, Torreón, México
        </p>
        <p><i class="fa-solid fa-envelope"></i> hotellagunainn@inn.com</p>
        <p><i class="fa-solid fa-phone"></i> +52 (614) 432-1500</p>
        <div class="social-icons">
          <a href=""></a><i class="fa-brands fa-instagram"></i>
          <i class="fa-brands fa-facebook"></i>
          <i class="fa-brands fa-whatsapp"></i>
        </div>
      </div>
      <div class="footer-section">
        <h2>Explora</h2>
        <p>Inicio</p>
        <p>Nosotros</p>
        <p>Habitaciones</p>
        <p>Amenidades</p>
      </div>
      <div class="footer-section">
        <h2>Novedades</h2>
        <p>Recibe las últimas ofertas y promociones del Hotel Laguna Inn</p>
        <input type="text" placeholder="Email">
        <i class="fa-solid fa-paper-plane"></i>
      </div>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>