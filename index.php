<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilos/GaelEstilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Estilos/index.css">
    <link rel="stylesheet" href="Estilos/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>BORRADOR INTEGRADORA</title>
</head>
<body>


<!---->
  <header>
    <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4 ">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="index.php">
          <img src="Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center col-lg-9" id="navbarNav">
          <ul class="navbar-nav text-center">
            <li class="nav-item">
              <a class="nav-link" href="index.php"><label>INICIO</label></a>
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
              <a class="nav-link" href="Views/Calendario.php"><label>RESERVAR AHORA</label></a>
            </li>

<?php
session_start();
if(isset($_SESSION["usuario"])){

  echo ' 
        <div class="header-content">
            <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                    <span class="material-symbols-outlined ">
                        account_circle
                    </span>
                </button>
                <ul class="dropdown-menu glass">

                    <li>
                        <a class="dropdown-item" href="Views/panelusuario.php">
                            <span class="material-symbols-outlined lia">manage_accounts</span>
                            Gestionar cuenta
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Views/ver_datos_personales.php">
                            <span class="material-symbols-outlined lia">person</span>
                            Datos Personales
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Views/datospersonales.php">
                            <span class="material-symbols-outlined lia">edit</span>
                            Modificar mis Datos
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Views/historialreservaciones.php">
                            <span class="material-symbols-outlined">travel_explore</span>
                            Historial de Reservación
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="Scripts/Cerrar_Sesion.php">
                            <span class="material-symbols-outlined">logout</span>
                            Cerrar Sesión
                        </a>
                    </li> 
                    <?php
                    
                    
                    ?>
                    
                </ul>
                
                
            </div>
        </div>
    </div>';

}
else {
  echo '   <li class="nav-item">
              <a class="nav-link" href="Views/Login.php"><label>INICIAR SESION</label></a>
            </li>';
}

?>

          </ul>
        </div>
      </div>
    </nav>
  </div>
    </header>

<br><br><br><br>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
      <div class="carousel-item active">
          <img src="Imagenes/EXHOTEL2.png" class="d-block w-100" alt="...">
          <div class="carousel-caption">
              <h4>Ven y conocenos</h4>
              <p>Somos tu mejor opción para tu estancia</p>
              <p>en la comarca lagunera</p>
          </div>
      </div>
      <div class="carousel-item">
          <img src="Imagenes/RECEPCION.png" class="d-block w-100" alt="...">
          <div class="carousel-caption">
              <h4>¡Descubre</h4>
              <p>el paraíso escondido</p>
              <p>en la comarca lagunera!</p>
          </div>
      </div>
      <div class="carousel-item">
          <img src="Imagenes/PISCINA.png" class="d-block w-100" alt="...">
          <div class="carousel-caption">
              <h4>Tu refugio perfecto</h4>
              <p>lejos de casa te espera.</p>
          </div>
      </div>
      <div class="carousel-item">
          <img src="Imagenes/EXHOTEL.png" class="d-block w-100" alt="...">
          <div class="carousel-caption">
              <h4>Tu comodidad</h4>
              <p>es nuestra prioridad,</p>
              <p>¡ven y compruébalo!</p>
          </div>
      </div>
      <div class="carousel-item">
          <img src="Imagenes/EXHOTEL3.png" class="d-block w-100" alt="...">
          <div class="carousel-caption">
              <h4>Relájate y disfruta,</h4>
              <p>¡nos encargamos del resto!</p>
          </div>
      </div>
      <div class="carousel-item">
          <img src="Imagenes/EXHOTEL4.png" class="d-block w-100" alt="...">
          <div class="carousel-caption">
              <h4>Haz de tu estancia</h4>
              <p>un recuerdo para toda la vida.</p>
          </div>
      </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Imagen anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente imagen</span>
  </button>
</div>


<br><br>
<div class="HC container">
  <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
          <p class="text-muted">Hotel Laguna Inn</p>
          <h1 class="headline">Creamos un ambiente cómodo, cálido y hogareño</h1>
          <p class="subheadline">
              Bienvenidos a <span class="highlight">Hotel Laguna Inn</span>, el destino perfecto en la <span class="highlight">Comarca Lagunera</span> para aquellos que buscan comodidad, hospitalidad y un excelente servicio.
          </p>
          <p class="subheadline">
              Contamos con más de 15 años de experiencia dentro de nuestra hermosa ciudad <span class="highlight">Torreón Coahuila</span> atendiendo a nuestros huéspedes regionales e internacionales con la mejor calidad de servicios.
          </p>
          <a href="Views/nosotros.php" class="btn btn-custom">Conócenos</a>
      </div>
      <div class="col-md-6">
          <div class="image-container">
              <img src="../INTEGRADORAOFICIAL_E4/Imagenes/SILLONES.png" alt="Main Image">    
              
              <div class="image-overlay">
                <img src="../INTEGRADORAOFICIAL_E4/Imagenes/SILLONES.png" alt="Main Image">    
              </div>
          </div>
      </div>
  </div>
</div>
  
  <div class="HCON">
    <div class="HCG">
      <p class="text-muted">Hotel Laguna Inn</p>
      <h1 class="headline" style="text-align: left;">Nuestras Habitaciones</h1>
      <div class="gallery">
        <div class="imgBox">
          <a href="Views/vistahab.php">
              <h2>Sencilla</h2>
              <h3>Ver más</h3>
          </a>
        </div>

        <div class="imgBox">
          <a href="Views/vistahab.php">
              <h2>Doble</h2>
              <h3>Ver más</h3>
          </a>
        </div>

        <div class="imgBox">
          <a href="Views/vistahab.php">
              <h2>King-Size</h2>
              <h3>Ver más</h3>
          </a>
        </div>
      
          
      </div>
    </div>
  </div>
  


  <div class="contenedorpp" id="2424">
    <div class="container contenedorxd">
      <h1 class="headline">Nuestros Servicios</h1>
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
  

<div class="IMGTEXT">
  <div class="container-fluid my-custom-container">
    <div class="row my-custom-row align-items-center justify-content-center">
        <div class="col-md-5 order-md-1 order-2 my-custom-image-container">
            <img src="../INTEGRADORAOFICIAL_E4/Imagenes/DESAYUNO2.jpg" alt="Desayuno Buffet" class="img-fluid my-custom-image">
        </div>
        <div class="col-md-5 order-md-2 order-1 my-custom-text-container">
            <h2 class="my-custom-title">Desayuno Continental</h2>
            <p class="my-custom-description">
              Comienza tus mañanas disfrutando de una gran experiencia gastronómica con nuestro desayuno buffet, donde descubrirás una amplia variedad de platos calientes. También puedes ordenar a la carta y acompañar tu elección con deliciosos panes, jugos y café, disfrutando así de sabores exquisitos que te brindarán un comienzo perfecto para el día.
            </p>
        </div>
    </div>
    <div class="row my-custom-row align-items-center justify-content-center">
        <div class="col-md-5 order-md-1 order-1 my-custom-text-container">
            <h2 class="my-custom-title">Eventos y reuniones</h2>
            <p class="my-custom-description">
              Entendemos la importancia de tener espacios versátiles que se adapten a tus necesidades, ya sea para conferencias, capacitaciones, reuniones de negocios o celebraciones especiales como bodas y eventos familiares. Nuestro equipo está dedicado a ofrecerte un servicio personalizado y profesional que hará de tu evento una experiencia inolvidable.
            </p>
        </div>
        <div class="col-md-5 order-md-2 order-2 my-custom-image-container">
          <img src="../INTEGRADORAOFICIAL_E4/Imagenes/COMEDOR.png" alt="Eventos y Reuniones" class="img-fluid my-custom-image">
      </div>
    </div>
    <div class="row my-custom-row align-items-center justify-content-center">
      <div class="col-md-5 order-md-1 order-2 my-custom-image-container">
          <img src="../INTEGRADORAOFICIAL_E4/Imagenes/CERCANIA.png" alt="Desayuno Buffet" class="img-fluid my-custom-image">
      </div>
      <div class="col-md-5 order-md-2 order-1 my-custom-text-container">
          <h2 class="my-custom-title">Nuestra ubicación</h2>
          <p class="my-custom-description">
              Nos encontramos en el Blvrd Diagonal Reforma a espaldas de Sam's Club. A tu alrededor podrás encontrar la Unidad Deportiva, el Bosque Venustiano Carranza, y el estadio de Beisbol "Revolución", junto a diversos y llamativos restaurantes. ¡Tienes todo a tu alcance!
          </p>
      </div>
  </div>
  </div>
</div>

<div class="container my-faq-container">
  <h1 class="my-faq-title headline text-center">Preguntas frecuentes</h1>
  <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
          <div class="accordion" id="faqAccordion">
              <div class="card my-faq-card">
                  <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                          <button class="btn btn-link my-faq-button" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            ¿Qué incluye la habitación?    
                          </button>
                      </h2>
                  </div>
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                      <div class="card-body">
                        Nuestras habitaciones están diseñadas para brindarte la máxima comodidad durante tu estancia. Cada habitación incluye una cama King size, caja fuerte para tus pertenencias, un amplio escritorio de trabajo con silla, suelo alfombrado para mayor confort, detector de humo para tu seguridad, un acogedor sillón loveseat, una tabla de planchar para tu conveniencia, y una televisión Smart TV con canales por cable para tu entretenimiento. Las prestaciones pueden variar según la categoría de la habitación elegida.
                      </div>
                  </div>
              </div>
              <div class="card my-faq-card">
                  <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                          <button class="btn btn-link my-faq-button" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            ¿Se permite fumar en las habitaciones?
                          </button>
                      </h2>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                      <div class="card-body">
                        No, todas nuestras habitaciones son para no fumadores. Contamos con áreas designadas para fumar fuera del hotel. Esto garantiza un ambiente limpio y saludable para todos nuestros huéspedes. Agradecemos tu comprensión y cooperación en este aspecto.
                      </div>
                  </div>
              </div>
              <div class="card my-faq-card">
                  <div class="card-header" id="headingThree">
                      <h2 class="mb-0">
                          <button class="btn btn-link my-faq-button" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              ¿Puedo modificar la cantidad personas que me acompañaran?
                          </button>
                      </h2>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                      <div class="card-body">
                          Sí. Durante el proceso de tu reserva, podras observar un campo para modificar la cantidad personas que te acompañaran durante tu estancia. La cantidad máxima de personas puede variar dependiendo de la habitación que hayas seleccionado.
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


<br><br><br>

<div class="MAPCON">
  <iframe class="centrar_cont" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3599.877460372121!2d-103.41593952553012!3d25.542458417631522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868fdba3758de129%3A0x35634f6a2fc2812d!2sHotel%20Laguna%20INN!5e0!3m2!1ses-419!2smx!4v1717880915416!5m2!1ses-419!2smx" width="100%" height="500px" style="border:0;" allowfullscreen="true" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<!--PIE DE PAGINAA-->
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
