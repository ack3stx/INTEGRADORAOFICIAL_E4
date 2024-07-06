<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estilos/panelusuario.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=block" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>



    <section class="header-section ola chico">
        <button class="btn glass" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <span class="material-symbols-outlined">
                menu
            </span>
        </button>
        <div class="header-content">
            <p>LOS CEDROS HOTEL INN</p>
            <h1>HABITACIONES</h1>
            <div class="dropdown">
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
                    <li><a class="dropdown-item" href="#"><span class="material-symbols-outlined">
                                logout
                            </span>Cerrar sesión</a></li>
                </ul>
            </div>

        </div>
    </section>
    <div class="offcanvas offcanvas-start glass" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div>
            <p class="d-inline-flex gap-1">

                <button class="btn glass" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample">
                    Mi Espacio
                </button>
            </p>
            <div class="collapse glass" id="collapseExample">
                <div class="glass">
                    <span class="material-symbols-outlined">
                        person
                    </span> Datos Personales
                    <br>
                    > Preferencias
                    <br>
                    > Seguridad
                    <br>
                    > Datos de Pago
                    <br>
                    > Privacidad
                    <br>
                    > Notificaciones
                    <br>
                    > Acompañantes de Viaje
                </div>
            </div>
        </div>

    </div>

    </div>

<!--
    <ul class="list-group">
        <li class="list-group-item"><span class="material-symbols-outlined">
            manage_accounts
            </span>Datos Personales</li>
        <li class="list-group-item"><span class="material-symbols-outlined">
            tune
            </span>Preferencias</li>
        <li class="list-group-item"><span class="material-symbols-outlined">
            lock
            </span>Seguridad</li>
        <li class="list-group-item"><span class="material-symbols-outlined">
            credit_card
            </span>Datos de pago</li>
        <li class="list-group-item"><span class="material-symbols-outlined">
            admin_panel_settings
            </span>Privacidad</li>
        <li class="list-group-item"><span class="material-symbols-outlined">
            notifications
            </span>Notificaciones por e-mail</li>
       <li class="list-group-item"><span class="material-symbols-outlined">
        groups
        </span>Acompañantes de viaje</li>
    </ul>
-->
    <br><br>
<h1 class="vidp">Configuración de la cuenta</h1>
    <p class="vidp">Gestiona tu experiencia en HotelLagunaInn.com</p>
    
<section class="section-icons conta siono">
    <div class="overlay "></div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-12 col-md-6 col-lg-6 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-bus-front-fill"></i>
                    <div class="ms-3 ms-md-4 olas">
                        <div class="ditto ">
                            <i class="fa-solid fa-person icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Datos Personales</strong></h1>
                                <p class="como">Actualiza tus datos y descubre cómo se utilizan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-wifi"></i>
                    <div class="ms-3 ms-md-4">
                        <div class="ditto">
                            <i class="fa-solid fa-sliders icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Preferencias</strong></h1>
                                <p class="como">Cambia el idioma, la moneda y los requisitos de accesibilidad.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-wifi"></i>
                    <div class="ms-3 ms-md-4">
                        <div class="ditto">
                            <i class="fa-solid fa-lock icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Seguridad</strong></h1>
                                <p class="como">Modifica los ajustes de seguridad, configura la autenticación segura o elimina tu cuenta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-brightness-high-fill"></i>
                    <div class="ms-3 ms-md-4">
                        <div class="ditto">
                            <i class="fa-solid fa-cart-shopping icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Datos de pago</strong></h1>
                                <p class="como">Añade o elimina métodos de pago para agilizar el proceso de reserva.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-brightness-high-fill"></i>
                    <div class="ms-3 ms-md-4">
                        <div class="ditto">
                            <i class="fa-solid fa-shield-halved icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Privacidad</strong></h1>
                                <p class="como">Ejerce tus derechos de privacidad y controla cómo se usan tus datos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-brightness-high-fill"></i>
                    <div class="ms-3 ms-md-4">
                        <div class="ditto ">
                            <i class="fa-solid fa-envelope icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Notificaciones por e-mail</strong></h1>
                                <p class="como">Elige las notificaciones que quieres recibir y date de baja de las que no.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-brightness-high-fill"></i>
                    <div class="ms-3 ms-md-4">
                        <div class="ditto ">
                            <i class="fa-solid fa-person icono-grande"></i>
                            <div class="texto">
                                <h1 class="como"><strong>Acompañantes de viaje</strong></h1>
                                <p class="como">Añade o edita información sobre las personas con las que viajas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-brightness-high-fill"></i>
                    <div class="ms-3 ms-md-4">
                        <!-- Contenido adicional si es necesario -->
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 box-icons">
                <div class="d-flex align-items-center p-3">
                    <i class="bi bi-brightness-high-fill"></i>
                    <div class="ms-3 ms-md-4">
                        <!-- Contenido adicional si es necesario -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>


</html>