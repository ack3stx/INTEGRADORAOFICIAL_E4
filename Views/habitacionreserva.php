<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitacion reserva</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../Estilos/A.css">
</head>
<style>

</style>
<body>
   
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="#">
        <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 180px; height: 80px;" class="rounded-circle rounded-1">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav text-center">
          <li class="nav-item">
            <a class="nav-link" href="../index.html"><label>INICIO</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="nosotros.php"><label>NOSOTROS</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vistahab.php"><label>HABITACIONES</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.html #2424"><label>SERVICIOS</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Login.php"><label>INICIAR SESION</label></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
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
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacioon sencilla 1.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion sencilla 2.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion sencilla 3.webp" class="d-block w-100" alt="...">
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
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion1.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion doble 2.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion doble 3.avif" class="d-block w-100" alt="...">
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
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion king size 1.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion king size 2.avif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../INTEGRADORAOFICIAL_E4/img/habitacion king size 3.avif" class="d-block w-100" alt="...">
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
    <footer  style="background-color:  rgb(116, 13, 13);" class="text-white pt-5 pb-4 pl-0 pr-0 no-compañero">
      <div class="container text-center text-md-start">
          <div class="row text-center text-md-start">
              <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 ai">
                  <h2 class="text-left">Contáctanos</h2>
                  <hr class="mb-4">
                  <p class="text-left">
                      <i class="fa-solid fa-house"></i>&nbsp;&nbsp; Av. de la Cantera 8510, Colonia Las Misiones I, CP 31115, Torreón , México
                      <br>
                      <i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;hotellagunainn@inn.com
                      <br>
                      <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;+52 (614) 432-1500
                      <br><br>
                      <p class="diplay">
                      <i class="fa-brands fa-instagram icono-si"></i>
                      <i class="fa-brands fa-facebook icono-si diplay"></i>
                      <i class="fa-brands fa-whatsapp icono-si"></i>
                      </p>
                  </p>
              </div>
          </div>
      </div>
      <div class="container text-center text-md-start">
          <div class="row text-center text-md-start">
              <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 ai">
                  <h2 class="text-left">Explora</h2>
                  <hr class="mb-4">
                  
                      <p class="pagina">Inicio</p>
                      <br>
                      <p class="pagina">Nosotros</p>
                      <br>
                      <p class="pagina" >Habitaciones</p>
                      <br>
                      <p class="pagina">Amenidades</p>
                      <br>
                      
              </div>
          </div>
      </div>
      <div class="container text-center text-md-start">
          <div class="row text-center text-md-start">
              <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 ai">
                  <h2 class="text-left">Novedades</h2>
                  <hr class="mb-4">
                  
                      <p>Recibe las últimas ofertas y promociones del Hotel Laguna Inn</p>
                      <br>
                     <input type="text" placeholder="Email" >
                     <i  style="color: black;"      class="fa-solid fa-paper-plane"></i>
                      
              </div>
          </div>
      </div>
  </footer>


  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>
