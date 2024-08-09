
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laguna Inn</title>
    <link rel="icon" href="../Imagenes/LOGOHLI.png" type="image/x-icon">
    <link rel="stylesheet" href="../Estilos/GaelEstilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/panelusuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

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
       <div class="header-content">
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
            <span class="material-symbols-outlined">
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
        </ul>
    </div>
</div>
';

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

    <br><br><br><br><br><br>
    <div class="header-container">
        <div class="text-content">
            <h1 class="vidp">Configuración de la cuenta</h1>
            <p class="vidp">Gestiona tu experiencia en HotelLagunaInn.com</p>
        </div>
    </div>

    <section class="section-icons conta">
        <div class="overlay"></div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-12 col-md-6 col-lg-6 box-icons">
                    <div class="d-flex align-items-center p-3">
                        <i class="bi bi-person-bounding-box"></i>
                        <div class="ms-3 ms-md-4 olas">
                            <a href="ver_datos_personales.php">
                                <div class="ditto">
                                    <i class="fa-solid fa-person icono-grande"></i>
                                    <div class="texto">
                                        <h1 class="vidp"><strong>Datos Personales</strong></h1>
                                        <p class="vidp">Actualiza tus datos y descubre cómo se utilizan.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 box-icons">
                    <div class="d-flex align-items-center p-3">
                        <i class="bi bi-wifi"></i>
                        <div class="ms-3 ms-md-4 olas">
                            <a href="datospersonales.php">
                                <div class="ditto">
                                    <i class="fa-solid fa-lock icono-grande"></i>
                                    <div class="texto">
                                        <h1 class="vidp"><strong>Seguridad</strong></h1>
                                        <p class="vidp">Modifica los ajustes de seguridad, configura la autenticación segura o elimina tu cuenta.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-6 offset-md-3 offset-lg-3 box-icons">
    <div class="d-flex align-items-center p-3">
        <div class="ms-3 ms-md-4 olas">
            <a href="historialreservaciones.php">
                <div class="ditto">
                <i class="fa-solid fa-history icono-grande"></i>
                    <div class="texto">
                        <h1 class="vidp"><strong>Mi historial de reservas</strong></h1>
                        <p class="vidp">Explora y mira las reservaciones que has hecho con anterioridad en nuestro gran hotel.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


                

                
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
