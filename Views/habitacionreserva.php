<?php

session_start();


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Estilos/reservavista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Habitacion Rserva</title>
</head>
<style>
   .containers {
            display: flex;
            border: 1px solid black;
            border-radius: 20px;
            width: 40rem;
            height: 2rem;
            align-items: center;
          gap: 40px;
          padding: 0 120px;
          margin-left: 30%;
          margin-top: 3%;
        }

        .container input {
            flex: 1;
            height: 60%;
            width: 30%;
           
        }

        .ui-datepicker {
    background-color: #ffff;
        }
        .ui-datepicker-calendar td {
    background-color: rgb(116, 13, 13);
}

.ui-datepicker-header {
    background-color: #ffff;
}

.ui-datepicker-calendar a {
    color: #ffff;
}

.ui-datepicker-calendar .ui-state-active {
    background-color: rgb(116, 13, 13);
    border-color: rgb(116, 13, 13);;
    color: #ffffff; }

    .ui-datepicker .ui-datepicker-current-day a {
  background-color:  rgb(116, 13, 13); /* Cambia esto al color que desees */
  color: #ffffff; /* Cambia esto al color del texto que desees */
}

    /*rgb(116, 13, 13);*/

    /*PIE DE PAGINA */

    .footer {
    background-color: rgb(116, 13, 13);
    color: white;
    padding: 20px 0;
    width: 100%;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
    
}
.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    width: 100%;
    padding: 0 20px;
    color: white;
}
.footer-section {
    flex: 1;
    min-width: 200px;
    margin: 10px;
    color: white;
}
.footer-section h2 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: white;
}
.footer-section p {
    margin: 5px 0;
    color: white;
}
.social-icons i {
    font-size: 1.2rem;
    margin-right: 10px;
    color: white;
}
@media (min-width: 768px) {
    .footer-section h2 {
        font-size: 1.5rem;
    }
    .footer-section p {
        font-size: 1rem;
    }
    .social-icons i {
        font-size: 1.5rem;
    }
}



.container{
    width: 30%;
    height: 50%;
    margin-left: 60%;
    margin-top: 10%;
    flex-wrap:wrap;
}


.conca {
        border-radius: 10px;
        border: 2px solid black;
        margin-left:10%
        


    }

    #añadir1 {
        margin-top: 40%;
        margin-left: -3%
    }

 
  .dropdown-toggle{
margin-bottom: 1%;

  }

  #info1{
    display:none;
  }

</style>
<body>
<!--BARRA DE NAVEGACION-->
<header>
    <div class="row">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-4 ">
      <div class="container-fluid">
        <a class="navbar-brand p-2 w-25 h-50 d-inline-block col-lg-3" href="../index.php">
          <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center col-lg-9" id="navbarNav">
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

if(isset($_SESSION["usuario"])){

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
    <!--BARRITA-->
    <section class="header-section">
        <div class="header-content">
            <p>HOTEL LAGUNA INN</p>
            <h1>RESERVACIONES</h1>
        </div>
      
    </section>
      <!--BARRITA BLANCA-->
      <div class="barra-blanca">
        <div class="containers">
            <input type="text" id="date_picker1"> 
            <input type="text" id="date_picker2">
        </div>
    </div>

<!-- Tarjetas de habitaciones -->


      <!--DIV DE QUE ESTA VACIO LA RESERVA
<div class="container">
<div class="card text-center" style="width: 30rem; height:20rem; margin-left:60%; margin-top:10%">
    <div class="container">
   <i class="fa-solid fa-bed"></i> 
</div>
  <div class="card-body">
  <p>No se han agregado alojamientos</p>
    <p></p>
  </div>
</div>
</div> 
-->
        
<!--DIV A MOSTRAR CUANDO SE PRESIONA EL BOTON DE AÑADIR-->
<div id="info1" class="container">
    <div class="card card-custom">
        <div class="card-body">
            <h5 class="card-title custom1">Resumen de la Reserva</h5>
            <h6 class="card-subtitle custom2 mb-2 text-muted">12 jul -> 13 jul</h6>
            <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                <i class="fa-solid fa-moon">&nbsp;&nbsp;&nbsp;&nbsp;1 noche</i>
            </button>
            <br><br>
            <hr class="mb-4">
            <p>Habitación Doble &nbsp;&nbsp;&nbsp;&nbsp; MXN 2,200.00</p>
            <p style="color:gray;"> 2x Tarifa estándar</p>
            <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                <i class="fa-solid fa-person">&nbsp;&nbsp;&nbsp;&nbsp;1</i>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-child">&nbsp;&nbsp;&nbsp;&nbsp;1</i>
            </button>
            &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn" data-bs-toggle="button"><i class="fa-solid fa-trash"></i></button>
            <br><br>
            <hr class="mb-4">
            <p><strong>Total  &nbsp;&nbsp;&nbsp;&nbsp; MXN 1,100.00</strong></p>
            <br><br>
            <div class="d-grid gap-6 col-10 mx-auto">
                <button class="btn btn-danger" type="button">Reservar Ahora</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid d-flex justify-content-start flex-wrap position-relative">
    <div class="container-custom move-right">
        <div class="card card-custom">
            <div class="image-container">
                <img src="../Imagenes/HABITACION_D.png" alt="Habitación Doble">
            </div>
            <div class="card-body card-body-custom">
                <div>
                    <h5 class="card-title">Habitación Doble</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2 huéspedes</h6>
                    <p class="card-text">Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacioso espacio de 23 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y dos sillones individuales.</p>
                    <a href="#" class="card-link">Ver detalles</a>
                </div>
                <div class="card-footer-custom">
                    <div class="price-info">
                        <h6>MXN 1290.00</h6>
                        <p>1 noche</p>
                    </div>
                    <div class="controls">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                Huéspedes
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <li><a class="dropdown-item" href="#">1 huésped</a></li>
                                <li><a class="dropdown-item" href="#">2 huéspedes</a></li>
                                <li><a class="dropdown-item" href="#">3 huéspedes</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent" data-toggle="button">-</button>
                            <span>1</span>
                            <button type="button" class="btn btn-transparent" data-toggle="button">+</button>
                        </div>
                        <button type="button" id="añadir3" onclick="mostrar();" class="btn btn-success custom-btn">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-custom move-right">
        <div class="card card-custom">
            <div class="image-container">
                <img src="../Imagenes/HABITACION_S.png" alt="Habitación Sencilla">
            </div>
            <div class="card-body card-body-custom">
                <div>
                    <h5 class="card-title">Habitación Sencilla</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2 huéspedes</h6>
                    <p class="card-text">Nuestra Habitación Sencilla ofrece una cómoda cama matrimonial en un espacioso espacio de 15 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad y escritorio con silla ejecutiva.</p>
                    <a href="#" class="card-link">Ver detalles</a>
                </div>
                <div class="card-footer-custom">
                    <div class="price-info">
                        <h6>MXN 690.00</h6>
                        <p>1 noche</p>
                    </div>
                    <div class="controls">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Huéspedes
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#">1 huésped</a></li>
                                <li><a class="dropdown-item" href="#">2 huéspedes</a></li>
                                <li><a class="dropdown-item" href="#">3 huéspedes</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent" data-toggle="button">-</button>
                            <span>1</span>
                            <button type="button" class="btn btn-transparent" data-toggle="button">+</button>
                        </div>
                        <button type="button" id="añadir2" onclick="mostrar();" class="btn btn-success custom-btn">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-custom move-right">
        <div class="card card-custom">
            <div class="image-container">
                <img src="../Imagenes/HABITACION_K.png" alt="Habitación King Size">
            </div>
            <div class="card-body card-body-custom">
                <div>
                    <h5 class="card-title">Habitación King Size</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2 huéspedes</h6>
                    <p class="card-text">Nuestra Habitación King Size ofrece una cómoda cama king size en un espacioso espacio de 30 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y dos sillones individuales.</p>
                    <a href="#" class="card-link">Ver detalles</a>
                </div>
                <div class="card-footer-custom">
                    <div class="price-info">
                        <h6>MXN 1290.00</h6>
                        <p>1 noche</p>
                    </div>
                    <div class="controls">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                Huéspedes
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <li><a class="dropdown-item" href="#">1 huésped</a></li>
                                <li><a class="dropdown-item" href="#">2 huéspedes</a></li>
                                <li><a class="dropdown-item" href="#">3 huéspedes</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent" data-toggle="button">-</button>
                            <span>1</span>
                            <button type="button" class="btn btn-transparent" data-toggle="button">+</button>
                        </div>
                        <button type="button" id="añadir3" onclick="mostrar();" class="btn btn-success custom-btn">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="../Js/habireserva.js"  ></script>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
    ///////
    var startDate;
    var endDate;
     $( "#date_picker1" ).datepicker({
    dateFormat: 'dd-mm-yy'
    })
    ///////
    ///////
     $( "#date_picker2" ).datepicker({
    dateFormat: 'dd-mm-yy'
    });
    ///////
    $('#date_picker1').change(function() {
    startDate = $(this).datepicker('getDate');
    $("#date_picker2").datepicker("option", "minDate", startDate );
    })
    
    ///////
    $('#date_picker2').change(function() {
    endDate = $(this).datepicker('getDate');
    $("#date_picker1").datepicker("option", "maxDate", endDate );
    })
    ////////////////
    })
    </script> 

<script>
      function mostrar() {
        var info1 = document.getElementById('info1');

        // Mostrar el contenedor y ajustar su posición
        info1.style.display = 'block';
        info1.style.position = 'absolute';

        // Ajusta estas propiedades según tus necesidades
        info1.style.top = '200px';  // Cambia el valor para ajustar la posición vertical
        info1.style.left = '100px'; // Cambia el valor para ajustar la posición horizontal

        
    }
</script>
  
</body>
</html>