<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/vistahab.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!---->
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="../index.php">
                <img src="../Imagenes/LOGOO.jpeg" alt="Logo" style="width: 220px; height: 80px;"
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
                        <a class="nav-link" href="../index.php#2424"><label>SERVICIOS</label></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
                    </li>
             
                    <li class="nav-item">
                        <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
                    </li>
                    <?php
session_start();
if(isset($_SESSION["usuario"])){

  echo ' 
         <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                    <span class="material-symbols-outlined ">
                        account_circle
                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li>
                        <a class="dropdown-item" href="panelusuario.php">
                            <span class="material-symbols-outlined lia">manage_accounts</span>
                            Gestionar cuenta
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="ver_datos_personales.php">
                            <span class="material-symbols-outlined lia">person</span>
                            Datos Personales
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="datospersonales.php">
                            <span class="material-symbols-outlined lia">edit</span>
                            Modificar mis Datos
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="historialreservaciones.php">
                            <span class="material-symbols-outlined">travel_explore</span>
                            Historial de Reservación
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../Scripts/Cerrar_Sesion.php">
                            <span class="material-symbols-outlined">logout</span>
                            Cerrar Sesión
                        </a>
                    </li>
                    <?php
                    
                    
                    ?>
                    
                </ul>
                
                
            </div>';

}
else {
  echo '   <li class="nav-item">
              <a class="nav-link" href="Login.php"><label>INICIAR SESION</label></a>
            </li>';
}

?>
                </ul>
            </div>
        </div>
    </nav>
<section class="header-section">
    <div class="header-content">
        <p>HOTEL LAGUNA INN</p>
        <h1>HABITACIONES</h1>
    </div>
</section>
<br><br>

<!-- Contenedor principal -->
<div class="contenedor_cards_tittle">
  <div class="no">
    <p style="margin-bottom: 3%;">
      <p style="color: rgb(116, 13, 13); font-size: 200%;" class="col text-center font-weight-bold"><strong>Nuestras Habitaciones</strong></p>
      <p class="col text-center">¡Bienvenido a tu hogar en Torreón! Disfruta de la hospitalidad y el confort en nuestras acogedoras Habitaciones Sencillas o en las espaciosas King Size. <br> Ya sea que viajes por negocios o por placer, queremos que te sientas como en casa</p>
    </p>
  </div>
  <div class="container mt-7">
    <br><br>
    <br><br>
    <div class="row justify-content-center">
      <div class="col-md-4">
        <!-- CARD 1 -->
        <div class="card card-custom">
          <div id="carouselExampleAutoplaying1" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Imagenes/habitacioon sencilla 1.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal1">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion sencilla 2.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal1">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion sencilla 3.webp" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal1">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body col text-center">
            <h5 class="card-title">Habitacion Sencilla</h5>
            <p class="card-text">
              <br><br>
              <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>Aire Acondicionado
              <br><br>
              <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
            </p>
            <br><br>
            <a href="Calendario.php" class="btn">Reservar</a>
          </div>
        </div>
        <br><br>
      </div>
      <!-- CARD 2 -->
      <div class="col-md-4">
        <div class="card card-custom">
          <div id="carouselExampleAutoplaying2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Imagenes/habitacion1.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal2">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion doble 2.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal2">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion doble 3.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal2">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying2" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying2" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body col text-center">
            <h5 class="card-title">Habitacion Doble</h5>
            <p class="card-text">
              <br><br>
              <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
              <br><br>
              <i class="fa-solid fa-bed img"></i>&nbsp;2 camas&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
            </p>
            <br><br>
            <a href="Calendario.php" class="btn">Reservar</a>
          </div>
        </div>
        <br><br>
      </div>
      <div class="col-md-4">
        <!-- CARD 3 -->
        <div class="card card-custom">
          <div id="carouselExampleAutoplaying3" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Imagenes/habitacion king size 1.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal3">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion king size 2.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal3">
              </div>
              <div class="carousel-item">
                <img src="../Imagenes/habitacion king size 3.avif" class="d-block w-100" alt="..." data-bs-toggle="modal" data-bs-target="#exampleModal3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying3" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying3" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="card-body col text-center">
            <h5 class="card-title">Habitacion King Size</h5>
            <p class="card-text">
              <br><br>
              <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
              <br><br>
              <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
            </p>
            <br><br>
            <a href="Calendario.php" class="btn">Reservar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<br><br>
<hr class="mb-4">
    <!--AMENIDADES -->
    <div class="contenedorpp" id="2424">
  <div class="container contenedorxd">
    <h1 class="headline" style="color:rgb(116, 13, 13);">Nuestros Servicios</h1>
    <div class="row align-items-stretch">
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-swimmer"></i>
        <h4>Piscina</h4>
        <p>Ven y disfruta un rato en nuestra piscina apta para ti y tu familia.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-parking"></i>
        <h4>Estacionamiento</h4>
        <p>Ahorrate la duda de donde tendras que estacionar tu auto, tenemos cobertura exclusiavemnte para ti.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-wifi"></i>
        <h4>Wi-Fi</h4>
        <p>Disfruta sin molestias tus redes sociales con nuestra red Wifi.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-check"></i>
        <h4>Check-in y check-out exprés</h4>
        <p>A la hora de tu check-in o tu check-out, te atenderemos lo más rápido posible, porque siempre estamos a tu disposición.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-concierge-bell"></i>
        <h4>Recepción 24 horas</h4>
        <p>Nos preocupan nuestros huéspedes, por ello, las 24 horas del día nos encontramos en recepción. Listos para atenderte.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-utensils"></i>
        <h4>Desayuno gratis</h4>
        <p>No te quedes sin probar nuestro delicioso desayuno continental único para ti.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-snowflake"></i>
        <h4>Aire acondicionado</h4>
        <p>Con estos calores laguneros es esencial que te mantengas fresco. Y en tu habitación no tendrás que preocuparte por sudar.</p>
      </div>
      <div class="col-12 col-md-6 col-lg-3 feature-box">
        <i class="fas fa-suitcase"></i>
        <h4>Almacenaje de equipaje</h4>
        <p>Contamos con un almacén exclusivo y totalmente seguro para tu equipaje.</p>
      </div>
    </div>
  </div>
</div>

<style>
        .footer {
            background-color: #800000;
            padding: 20px;
            color: white;
        }
        .footer a {
            color: white !important;
            text-decoration: none;
        }
        .footer-section h2 {
            color: white;
        }
        .social-icons a {
            color: white !important;
            margin-right: 10px;
        }
    </style>


                <!---->
                <!--PIE DE PAGINAA-->
                <footer class="footer">
  <div class="footer-container">
      <div class="footer-section">
          <h2>Contáctanos</h2>
          <p><i class="fa-solid fa-house"></i> Calz Prof Ramón Méndez 3300, Nuevo Torreón, 27060 Torreón, Coah.</p>
          <a href="mailto:hotellagunainnmx@gmail.com" class="text-decoration-none hover-link"><p><i class="fa-solid fa-envelope"></i> hotellagunainnmx@gmail.com</p></a>
          <p><i class="fa-solid fa-phone"></i> +52 871 720 3020</p>
          <div class="social-icons">
              <a href="https://www.instagram.com/hotellagunainntrc"><i class="fa-brands fa-instagram"></i></a>
              <a href="https://www.facebook.com/hotellagunainntrc"><i class="fa-brands fa-facebook"></i></a>
              <a href="https://wa.me/5218712112828"><i class="fa-brands fa-whatsapp"></i></a>
          </div>
      </div>
      <div class="footer-section" >
          <h2>Explora</h2>
          <a href="../index.php" class="text-decoration-none hover-link"><p>Inicio</p></a>
          <a href="nosotros.php" class="text-decoration-none hover-link"><p>Nosotros</p></a>
          <a href="vistahab.php" class="text-decoration-none hover-link"><p>Habitaciones</p></a>
          <a href="../index.php#2424" class="text-decoration-none hover-link"><p>Servicios</p></a>
          <a href="Contacto.php" class="text-decoration-none hover-link"><p>Contactanos</p></a> 
      </div>
      <div class="footer-section">
          <h2>Novedades</h2>
          <p>Recibe las últimas ofertas y promociones del Hotel Laguna Inn</p>
          <form action="">
          <input type="email" placeholder="Email" required>
          <a href=""><button type="submit"><i class="fa-solid fa-paper-plane"></i></button></a>
          </form>
      </div>
  </div>
</footer>
                




                <!--MODAL-->
                <!--MODAL 1-->
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title-custom col text-center" id="exampleModalLabel1">Habitación Sencilla</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body-custom">
                                <div id="carouselExampleModal1" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../Imagenes/habitacioon sencilla 1.avif" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../Imagenes/habitacion sencilla 2.avif" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../Imagenes/habitacion sencilla 3.webp" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleModal1" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleModal1" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div>
                                    <br><br>
                                    <p class="text-white col text-center">
                                       
                                        Descansa en una cama King size y disfruta de comodidades modernas como Smart TV y WiFi de alta velocidad, junto con amenidades adicionales para una estancia sin preocupaciones.
                                        <br><br>
                                        <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
                                        <br><br>
                                        <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                
                                <a href="#" class="btn">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--MODAL 2-->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title-custom col text-center" id="exampleModalLabel2">Habitación Doble</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body-custom">
                                <div id="carouselExampleModal2" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../Imagenes/habitacion1.avif" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../Imagenes/habitacion doble 2.avif" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../Imagenes/habitacion doble 3.avif" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleModal2" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleModal2" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div>
                                    <br><br>
                                    <p class="text-white col text-center">
                                        Disfruta de la comodidad con dos camas matrimoniales, Smart TV, WiFi y espacio de trabajo. Además, cuenta con amenidades como teléfono, caja fuerte, baño privado y el clima artificial.
                                        <br><br>
                                        <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
                                        <br><br>
                                        <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer ">
                                
                                <a href="#" class="btn">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--MODAL 3-->
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title-custom col text-center" id="exampleModalLabel3">Habitación King Size</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body-custom">
                                <div id="carouselExampleModal3" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="../Imagenes/habitacion king size 1.avif" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../Imagenes/habitacion king size 2.avif" class="d-block w-100" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="../Imagenes/habitacion king size 3.avif" class="d-block w-100" alt="...">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleModal3" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleModal3" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div>
                                    <br><br>
                                    <p class="text-white col text-center">
                                        Cuenta con una cama King size, sofá cama, antecomedor, Smart TV, WiFi, escritorio, frigobar, servicio de café y microondas, entre otras amenidades. Ajusta el clima a tu gusto y disfruta la experiencia.
                                        <br><br>
                                        <i class="fa-solid fa-wifi img"></i>&nbsp;Wifi Gratuito &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-wind img"></i>&nbsp;Aire Acondicionado
                                        <br><br>
                                        <i class="fa-solid fa-bed img"></i>&nbsp;1 cama&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-mug-saucer img"></i>&nbsp;Desayuno
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                               
                                <a href="" class="btn">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


</body>

</html>