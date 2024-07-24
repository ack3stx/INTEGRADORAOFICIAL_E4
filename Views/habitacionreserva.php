<?php

include '../Clases/BasedeDatos.php';

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['fechainicio']) && isset($_POST['fechafin'])) {
        $fechaInicio = $_POST['fechainicio'];
        $fechaFin = $_POST['fechafin'];



        //esta funcion esta porque las fechas que recibo de javascript estan en el formato dd-mm-yyyy
        function convertirFecha($fecha) {
            $date = DateTime::createFromFormat('d-m-Y', $fecha);
            if ($date === false) {
                return null; 
            }
            return $date->format('Y-m-d'); //con format se crea un nuevo formato
        }

        // con la funcion que hicimos convertimos las fechas
        $fechaInicioConvertida = convertirFecha($fechaInicio);
        $fechaFinConvertida = convertirFecha($fechaFin);

        echo 'Fecha Inicio Convertida: ' . htmlspecialchars($fechaInicioConvertida) . '<br>';
        echo 'Fecha Fin Convertida: ' . htmlspecialchars($fechaFinConvertida) . '<br>';

        // despues de convertirlas llamamos al procedimiento
        if ($fechaInicioConvertida && $fechaFinConvertida) {
            $data = new Database();
            $data->conectarDB();
            $disponibilidad = $data->disponibilidad($fechaInicioConvertida, $fechaFinConvertida);
            $disponibilidadkingsize = $data->disponibilidad_kingsize($fechaInicioConvertida, $fechaFinConvertida);
            $disponibilidadsencilla = $data->disponibilidad_sencilla($fechaInicioConvertida, $fechaFinConvertida);


            $cantidad = [
                
                    "Doble" => $disponibilidad,
                    "King Size" => $disponibilidadkingsize,
                    "Sencilla" => $disponibilidadsencilla
                


            ];

            
            $var =json_encode($cantidad);
            echo '<script>console.log("var",'.$var.');</script>';
            $data->desconectarBD();
        } else {
            echo "Error al convertir las fechas.";
        }


    } else {
        echo "Fechas no recibidas correctamente.";
    }
}



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
<!--BARRA DE NAVEGACION
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
    </header> -->
    <!--BARRITA-->
    <section class="header-section">
        <div class="header-content">
            <p>HOTEL LAGUNA INN</p>
            <h1>RESERVACIONES</h1>
        </div>
      
    </section>
     <!-- BARRITA BLANCA-->
      <form id="form" method="POST">
      <div class="barra-blanca">
        <div class="containers">
            <input type="text" id="date_picker1" name="fechainicio" placeholder="Ingresa tu fecha"> 
            <input type="text" id="date_picker2" name="fechafin" placeholder="Ingresa tu fecha">
        </div>

        <button style="margin-top:-5%;" type="submit" id="buscar" class="btn btn-danger">Buscar</button>
    </div>
</form>

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
                        <button type="button" class="btn btn-success custom-btn" onclick="mostrar(this);">Añadir</button>
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
                        <button type="button" class="btn btn-success custom-btn" onclick="mostrar(this);">Añadir</button>
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
                        <button type="button" class="btn btn-success custom-btn" onclick="mostrar(this);">Añadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="scrollableModal" tabindex="-1" aria-labelledby="scrollableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalLabel">Resumen de la Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
                <!-- El contenido dinámico se insertará aquí -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button class="btn btn-success" type="button">Reservar Ahora</button> <br>
                <button class="btn btn-danger" type="button" onclick="borrarCambios()">Borrar Cambios</button>
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

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Cambios Descartados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Los cambios han sido descartados.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="card" id="card-container" style="max-width: 600px; display: none;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">Tus habitaciones</h5>
        <p class="card-text">Mira el resumen de tu reserva</p>
        <div id="card-room-summary"></div>
        <p><strong>Total &nbsp;&nbsp;&nbsp;&nbsp; MXN <span id="card-total-price">0.00</span></strong></p>
        <a href="#" class="btn btn-primary" id="ver-mas-btn">Ver más</a>
    </div>
</div>

<div id="info1" class="container" style="display: none;">
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


     

    $('#buscar').click(function(){
            $.ajax({
                url:"habitacionreserva.php",
                type:'POST',
                data: $('#form').serialize(),
                success:function(res){
                    $('#respuesta').html(res);
                }
            });
        });
    </script>

<script>
 // Variable para llevar la cuenta de las habitaciones añadidas
 let roomCount = 0;

// Función para verificar el tamaño de la pantalla
function checkScreenWidth() {
    const contenedor = document.getElementById('info1');
    const cardContainer = document.getElementById('card-container');

    if (window.innerWidth <= 950) {
        if (roomCount > 0 && contenedor) {
            contenedor.style.display = 'none';
            cardContainer.style.display = 'block';
        } else {
            contenedor.style.display = 'none';
            cardContainer.style.display = 'none';
        }
    } else {
        if (roomCount > 0 && roomCount < 5 && contenedor) {
            contenedor.style.display = 'block';
            contenedor.style.position = 'absolute';
            contenedor.style.top = '200px';
            contenedor.style.left = '100px';
        } else {
            contenedor.style.display = 'none';
        }
        if (roomCount >= 5) {
            cardContainer.style.display = 'block';
        } else {
            cardContainer.style.display = 'none';
        }
    }
}

// Verificar el tamaño de la pantalla cuando se carga la página
window.onload = checkScreenWidth;

// Verificar el tamaño de la pantalla cuando se redimensiona la ventana
window.onresize = checkScreenWidth;

function mostrar(button) {
    const roomContainer = button.closest('.container-custom');
    const roomType = roomContainer.getAttribute('data-room-type');
    const adultos = roomContainer.querySelector(`button[id="${roomType}-adults"]`).getAttribute('data-selected-value');
    const niños = roomContainer.querySelector(`button[id="${roomType}-kids"]`).getAttribute('data-selected-value');

    if (!adultos) {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {});
        myModal.show();
        return;
    }

    const resumenHTML = `
        <div class="room-summary-item">
            <p id="room-type">Habitación ${capitalizeFirstLetter(roomType)} &nbsp;&nbsp;&nbsp;&nbsp; MXN 1100.00</p>
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
        </div>
    `;

    // Determinar dónde agregar el resumen de la habitación
    if (window.innerWidth <= 950) {
        const cardContainer = document.getElementById('card-container');
        const cardRoomSummaryElement = document.getElementById('card-room-summary');
        cardRoomSummaryElement.insertAdjacentHTML('beforeend', resumenHTML);
        cardContainer.style.display = 'block';
    } else {
        const roomSummaryElement = document.getElementById('room-summary');
        roomSummaryElement.insertAdjacentHTML('beforeend', resumenHTML);
    }

    updateTotalPrice(1100);

    roomCount++;

    // Verificar el tamaño de la pantalla y la cantidad de habitaciones para mostrar u ocultar la card
    checkScreenWidth();

    // Verificar si se han añadido 5 habitaciones
    if (roomCount >= 5) {
        const modalBodyContent = document.getElementById('modal-body-content');
        const roomSummaryItems = document.querySelectorAll('.room-summary-item');
        roomSummaryItems.forEach(item => {
            modalBodyContent.appendChild(item);
        });
        document.getElementById('info1').style.display = 'none';
        var scrollableModal = new bootstrap.Modal(document.getElementById('scrollableModal'), {});
        scrollableModal.show();
    }
}

function borrarCambios() {
    // Mostrar el modal de confirmación
    var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    modal.show();

    // Ocultar todas las habitaciones en el resumen
    const roomSummaryElement = document.getElementById('room-summary');
    roomSummaryElement.innerHTML = '';

    // Ocultar todas las habitaciones en el modal-body-content del card
    const modalBodyContent = document.getElementById('modal-body-content');
    modalBodyContent.innerHTML = '';

    // Ocultar todas las habitaciones en el card-room-summary
    const cardRoomSummaryElement = document.getElementById('card-room-summary');
    cardRoomSummaryElement.innerHTML = '';

    updateTotalPrice(0, true);

    roomCount = 0; // Reiniciar el contador de habitaciones

    // Ocultar el contenedor y la card
    const info1 = document.getElementById('info1');
    info1.style.display = 'none';

    const cardContainer = document.getElementById('card-container');
    cardContainer.style.display = 'none';
}

function eliminar(button) {
    const roomSummaryItem = button.closest('.room-summary-item');
    roomSummaryItem.remove();

    updateTotalPrice(-1100);

    roomCount--; // Decrementar el contador de habitaciones

    // Verificar el tamaño de la pantalla y la cantidad de habitaciones para mostrar u ocultar la card
    checkScreenWidth();

    // Ocultar el contenedor y la card si las habitaciones son menores a 5
    if (roomCount < 5) {
        const info1 = document.getElementById('info1');
        info1.style.display = 'block';

        const cardContainer = document.getElementById('card-container');
        cardContainer.style.display = 'none';
    }

    // Mostrar el modal de confirmación si no hay habitaciones restantes
    if (roomCount === 0) {
        borrarCambios();
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function closeModal() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModalToggle'));
    if (modal) {
        modal.hide();
    }
}

document.getElementById('ver-mas-btn').addEventListener('click', function() {
    var scrollableModal = new bootstrap.Modal(document.getElementById('scrollableModal'), {});
    scrollableModal.show();
});

function updateTotalPrice(amount, reset = false) {
    const totalPriceElement = window.innerWidth <= 950 ? document.getElementById('card-total-price') : document.getElementById('total-price');
    if (reset) {
        totalPriceElement.textContent = '0.00';
        return;
    }
    let totalPrice = parseFloat(totalPriceElement.textContent.replace('MXN ', '').replace(',', ''));
    totalPrice += amount;
    totalPriceElement.textContent = totalPrice.toFixed(2);
}
// YA NO SE MUEVEN NI HACEN CONFIDGURACIONES

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

</script>

  
</body>
</html>