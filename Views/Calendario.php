<?php
session_start();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wight@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        
       

    <link rel="stylesheet" href="../Estilos/GaelEstilos.css">
</head>
<body>
    <style>
        .navbar-nav {
            width: 100%;
        }

        .navbar-nav .nav-link {
            display: block;
            text-align: center;
            font-weight: bold;
            font-size: 1.1rem;
            color: rgb(116, 13, 13);
            transition: all 0.3s ease;
            border-radius: 25px;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgb(116, 13, 13) !important; /* Usar !important para forzar la prioridad */
            color: #fff !important; /* Color de texto al hacer hover */
            padding: 12px 24px;
            font-size: 1.2rem;
            transition: background 0.3s ease, color 0.3s ease, padding 0.3s ease, font-size 0.3s ease;
        }

        .flatpickr-calendar {
            background-color: #f8f9fa;
            border: 1px solid rgb(116, 13, 13);
            border-radius: 8px;
            max-width: 100%;
        }

        .flatpickr-day {
            color: rgb(116, 13, 13);
            transition: background 0.3s ease, color 0.3s ease;
        }

        .flatpickr-day:hover, .flatpickr-day:focus {
            background-color: rgb(116, 13, 13);
            color: #fff;
        }

        .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange {
            background-color: rgb(116, 13, 13) !important;
            color: #fff !important;
        }

        .flatpickr-months .flatpickr-prev-month, .flatpickr-months .flatpickr-next-month {
            color: rgb(116, 13, 13);
        }

        .flatpickr-month {
            color: rgb(116, 13, 13);
        }

        .flatpickr-weekday {
            color: rgb(116, 13, 13);
        }

        .flatpickr-months .flatpickr-prev-month:hover, .flatpickr-months .flatpickr-next-month:hover {
            background-color: rgb(116, 13, 13);
            color: #fff;
            border-radius: 50%;
        }

        .flatpickr-monthDropdown-months {
            background-color: #f8f9fa;
            border: 1px solid rgb(116, 13, 13);
            border-radius: 8px;
            color: rgb(116, 13, 13);
        }

        .flatpickr-monthDropdown-months:hover {
            background-color: rgb(116, 13, 13);
            color: #fff;
        }

        .reservation-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        #inline-calendar, #inline-calendar-large {
            width: 80%;
            max-width: 1000px;
        }

        .btn-custom {
            background-color: rgb(116, 13, 13);
            color: #fff;
        }

        .btn-custom:hover {
            background-color: rgb(150, 13, 13);
            color: #fff;
        }

        .custom-header {
            color: rgb(116, 13, 13);
            font-family: 'PT Sans', sans-serif;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid rgb(116, 13, 13);
            padding-bottom: 10px;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand p-2 w-25 h-50 d-inline-block" href="../index.php">
                <img src="../Imagenes/LOGOHLI.png" alt="Logo" style="width: 220px; height: 80px;" class="rounded-circle rounded-1">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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


   <div class="container mt-5 reservation-container">
        <h2 class="custom-header">Seleccione Las Fechas De Su Reservacion...</h2>
        <div id="calendar-container">
            <div id="inline-calendar"></div>
            <div id="inline-calendar-large"></div>
            <form id="formsfechas" action="habitacionreserva.php" method="POST">
            <input type="hidden" id="fechaInicio">
            <input type="hidden" id="fechaFin">
            <button class="btn btn-custom mt-4" type="button" onclick="ingresar();" id="comprobar">Comprobar</button>
</form>
        </div>
       
                                                                    <!--NECESIDAD DE REDIRECCIONAR A ALO QUE TENGAN QUE REDIRECCIONAR, PERO DOCUMENTENLO PORFA PARO PAPUS-->
        
     

    </div>


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
          <a href="../index.php #2424" class="text-decoration-none hover-link"><p>Servicios</p></a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var screenWidth = window.innerWidth;
            var flatpickrConfig = {
                mode: "range",
                minDate: "today",
                dateFormat: "Y-m-d", 
                inline: true,
                onChange: function(selectedDates) {
                    if (selectedDates.length === 2) {
                        // Cuando se seleccionan dos fechas, capturarlas como inicio y fin
                        var fechaInicio = selectedDates[0].toISOString().slice(0, 10);
                        var fechaFin = selectedDates[1].toISOString().slice(0, 10); 
                        document.getElementById('fechaInicio').value = fechaInicio;
                        document.getElementById('fechaFin').value = fechaFin;
                    }
                },
                locale: {
                    firstDayOfWeek: 1, // La semana empieza el lunes
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
                    }
                }
            };

            if (screenWidth < 768) {
                document.getElementById('inline-calendar-large').style.display = 'none';
                flatpickr("#inline-calendar", {...flatpickrConfig, showMonths: 1});
            } else {
                document.getElementById('inline-calendar').style.display = 'none';
                flatpickr("#inline-calendar-large", {...flatpickrConfig, showMonths: 2});
            }
           

        });

        function ingresar () { 
            
            <?php 
                if(isset($_SESSION["usuario"])):
                
                ?>
            
            $('#comprobar').click(function() {
 
                var fechaInicio = document.getElementById('fechaInicio').value;
                var fechaFin = document.getElementById('fechaFin').value;     

 if(fechaInicio === "" && fechaFin === ""){
 
    alert("INGRESA LAS FECHAS")
    // window.location.href='Calendario.php';
     
 }
 else{

    localStorage.setItem('fechaInicio',fechaInicio);
    localStorage.setItem('fechaFin',fechaFin);

    window.location.href = 'habitacionreserva.php';


     
}});

<?php else: ?>
    window.location.href = 'Login.php';
    <?php endif; ?>
}
    

        

      



        

</script>
 
</body>
</html>
