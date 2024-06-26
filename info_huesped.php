<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
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
            color: rgb(116, 13, 13);
            transition: all 0.3s ease;
            border-radius: 25px;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgb(116, 13, 13) !important;
            color: #fff !important;
            padding: 12px 24px;
            font-size: 1.2rem;
            transition: background 0.3s ease, color 0.3s ease, padding 0.3s ease, font-size 0.3s ease;
        }

        /* Estilos del formulario */
        body {
            font-family: 'PT Sans', sans-serif;
        }

        .header-section {
            margin-top: 100px; /* Ajusta este valor según la altura de tu navbar */
        }

        .container {
            margin-top: 40px;
        }

        .form-group label {
            color: rgb(116, 13, 13);
        }

        .btn-custom {
            background-color: rgb(116, 13, 13);
            color: #fff;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #fff;
            color: rgb(116, 13, 13);
            border: 2px solid rgb(116, 13, 13);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .barra_abajo{
            background-color: #fff;
            color: rgb(116, 13, 13);
            border: 2px solid rgb(116, 13, 13);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
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
                    <a class="nav-link" href="#"><label>CONTACTANOS</label></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><label>INICIAR SESION</label></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><label>RESERVAR AHORA</label></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="header-section text-center" style="background-color: rgb(116, 13, 13); color: white; padding: 10px;">
    <div class="header-content">
                <h1>Formulario de Contacto
        </h1>
    </div>
</section>

<div class="container">
    <form>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Ingresa tu nombre">
        </div>
        <div class="form-group">
            <label for="apellido_paterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_paterno" placeholder="Ingresa tu Apellido Paterno">
        </div>
        <div class="form-group">
            <label for="apellido_materno">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_materno" placeholder="Ingresa tu Apellido Materno">
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" placeholder="Ingresa tu Dirección">
        </div>
        <div class="form-group">
            <label for="numero_telefono">Número De Teléfono</label>
            <input type="text" class="form-control" id="numero_telefono" placeholder="Ingresa tu número de teléfono">
        </div>
    </form>
    <button type="button mb-5" class="btn btn-custom mt-3">Ingresar</button>
</div>

<br>
<br>
<div class="progress" style="height: 10px; position: fixed; bottom: 0; left: 0; width: 100%; margin: 0;">
  <div class="progress-bar" role="progressbar" style="width: 100%; background-color: rgb(116, 13, 13);" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
