
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/panelusuario.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="header-container">
        <div class="text-content">
            <h1 class="vidp">Configuración de la cuenta</h1>
            <p class="vidp">Gestiona tu experiencia en HotelLagunaInn.com</p>
        </div>
        <div class="header-content">
            <div class="dropdown">
                <button class="btn dropdown-toggle olap" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="btnusr">
                    <span class="material-symbols-outlined ">
                        account_circle
                    </span>
                </button>
                <ul class="dropdown-menu glass">
                    <li><a class="dropdown-item" href="datospersonales.php"><span class="material-symbols-outlined lia"></span>Gestionar cuenta</a></li>
                    <li><a class="dropdown-item" href="datospersonales.php"><span class="material-symbols-outlined">travel_explore</span>Historial de Reservación</a></li>
                    <li><a class="dropdown-item" href="datospersonales.php"><span class="material-symbols-outlined">logout 
                    <?php
                    
                    
                    ?>
                    </span>Cerrar sesión</a></li>
                </ul>
                
                <a href="../index.php"><button class="btn olap">Inicio</button></a>
            </div>
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
                            <a href="datospersonales.php">
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
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
