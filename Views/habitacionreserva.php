<?php

session_start();


?>

<?php
function renderDropdownItems($items) {
    foreach ($items as $value => $label) {
        echo '<li><a class="dropdown-item" href="#" data-value="' . $value . '">' . $label . '</a></li>';
    }
}

$dobleAdultOptions = [
    1 => '1 Adulto',
    2 => '2 Adultos',
    3 => '3 Adultos',
    4 => '4 Adultos'
];

$dobleKidOptions = [
    1 => '1 Niño',
    2 => '2 Niños',
    3 => '3 Niños'
];

$kingSizeAdultOptions = [
    1 => '1 Adulto',
    2 => '2 Adultos'
];

$kingSizeKidOptions = [
    1 => '1 Niño',
    2 => '2 Niños'
];

$sencillaAdultOptions = [
    1 => '1 Adulto',
    2 => '2 Adultos'
];

$sencillaKidOptions = [
    1 => '1 Niño'
];

function getMaxKidsForDoble($adultsValue) {
    switch ($adultsValue) {
        case 1:
            return 3;
        case 2:
            return 2;
        case 3:
            return 1;
        case 4:
            return 0;
        default:
            return 0;
    }
}

function getMaxKidsForKingSize($adultsValue) {
    switch ($adultsValue) {
        case 1:
            return 2;
        case 2:
            return 1;
        default:
            return 0;
    }
}

function getMaxKidsForSencilla($adultsValue) {
    switch ($adultsValue) {
        case 1:
            return 1;
        case 2:
            return 0;
        default:
            return 0;
    }
}
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
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
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
            border-color: rgb(116, 13, 13);
            color: #ffffff;
        }

        .ui-datepicker .ui-datepicker-current-day a {
            background-color: rgb(116, 13, 13);
            color: #ffffff;
        }

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

        .container {
            width: 30%;
            height: 50%;
            margin-left: 60%;
            margin-top: 10%;
            flex-wrap: wrap;
        }

        .conca {
            border-radius: 10px;
            border: 2px solid black;
            margin-left: 10%;
        }

        #añadir1 {
            margin-top: 40%;
            margin-left: -3%;
        }

        .dropdown-toggle {
            margin-bottom: 1%;
        }

        #info1 {
            display: none;
        }

        /* Estilos para el botón acordeón */
        .accordion-button {
            width: 100%;
            text-align: center;
        }

        @media (max-width: 900px) {
            #info1 {
                display: none;
            }
            #accordionButton {
                display: block;
            }
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
        
<div class="container-fluid d-flex justify-content-start flex-wrap position-relative">
    <!-- Habitación Doble -->
    <div class="container-custom move-right" data-room-type="doble">
        <div class="card card-custom">
            <div class="image-container">
                <img src="../Imagenes/HABITACION_D.png" alt="Habitación Doble">
            </div>
            <div class="card-body card-body-custom">
                <div>
                    <h5 class="card-title">Habitación Doble</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2 huéspedes</h6>
                    <p class="card-text">Nuestra Habitación Doble ofrece dos cómodas camas matrimoniales en un espacioso espacio de 23 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y dos sillones individuales.</p>
                    <a class="card-link">Ver detalles</a>
                </div>
                <div class="card-footer-custom">
                    <div class="price-info">
                        <h6>MXN 1290.00</h6>
                        <p>1 noche</p>
                    </div>
                    <div class="controls">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="doble-adults" data-bs-toggle="dropdown" aria-expanded="false">
                                Adultos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="doble-adults">
                                <?php renderDropdownItems($dobleAdultOptions); ?>
                            </ul>

                            <button class="btn dropdown-toggle" type="button" id="doble-kids" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                Niños
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="doble-kids">
                                <?php renderDropdownItems($dobleKidOptions); ?>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent decrease-btn">-</button>
                            <span class="quantity">1</span>
                            <button type="button" class="btn btn-transparent increase-btn">+</button>
                        </div>
                        <button type="button" class="btn btn-success custom-btn" onclick="mostrarResumen()">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Habitación King-Size -->
    <div class="container-custom move-right" data-room-type="king-size">
        <div class="card card-custom">
            <div class="image-container">
                <img src="../Imagenes/HABITACION_D.png" alt="Habitación King-Size">
            </div>
            <div class="card-body card-body-custom">
                <div>
                    <h5 class="card-title">Habitación King-Size</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2 huéspedes</h6>
                    <p class="card-text">Nuestra Habitación King-Size ofrece una cómoda cama tamaño king en un espacioso espacio de 23 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y dos sillones individuales.</p>
                    <a class="card-link">Ver detalles</a>
                </div>
                <div class="card-footer-custom">
                    <div class="price-info">
                        <h6>MXN 1490.00</h6>
                        <p>1 noche</p>
                    </div>
                    <div class="controls">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="king-size-adults" data-bs-toggle="dropdown" aria-expanded="false">
                                Adultos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="king-size-adults">
                                <?php renderDropdownItems($kingSizeAdultOptions); ?>
                            </ul>

                            <button class="btn dropdown-toggle" type="button" id="king-size-kids" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                Niños
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="king-size-kids">
                                <?php renderDropdownItems(array_merge([0 => '0 Niños'], $kingSizeKidOptions)); ?>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent decrease-btn">-</button>
                            <span class="quantity">1</span>
                            <button type="button" class="btn btn-transparent increase-btn">+</button>
                        </div>
                        <button type="button" class="btn btn-success custom-btn" onclick="mostrarResumen()">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Habitación Sencilla -->
    <div class="container-custom move-right" data-room-type="sencilla">
        <div class="card card-custom">
            <div class="image-container">
                <img src="../Imagenes/HABITACION_D.png" alt="Habitación Sencilla">
            </div>
            <div class="card-body card-body-custom">
                <div>
                    <h5 class="card-title">Habitación Sencilla</h5>
                    <h6 class="card-subtitle mb-2 text-muted">2 huéspedes</h6>
                    <p class="card-text">Nuestra Habitación Sencilla ofrece una cómoda cama matrimonial en un espacio de 23 m² con suelo alfombrado. Disfruta de comodidades como aire acondicionado, caja de seguridad, escritorio con silla ejecutiva y un sillón individual.</p>
                    <a class="card-link">Ver detalles</a>
                </div>
                <div class="card-footer-custom">
                    <div class="price-info">
                        <h6>MXN 990.00</h6>
                        <p>1 noche</p>
                    </div>
                    <div class="controls">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="sencilla-adults" data-bs-toggle="dropdown" aria-expanded="false">
                                Adultos
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="sencilla-adults">
                                <?php renderDropdownItems($sencillaAdultOptions); ?>
                            </ul>

                            <button class="btn dropdown-toggle" type="button" id="sencilla-kids" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                                Niños
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="sencilla-kids">
                                <?php renderDropdownItems($sencillaKidOptions); ?>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-transparent decrease-btn">-</button>
                            <span class="quantity">1</span>
                            <button type="button" class="btn btn-transparent increase-btn">+</button>
                        </div>
                        <button type="button" class="btn btn-success custom-btn" onclick="mostrarResumen()">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resumen de la Reserva -->
    <div id="info1" class="container-custom summary-container" style="display: none;">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title custom1">Resumen de la Reserva</h5>
                <h6 class="card-subtitle custom2 mb-2 text-muted">12 jul -> 13 jul</h6>
                <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                    <i class="fa-solid fa-moon">&nbsp;&nbsp;&nbsp;&nbsp;1 noche</i>
                </button>
                <br><br>
                <hr class="mb-4">
                <div id="room-summary"></div>
                <p><strong>Total &nbsp;&nbsp;&nbsp;&nbsp; MXN <span id="total-price">0.00</span></strong></p>
                <br><br>
                <div class="d-grid gap-6 col-10 mx-auto">
                    <button class="btn btn-success" type="button">Reservar Ahora</button> <br>
                    <button class="btn btn-danger" type="button" onclick="borrarCambios()">Borrar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botón acordeón para pantallas pequeñas -->
<div class="accordion d-md-none" id="accordionButton">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                Ver más información de mi reserva
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionButton">
            <div class="accordion-body">
                <!-- Contenido del resumen de la reserva para pantallas pequeñas -->
                <div id="room-summary-small"></div>
                <p><strong>Total &nbsp;&nbsp;&nbsp;&nbsp; MXN <span id="total-price-small">0.00</span></strong></p>
            </div>
        </div>
    </div>
</div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Seleccione la cantidad de personas que estarán en la habitación.
                    <br>
                    Hotel Laguna Inn.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
    $(document).ready(function() {
        var startDate;
        var endDate;
        var diaactual = new Date();
        var añoactual = diaactual.getFullYear();
        var ultimo = new Date(añoactual, 12, 31);

        $("#date_picker1").datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: diaactual,
            maxDate: ultimo,
            yearRange: añoactual + ':' + añoactual,
            beforeShowDay: checar
        });

        $("#date_picker2").datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: diaactual,
            maxDate: ultimo,
            yearRange: añoactual + ':' + añoactual,
            beforeShowDay: checar
        });

        $('#date_picker1').change(function() {
            startDate = $(this).datepicker('getDate');
            $("#date_picker2").datepicker("option", "minDate", startDate);
        });

        $('#date_picker2').change(function() {
            endDate = $(this).datepicker('getDate');
            $("#date_picker1").datepicker("option", "maxDate", endDate);
        });

        function checar(date) {
            var fecha = new Date(date);
            if (!startDate) {
                return [true, "av", "Disponible"];
            }
            var primerafecha = new Date(startDate).toDateString();
            var fechadehoy = fecha.toDateString();

            if (fechadehoy === primerafecha) {
                return [false, "notav", "No Disponible"];
            } else {
                return [true, "av", "Disponible"];
            }
        }
    });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomTypes = ['doble', 'king-size', 'sencilla'];

        roomTypes.forEach(roomType => {
            const adultDropdownItems = document.querySelectorAll(`#${roomType}-adults + .dropdown-menu .dropdown-item`);

            adultDropdownItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const selectedValue = this.getAttribute('data-value');
                    const selectedText = this.textContent;

                    // Update button text and store selected value
                    const dropdownToggle = document.getElementById(`${roomType}-adults`);
                    dropdownToggle.textContent = selectedText;
                    dropdownToggle.setAttribute('data-selected-value', selectedValue);

                    // Enable the kids dropdown
                    const kidsDropdown = document.getElementById(`${roomType}-kids`);
                    kidsDropdown.disabled = false;

                    updateKidsOptions(roomType, selectedValue);
                });
            });

            const kidsDropdownItems = document.querySelectorAll(`#${roomType}-kids + .dropdown-menu .dropdown-item`);
            kidsDropdownItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const selectedValue = this.getAttribute('data-value');
                    const selectedText = this.textContent;

                    // Update button text and store selected value
                    const dropdownToggle = document.getElementById(`${roomType}-kids`);
                    dropdownToggle.textContent = selectedText;
                    dropdownToggle.setAttribute('data-selected-value', selectedValue);
                });
            });
        });
    });

    
 $(document).ready(function () {
  // Mostrar contenido del resumen de la reserva en el acordeón
  $('#accordionButton .accordion-button').click(function () {
    if (!$(this).hasClass('collapsed')) {
      $('#room-summary-small').html($('#room-summary').html());
      $('#total-price-small').text($('#total-price').text());
    }
  });

  // Función para ocultar el contenedor del resumen de la reserva en pantallas pequeñas
  function toggleSummaryContainer() {
    if ($(window).width() <= 900 || $(window).width() > 1500) {
      $('#info1').hide();
      $('#accordionButton').show();
    } else {
      $('#accordionButton').hide();
    }
  }

  // Ejecutar la función al cargar la página y al redimensionar la ventana
  toggleSummaryContainer();
  $(window).resize(toggleSummaryContainer);
});

// Función para mostrar el contenedor del resumen de la reserva
function mostrarResumen() {
  if ($(window).width() > 900 && $(window).width() <= 1500) {
    $('#info1').show();
    ajustarPosicionResumen();
  }
}

// Función para ajustar la posición del contenedor del resumen de la reserva
function ajustarPosicionResumen() {
  var resumen = $('#info1');
  var containerFluid = $('.container-fluid');
  var offsetTop = containerFluid.offset().top;
  var offsetLeft = containerFluid.offset().left + containerFluid.width() - resumen.width() - 20; // Ajusta según sea necesario

  resumen.css({
    top: offsetTop + 20 + 'px',
    left: offsetLeft + 'px'
  });
}


    function updateKidsOptions(roomType, adultsValue) {
        let maxKids;
        switch (roomType) {
            case 'doble':
                maxKids = getMaxKidsForDoble(adultsValue);
                break;
            case 'king-size':
                maxKids = getMaxKidsForKingSize(adultsValue);
                break;
            case 'sencilla':
                maxKids = getMaxKidsForSencilla(adultsValue);
                break;
            default:
                maxKids = 0;
                break;
        }

        const kidsDropdownMenu = document.querySelector(`#${roomType}-kids + .dropdown-menu`);
        kidsDropdownMenu.querySelectorAll('.dropdown-item').forEach(item => {
            const kidValue = parseInt(item.getAttribute('data-value'));
            item.style.display = kidValue <= maxKids ? 'block' : 'none';
        });

        // Adjust kids selection if it exceeds the max allowed
        const kidsDropdown = document.getElementById(`${roomType}-kids`);
        const selectedKidsValue = parseInt(kidsDropdown.getAttribute('data-selected-value'));
        if (selectedKidsValue > maxKids) {
            kidsDropdown.textContent = `${maxKids} Niño${maxKids > 1 ? 's' : ''}`;
            kidsDropdown.setAttribute('data-selected-value', maxKids);
        }
    }

    function getMaxKidsForDoble(adultsValue) {
        switch (adultsValue) {
            case '1':
                return 3;
            case '2':
                return 2;
            case '3':
                return 1;
            case '4':
                return 0;
            default:
                return 0;
        }
    }

    function getMaxKidsForKingSize(adultsValue) {
        switch (adultsValue) {
            case '1':
                return 2;
            case '2':
                return 1;
            default:
                return 0;
        }
    }

    function getMaxKidsForSencilla(adultsValue) {
        switch (adultsValue) {
            case '1':
                return 1;
            case '2':
                return 0;
            default:
                return 0;
        }
    }

    function mostrar(button) {
        const roomContainer = button.closest('.container-custom');
        const roomType = roomContainer.getAttribute('data-room-type');
        const adultos = roomContainer.querySelector(`button[id="${roomType}-adults"]`).getAttribute('data-selected-value');
        const niños = roomContainer.querySelector(`button[id="${roomType}-kids"]`).getAttribute('data-selected-value');
        const cantidad = roomContainer.querySelector('.quantity').textContent;

        // Verificar si se han seleccionado opciones en ambos dropdowns
        if (!adultos) {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {});
            myModal.show();
            return;
        }

        console.log('Adultos seleccionados:', adultos);
        console.log('Niños seleccionados:', niños);
        console.log('Cantidad:', cantidad);

        // Mostrar el contenedor y ajustar su posición
        var info1 = document.getElementById('info1');
        info1.style.display = 'block';
        info1.style.position = 'absolute';
        info1.style.top = '200px';  // Cambia el valor para ajustar la posición vertical
        info1.style.left = '100px'; // Cambia el valor para ajustar la posición horizontal

        // Crear un nuevo contenedor de resumen de habitación
        const roomSummaryContainer = document.createElement('div');
        roomSummaryContainer.classList.add('room-summary-item');
        roomSummaryContainer.innerHTML = `
            <p id="room-type">Habitación ${capitalizeFirstLetter(roomType)} &nbsp;&nbsp;&nbsp;&nbsp; MXN ${cantidad * 1100}.00</p>
            <p style="color:gray;"> 2x Tarifa estándar</p>
            <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                <i class="fa-solid fa-person" id="num-adults">&nbsp;&nbsp;&nbsp;&nbsp;${adultos}</i>
            </button>
            ${niños ? `
            <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                <i class="fa-solid fa-child" id="num-kids">&nbsp;&nbsp;&nbsp;&nbsp;${niños}</i>
            </button>` : ''}
            <button type="button" class="btn btn-danger btn-remove-room" onclick="eliminar(this);">
                <i class="fa-solid fa-trash"></i>
            </button>
            <hr class="mb-4">
        `;

        document.getElementById('room-summary').appendChild(roomSummaryContainer);

        // Actualizar el precio total
        const totalPriceElement = document.getElementById('total-price');
        let totalPrice = parseFloat(totalPriceElement.textContent.replace('MXN ', '').replace(',', ''));
        totalPrice += cantidad * 1100;
        totalPriceElement.textContent = totalPrice.toFixed(2);
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function eliminar(button) {
        const roomSummaryItem = button.closest('.room-summary-item');
        const roomPriceText = roomSummaryItem.querySelector('#room-type').textContent;
        const roomPrice = parseFloat(roomPriceText.split('MXN ')[1].replace(',', ''));

        // Actualizar el precio total
        const totalPriceElement = document.getElementById('total-price');
        let totalPrice = parseFloat(totalPriceElement.textContent.replace('MXN ', '').replace(',', ''));
        totalPrice -= roomPrice;
        totalPriceElement.textContent = totalPrice.toFixed(2);

        // Eliminar el resumen de habitación
        roomSummaryItem.remove();

        // Verificar si no hay más habitaciones en el resumen
        const roomSummary = document.getElementById('room-summary');
        if (roomSummary.children.length === 0) {
            document.getElementById('info1').style.display = 'none';
        }
    }

    function borrarCambios() {
        // Eliminar todos los elementos del resumen de habitación
        const roomSummary = document.getElementById('room-summary');
        while (roomSummary.firstChild) {
            roomSummary.removeChild(roomSummary.firstChild);
        }

        // Reiniciar el precio total
        const totalPriceElement = document.getElementById('total-price');
        totalPriceElement.textContent = '0.00';

        // Ocultar el contenedor de resumen de la reserva
        document.getElementById('info1').style.display = 'none';
    }

    document.querySelectorAll('.increase-btn').forEach(button => {
        button.addEventListener('click', function() {
            const quantityElement = this.previousElementSibling;
            let quantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = ++quantity;
        });
    });

    document.querySelectorAll('.decrease-btn').forEach(button => {
        button.addEventListener('click', function() {
            const quantityElement = this.nextElementSibling;
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                quantityElement.textContent = --quantity;
            }
        });
    });
</script>

  
</body>
</html>