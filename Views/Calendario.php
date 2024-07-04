<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wight@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="../Estilos/estilos.css">
</head>
<body>
    <style>
        /* Estilos de la barra de navegación */
        .navbar-nav {
            width: 100%;
        }

        .navbar-nav .nav-link {
            display: block;
            text-align: center;
            font-weight: bold;
            font-size: 1.1rem;
            color: rgb(116, 13, 13); /* Color de texto normal */
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

        /* Estilos personalizados para el calendario */
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

        /* Estilos adicionales para centrar y ampliar el calendario */
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
            max-width: 1000px; /* Aumentar el tamaño del calendario */
        }

        /* Estilo personalizado para el botón */
        .btn-custom {
            background-color: rgb(116, 13, 13);
            color: #fff;
        }

        .btn-custom:hover {
            background-color: rgb(150, 13, 13);
            color: #fff;
        }

        /* Estilo personalizado para el encabezado */
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
                        <a class="nav-link" href="Contacto.php"><label>CONTACTANOS</label></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><label>INICIAR SESION</label></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Calendario.php"><label>RESERVAR AHORA</label></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="container mt-5 reservation-container">
        <h2 class="custom-header">Seleccione Las Fechas De Su Reservacion...</h2>
        <div id="calendar-container">
            <div id="inline-calendar"></div>
            <div id="inline-calendar-large"></div>
        </div>
        <button class="btn btn-custom mt-4" onclick="location.href='habitacionreserva.php'">Comprobar</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var screenWidth = window.innerWidth;

            if (screenWidth < 768) {
                document.getElementById('inline-calendar-large').style.display = 'none';
                flatpickr("#inline-calendar", {
                    mode: "range",
                    minDate: "today",
                    dateFormat: "d-m-Y",
                    inline: true,
                    showMonths: 1,
                    monthSelectorType: "static",
                    locale: {
                        firstDayOfWeek: 1, // start week on Monday
                        weekdays: {
                            shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
                        }
                    }
                });
            } else {
                document.getElementById('inline-calendar').style.display = 'none';
                flatpickr("#inline-calendar-large", {
                    mode: "range",
                    minDate: "today",
                    dateFormat: "d-m-Y",
                    inline: true,
                    showMonths: 2,
                    monthSelectorType: "static",
                    locale: {
                        firstDayOfWeek: 1, // start week on Monday
                        weekdays: {
                            shorthand: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado']
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
