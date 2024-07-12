<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/reservavista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Habitacion Rserva</title>
</head>
<body>
<!--BARRA DE NAVEGACION-->
<header>
    <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4 ">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="index.html">
          <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center col-lg-9" id="navbarNav">
          <ul class="navbar-nav text-center">
            <li class="nav-item">
              <a class="nav-link" href="index.html"><label>INICIO</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Views/nosotros.php"><label>NOSOTROS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Views/vistahab.php"><label>HABITACIONES</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#2424"><label>SERVICIOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Views/Contacto.php"><label>CONTACTANOS</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Views/Login.php"><label>INICIAR SESION</label></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Views/Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
    </header>
    <!--BARRITA-->
    <section class="header-section">
        <div class="header-content">
            <p>HOTEL LAGUNA INN</p>
            <h1>RESERVACIONES</h1>
        </div>
    </section>
      <!--BARRITA BLANCA-->
      <div class="barra-blanca"></div>
      <!-- Tarjetas de habitaciones -->
  
    <!--TAREJETA 1-->
    <div class="card">
      <div class="card-body">
       
        <div id="carouselExampleIndicators1" class="carousel slide">
         
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img  src="../Imagenes/habitacioon sencilla 1.avif" class="d-block w-100 imagenes" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Imagenes/habitacion sencilla 2.avif" class="d-block w-100 imagenes" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Imagenes/habitacion sencilla 3.webp" class="d-block w-100 imagenes" alt="...">
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        
        </div>
        <h5 class="card-title custom1">Habitación Sencilla</h5>
        <h6 class="card-subtitle custom2 mb-2 text-body-secondary">Card subtitle</h6>
        <p class="card-text custom3">Descubre la elegancia de nuestra Habitación Máster, que cuenta con una cama King size para un descanso perfecto.</p>
        <br><br>
        <a href="#" class="card-link"><strong>Tarifa Estandar</strong></a><br>
        <a href="#" class="card-link">Ver detalles</a>
        <div class="aa">
          &nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;+
        </div> 
        <div class="dropdown nala">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            1
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div> 
        <button type="button"  id="btn-añadir"    class="btn btn-danger">Añadir</button> 
      </div>
    </div>

    <!--TARJETA 2-->
    <div class="card">
      <div class="card-body">
        
        <div id="carouselExampleIndicators2" class="carousel slide">
         
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../Imagenes/habitacion1.avif" class="d-block w-100 imagenes" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Imagenes/habitacion doble 2.avif" class="d-block w-100 imagenes" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Imagenes/habitacion doble 3.avif" class="d-block w-100 imagenes" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <h5 class="card-title custom1">Habitación Doble</h5>
        <h6 class="card-subtitle custom2 mb-2 text-body-secondary">Card subtitle</h6>
        <p class="card-text custom3 ">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>
  
    <!--TARJETA 3-->
    <div class="card">
      <div class="card-body">
       
        <div id="carouselExampleIndicators3" class="carousel slide">
          
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../Imagenes/habitacion king size 1.avif" class="d-block w-100 imagenes" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Imagenes/habitacion king size 2.avif" class="d-block w-100 imagenes" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Imagenes/habitacion king size 3.avif" class="d-block w-100 imagenes" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <h5 class="card-title custom1">Habitación King Size</h5>
        <h6 class="card-subtitle custom2 mb-2 text-body-secondary">Card subtitle</h6>
        <p class="card-text custom3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
      </div>
    </div>


    <!--PIE DE PAGINA-->
    <br><br>
    <br><br>
    <footer class="footer">
  <div class="footer-container">
      <div class="footer-section">
          <h2>Contáctanos</h2>
          <p><i class="fa-solid fa-house"></i> Av. de la Cantera 8510, Colonia Las Misiones I, CP 31115, Torreón, México</p>
          <p><i class="fa-solid fa-envelope"></i> hotellagunainn@inn.com</p>
          <p><i class="fa-solid fa-phone"></i> +52 (614) 432-1500</p>
          <div class="social-icons">
              <i class="fa-brands fa-instagram"></i>
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





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>